<?php

namespace App\Http\Livewire\Students;

use App\Exports\StudentsExport;
use App\Helpers\CollectionHelper;
use App\Models\Instrumentation;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Userconfig;
use App\Traits\SenioryearTrait;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;

class Studentscomponent extends Component
{
    /**
     * @todo Figure out how <select>Class of</select> in profilecomponent.blade.php can default to current senior year (grade 12) for new students
     */
    use SenioryearTrait,WithPagination;

    public $filters = [
        'first' => null,
        'instrumentation_id' => '',
        'classof' => '',
        ];
    public $editstudent = null;
    public $filterstring = '';
    public $instrumentations = [];
    public $perpage = 0;
    public $population = 'all';
    public $schoolcurrent = 1;
    public $search = '';
    public $selectall = false;
    public $selected = [];
    public $selectpage = false;
    public $showDeleteModal = false;
    public $showfilters = false;
    public $showstudentmodal = false;
    public $sortdirection = 'asc';
    public $sortfield = '';
    public $tab = '';

    //non-paginated population of students
    private $populationstudents = null;

    protected $rules = [
        'grade' => ['required'],
        'name' => ['required'],
    ];

    public function mount()
    {
        $this->schoolcurrent = Userconfig::getValue('school', auth()->id());
        $this->perpage = Userconfig::getValue('pagination', auth()->id());
        $this->population = Userconfig::getValue('studentpopulation', auth()->id());
        $this->tab = Userconfig::getValue('studenttab', auth()->id());
    }

    public function render()
    {
        return view('livewire.students.studentscomponent',
            [
                'students' => $this->students(),
                'sortedclassofs' => $this->classofsArray(),
                'sortedinstrumentations' => $this->instrumentationsArray(),
                'schools' => $this->schools(),
            ]);
    }

    public function buttonAdd()
    {
        $this->showstudentmodal = true;
        $this->reset('editstudent');
    }

    public function changeSchool($value)
    {
        Userconfig::setValue('school', auth()->id(), $value);
        $this->schoolcurrent = $value;
    }

    public function deleteSelected()
    {
        auth()->user()->person->teacher->removeStudents($this->selected);
        $this->showDeleteModal = false;
        $this->selected = [];
    }

    public function edit($user_id)
    {
        $this->editstudent = Student::find($user_id);
        $this->showstudentmodal = true;
    }

    public function exportSelected()
    {
        $user_ids = $this->selected;
        $students = Teacher::find(auth()->id())->myStudents($this->search);
        $selecteds = ($this->selectall)
            ? $students
            : $students->filter(function($student) use ($user_ids){
                (is_array($user_ids))
                    ? in_array($student->user_id, $user_ids)
                    : $user_ids->contains($student->user_id); });

        $filtered = $this->filterPopulation($selecteds);
        $sorted = $this->sorted($filtered);
        $this->selected = $sorted->pluck('user_id')->map(fn($user_id) => (string)$user_id);
        $students = new StudentsExport(Student::whereKey($this->selected)->get());

        //resetSelects
        $this->selected = [];
        $this->selectall = false;
        $this->selectpage = false;

        return Excel::download($students, 'students.csv');
    }

    public function population($value)
    {
        Userconfig::setValue('studentpopulation', auth()->id(), $value);
        $this->population = $value;
        $this->selectall = false;
        $this->selectpage = false;
        $this->selected = [];
    }

    public function resetFilters()
    {
        $this->reset('filters');
        $this->reset('filterstring');
    }

    public function selectAll()
    {
        $this->selectall = true;
        $this->selectpage = true;
        $this->updatedSelectpage(true);
    }

    public function sortField($value)
    {
        $this->sortdirection = ($this->sortfield === $value)
            ? (($this->sortdirection === 'asc') ? 'desc' : 'asc')
            : 'asc';

        $this->sortfield = $value;
    }

    public function updatedFilters()
    {
        $filters = [];
        if(strlen($this->filters['first'])){$filters[] = $this->filters['first'];}

        if($this->filters['instrumentation_id']){
            $filters[] = Instrumentation::find($this->filters['instrumentation_id'])->formattedDescr();
        }

        if($this->filters['classof']){$filters[] = $this->filters['classof'];}

        $this->filterstring = implode(',',$filters);
    }

    public function updatedPerpage()
    {
        Userconfig::setValue('pagination', auth()->id(), $this->perpage);
    }

