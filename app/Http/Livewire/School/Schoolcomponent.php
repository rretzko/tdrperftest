<?php

namespace App\Http\Livewire\School;

use App\Exports\SchoolsExport;
use App\Helpers\CollectionHelper;
use App\Models\Geostate;
use App\Models\Gradetype;
use App\Models\School;
use App\Models\Tenure;
use App\Models\Userconfig;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Schoolcomponent extends Component
{
    public $message = 'Successful update!';
    public $perpage =5;
    public $school = NULL;
    public $schoolid = 0;
    public $search = '';
    public $searchresults = [];
    public $selectall = false;
    public $selectpage = false;
    public $selected = [];
    public $showAddModal = false;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $sortdirection = 'asc';
    public $sortfield = 'location';
    public $table_schools = NULL;
    public $tenure = NULL;

    public $name = '';
    public $address0 = '';
    public $address1 = '';
    public $city = '';
    public $geostate_id = 0;
    public $postalcode = '';
    public $mailingaddress = '';

    public $startyear = 1960;
    public $endyear = 0;

    public $grades = []; //placeholder for user gradetype selections
    public $grades_found = false;

    //select options
    public $endyears = [];
    public $geostates = [];
    public $gradetypes = [];
    public $options = [];
    public $startyears = [];

    protected $queryString = ['sortfield', 'sortdirection'];

    protected $rules = [
        'name' => ['required', 'min:5', 'max:60'],
        'address0' => ['string', 'nullable', 'max:120'],
        'address1' => ['string', 'nullable', 'max:120'],
        'city' => ['string', 'nullable', 'max:60'],
        'geostate_id' => ['required', 'integer'],
        'postalcode' => ['string', 'nullable', 'max:15'],
        'startyear' => ['required', 'integer'],
        'endyear' => ['integer', 'nullable'], //before:startyear if not null
        'schoolid' => ['nullable'],
        'searchresults' => ['nullable'],
        'selectpage' => ['nullable'],
        'grades_found' => ['nullable'],
    ];

    public function add()
    {
        if(! $this->schoolid){

            $this->addNewSchool();

        }else {

            $this->validate([
                'startyear' => ['required', 'integer'],
                'endyear' => ['integer', 'nullable'],
            ]);
        }

        $this->school->users()->attach(auth()->id());

        Tenure::create([
            'user_id' => auth()->id(),
            'school_id' => $this->school->id,
            'startyear' => $this->startyear,
            'endyear' => $this->endyear,
        ]);

        $this->saveGrades();

        $this->table_schools = auth()->user()->schools;

        $this->cancelAdd();
    }

    public function cancelAdd()
    {
        $this->resetVars();
        $this->showAddModal = false;
    }

    public function deleteSelected()
    {
        auth()->user()->schools()->detach($this->selected);
        $this->table_schools = auth()->user()->schools;
        $this->showDeleteModal = false;
        $this->selected = [];
    }

    public function exportSelected()
    {
        $schools = new SchoolsExport(School::whereKey($this->selected)->get());

        return Excel::download($schools, 'schools.csv');
    }

    public function mount()
    {
        $this->searchresults = [];
        $this->table_schools = auth()->user()->schools;
        $this->geostates = $this->buildSimpleArrayFromCollection(Geostate::all(), 'id', 'abbr');
        $this->gradetypes = $this->buildSimpleArrayFromCollection(Gradetype::orderBy('orderby')->get(), 'id', 'descr');
        $this->options = $this->geostates;
        $this->perpage = Userconfig::getValue('pagination', auth()->id());
        $this->startyears = $this->years();
        $this->endyears = $this->years(true);
        $this->setGrades();
        //initialize select values
        $this->geostate_id = array_key_first($this->geostates);
    }

    public function edit($id)
    {
        $this->school = School::find($id);

        $this->tenure = Tenure::where('user_id', auth()->id())->where('school_id', $this->school->id)->first();
//dd(auth()->id().': '.$this->school->id); //8460,955
        $this->setGrades();

        $this->name = $this->school->name;
        $this->address0 = $this->school->address0;
        $this->address1 = $this->school->address1;
        $this->city = $this->school->city;
        $this->geostate_id = $this->school->geostate_id;
        $this->postalcode = $this->school->postalcode;
        $this->startyear = $this->tenure->startyear;
        $this->endyear = $this->tenure->endyear;

        $this->showEditModal = true;
    }

    public function getSchoolsxProperty()
    {
        return $this->schools();
    }

    public function loadSchool($school_id)
    {
        $this->schoolid = $school_id;
        $this->school = School::find($school_id);

        $this->name = $this->school->name;
        $this->mailingaddress = $this->school->mailingAddress;

        $this->tenure = Tenure::where('user_id', auth()->id())->where('school_id', $this->school->id)->first();

        $this->setGrades();

        $this->searchresults = [];
    }

    public function render()
    {
        if($this->selectall){
            $this->selected = $this->schools()->pluck('id')->map(fn($id) => (string) $id);
        }

        return view('livewire.school.update-school-information-form',
            [
                'schools' => $this->schools(),
            ]);
    }

    public function save()
    {
        $this->validate();

        $this->school->name = $this->name;
        $this->school->address0 = $this->address0;
        $this->school->address1 = $this->address1;
        $this->school->city = $this->city;
        $this->school->geostate_id = $this->geostate_id;
        $this->school->postalcode = $this->postalcode;
        $this->school->save();

        $this->tenure->startyear = $this->startyear;
        $this->tenure->endyear = $this->endyear;
        $this->tenure->save();

        $this->saveGrades();

        $this->showEditModal = false;
        $this->table_schools = auth()->user()->schools;

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

    public function updateGrades($key)
    {
        $this->grades[$key] = (! $this->grades[$key]);

        $this->refreshGradesFound();
    }

    public function updatedName()
    {
        $this->searchresults = (strlen($this->name))
            ? $this->buildSearchLinks()
            : [];
    }

    public function updatedPerpage()
    {
        Userconfig::setValue('pagination', auth()->id(), $this->perpage);
    }

    public function updatedSelectAll($value)
    {
        $this->selectall = true;
    }

    public function updatedSelected()
    {
        $this->selectall = false;
        $this->selectpage = false;
    }

    public function updatedSelectpage($value)
    {
        $this->selected = ($value)
            //values must be cast as strings
            ? $this->schools()->pluck('id')->map(fn($id) => (string) $id)
            : [];
    }

    public function updatedShowDeleteModal()
    {

    }


/** END OF PUBLIC FUNCTIONS  *************************************************/


    /**
     * @todo After school is added, make sure that the user is a teacher and is added to teachers table
     * @todo NOTE: The check on the teacher status should possibly occur when the registration happens?
     */
    private function addNewSchool()
    {
        $this->validate();

        $this->school = School::create([
            'name' => $this->name,
            'address0' => $this->address0,
            'address1' => $this->address1,
            'city' => $this->city,
            'geostate_id' => $this->geostate_id,
            'postalcode' => $this->postalcode,
        ]);
    }

    private function buildSearchLinks()
    {
        $a = [];

        $collection = School::where('name', 'LIKE', '%'.$this->name.'%')->orderBy('name')->limit(5)->get();

        //early exit
        if(! $collection->count()){ return $a;}

        foreach($collection AS $school){ //ex. $a[#] = Ridge High School (Basking Ridge, NJ 07920)
            $a[$school->id] = $school->name.' ('.$school->city.', '.$school->geostateAbbr.' '.$school->postalcode.')';
        }

        return $a;
    }

    private function buildSimpleArrayFromCollection($batch, $keyname, $valuename)
    {
        $a = [];

        foreach($batch AS $item){
            $a[$item->$keyname] = $item->$valuename;
        }

        return $a;
    }

    private function findSchoolName() : School
    {
        return new School;
    }

    private function refreshGradesFound()
    {
        //if at least one grade is found, set $this->grades_found = true
        $this->grades_found = in_array(true, $this->grades);
    }

    private function resetVars()
    {
        $this->schoolid = 0;
        $this->school = NULL;
        $this->name = '';
        $this->address0 = '';
        $this->address1 = '';
        $this->city = '';
        $this->geostate_id = array_key_first($this->geostates);
        $this->postalcode = '';
        $this->startyear = 1960;
        $this->endyear = 0;
        $this->setGrades();
    }

    private function saveGrades()
    {
        $truecounter = 0;

        foreach($this->grades AS $key => $value)
        {
            if($value){$truecounter++;}

            auth()->user()->person->teacher->saveGradetype($this->school, $key, $value);
        }

        //refresh array
        $this->setGrades();
    }

    /**
     * Return schools for auth()->id()
     */
    private function schools()
    {
        $schools = $this->searchSchools();

        return ($schools)
            ? CollectionHelper::paginate($schools, Userconfig::getValue('pagination', auth()->id()))
            : collect();
    }

    private function searchSchools()
    {
        $schools = auth()->user()->schools->filter(function($school){
            return (str_contains(strtolower($school->name), strtolower($this->search)));
        });

        return ($schools->count()
            ? ($this->sortdirection === 'asc')
                ? $schools->sortby($this->sortfield)
                : $schools->sortByDesc($this->sortfield)
            : null);
    }


    /**
     * Initialize $this->grades based on $this->gradetypes
     * AND current database values
     */
    private function setGrades()
    {
        //re-initialize var to false
        $this->grades_found = false;

        foreach($this->gradetypes AS $key => $value){

            $this->grades[$key] = ($this->school)
                ? auth()->user()->person->teacher->hasGradetype($this->school, $key)
                : false;

            $this->refreshGradesFound();
        }
    }

    /**
     * If years select box requires a blank option,
     * set $blankoption = true
     *
     * @param boolean $blankoption
     * @return array
     */
    private function years($blankoption=false)
    {
        $a = [];

        if($blankoption){$a[0] = '';}

        for($i=date('Y'); $i>1959; $i--){
            $a[$i] = $i;
        }

        return $a;
    }

}