    public function updatedSelectAll($value)
    {
        $this->selectall = true;
    }

    public function updatedSelectpage($value)
    {
        $students = $this->students();

        $this->selected = ($value)
            //values must be cast as strings
            ? $this->students()->pluck('user_id')->map(fn($user_id) => (string)$user_id)
            : [];
    }

    public function updatedTab()
    {
        Userconfig::setValue('studenttab', auth()->id(), $this->tab);
    }

    /** END OF PUBLIC FUNCTIONS  *************************************************/

    private function applyFilters($students)
    {
        return $this->filterPopulation($students);
    }

    private function classofsArray()
    {
        $a = [];

        foreach($this->populationstudents AS $student){

            $a[$student->classof] = $student->classof;

        }

        asort($a);

        return $a;
    }

    private function filterClassof($students)
    {
        //early exit
        if(! $this->filters['classof']){ return $students;}

        return $students->filter(function($student){
            return ($student->classof == $this->filters['classof']);
        });
    }

    private function filterFirst($students)
    {
        //early exit
        if(! strlen($this->filters['first'])){ return $students;}

        return $students->filter(function($student){
            return (strtolower($student->person->first) === strtolower($this->filters['first']));
        });
    }

    private function filterInstrumentation($students)
    {
        //early exit
        if(! $this->filters['instrumentation_id']){ return $students;}

        return $students->filter(function($student){
           foreach($student->person->user->instrumentations AS $instrumentation){
               return ($instrumentation->id == $this->filters['instrumentation_id']);
           }
        });
    }

    private function filterPopulation(Collection $students)
    {
        //early exit
        if($this->population === 'all'){ return $students;}

        $senioryear = $this->senioryear();

        return ($this->population === 'current')
            ? $students->filter(function($student) use($senioryear) {
                return $student->classof >= $senioryear;
            })
            : $students->filter(function($student) use($senioryear) {
                return $student->classof < $senioryear;
            });
    }

    private function instrumentationsArray()
    {
        $a = [];

        foreach($this->populationstudents AS $student){
            foreach($student->person->user->instrumentations AS $instrumentation){

                $a[$instrumentation->id] = $instrumentation->formattedDescr();
            }
        }

        asort($a);

        return $a;
    }

    private function schools()
    {
        return (auth()->user()->schools) ?: collect();
    }

    private function students()
    {
        //pull this teacher's students
        $students = Teacher::find(auth()->id())->myStudents(
            $this->search,
            $this->filters['first'],
            $this->filters['instrumentation_id'],
            $this->filters['classof'],
            true,
        );

        //filter and sort student population
        $filtered  = $this->applyFilters($students);

        //pre-pagination collection of students filtered by population
        $this->populationstudents = $this->sorted($filtered);

        if(strlen($this->filters['first']) || $this->filters['instrumentation_id'] || $this->filters['classof']){
            $this->resetPage();
        }

        //paginate identified students
        return CollectionHelper::paginate($this->populationstudents, Userconfig::getValue('pagination', auth()->id()));
    }

    /**
     * Sort population by column headers
     * @param Collection $students
     * @return Collection
     */
    private function sorted(Collection $students)
    {
        //early exit: return $students in fullNameAlpha order
        if(! $this->sortfield){ return $students; }

        return $this->sortedNative($students);
    }

    private function sortedNative(Collection $students)
    {
        $nesteds = ['instrumentation', 'name'];

        //sortfield is field on the students table
        if(! in_array($this->sortfield, $nesteds)){

            return ($this->sortdirection === 'asc')
                ? $students->sortBy($this->sortfield)
                : $students->sortByDesc($this->sortfield);
        }

        $method = 'sortedNested'.ucwords($this->sortfield); //ex. sortedNestedInstrumentation()
        return $this->$method($students);
    }

    private function sortedNestedInstrumentation(Collection $students)
    {
        return ($this->sortdirection === 'asc')
            ? $students->sortBy(function($student) {
                return $student->person->user->instrumentations->first()->formattedDescr();
            })
            : $students->sortByDesc(function($student) {
                return $student->person->user->instrumentations->first()->formattedDescr();
            });
    }

    private function sortedNestedName(Collection $students)
    {
        return ($this->sortdirection === 'asc')
            ? $students->sortBy(function($student) {
                    return $student->person->last.$student->person->first;
                })
            : $students->sortByDesc(function($student) {
                return $student->person->last.$student->person->first;
            });
    }
}
