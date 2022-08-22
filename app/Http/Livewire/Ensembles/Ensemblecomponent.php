<?php

namespace App\Http\Livewire\Ensembles;

use App\Exports\EnsemblesExport;
use App\Helpers\CollectionHelper;
use App\Models\Ensemble;
use App\Models\Ensemblemember;
use App\Models\Ensembletype;
use App\Models\Userconfig;
use App\Traits\SenioryearTrait;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Ensemblecomponent extends Component
{
    use WithPagination, SenioryearTrait;

    public $abbr = '';
    public $descr = '';
    public $editensemble = null;
    public $ensembletype_id = 1;
    public $ensembletypes = [];
    public $filterstring = '';
    public $name = '';
    public $perpage = 0;
    public $search = '';
    public $selected = [];
    public $selectall= false;
    public $selectpage = false;
    public $showfilters = false;
    public $showaddmodal = false;
    public $showeditmodal = false;
    public $showDeleteModal = false;
    public $sortdirection = 'asc';
    public $sortfield = '';
    public $startyear = 1960;
    public $years = [];

    public function mount()
    {
        $this->ensembletypes = Ensembletype::all();
        $this->perpage = Userconfig::getValue('pagination', auth()->id());
        $this->students = collect();
        $this->years = $this->years();
    }

    public function render()
    {
        return view('livewire.ensembles.ensemblecomponent',
        [
            'ensembles' => $this->ensembles(),
        ]);
    }

    public function deleteSelected()
    {
        Ensemble::destroy($this->selected);
        $this->showDeleteModal = false;
        $this->selected = [];
    }

    public function edit($ensemble_id)
    {
        $this->editensemble = Ensemble::find($ensemble_id);
        $this->showeditmodal = true;

        $this->name = $this->editensemble->name;
        $this->abbr = $this->editensemble->abbr;
        $this->ensembletype_id = $this->editensemble->ensembletype_id;
        $this->startyear = $this->editensemble->startyear;
        $this->descr = $this->editensemble->descr;
    }

    public function exportSelected()
    {
        $ensembles  = new EnsemblesExport(Ensemble::whereKey($this->selected)->get());

        //resetSelects
        $this->selected = [];
        $this->selectall = false;
        $this->selectpage = false;

        return Excel::download($ensembles, 'ensembles.csv');
    }

    public function save()
    {
        $this->renewProperties();
        $this->editensemble->save();

        $this->emit('ensemble-saved');
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

    public function updatedSelectpage($value)
    {
        $this->selected = ($value)
            //values must be cast as strings
            ? $this->ensembles()->pluck('id')->map(fn($id) => (string)$id)
            : [];
    }

    public function updatedShowaddmodal()
    {
       if($this->showaddmodal) {
            $this->editensemble = new Ensemble;

            $this->name = '';
            $this->abbr = '';
            $this->ensembletype_id = 1;
            $this->startyear = date('Y');

            $this->showeditmodal = true;
        }
    }

    public function updatedPerpage()
    {
        Userconfig::setValue('pagination', auth()->id(), $this->perpage);
    }

    /** END OF PUBLIC FUNCTIONS  *************************************************/

    private function ensembles()
    {
        return $this->sorted(Ensemble::where('name', 'LIKE', '%'.$this->search.'%')
                ->where('school_id', Userconfig::getValue('school', auth()->id()))
                ->with('ensembletype', 'ensembletype.instrumentations', 'ensemblemembers')
                ->orderBy('name')
                ->get());
    }

    private function renewProperties()
    {
        $this->editensemble->user_id = auth()->id();
        $this->editensemble->school_id = Userconfig::getValue('school_id', auth()->id());
        $this->editensemble->name = $this->name;
        $this->editensemble->abbr = $this->abbr;
        $this->editensemble->ensembletype_id = $this->ensembletype_id;
        $this->editensemble->startyear = $this->startyear;
        $this->editensemble->descr = $this->descr;
    }

    private function sorted(Collection $ensembles)
    {
        //early exit: return $ensembles in name order
        if(! $this->sortfield){ return $ensembles; }

        return $this->sortedNative($ensembles);
    }

    private function sortedNative(Collection $ensembles)
    {
        $nesteds = ['members', 'type'];

        //sortfield is field on the ensembles table
        if(! in_array($this->sortfield, $nesteds)){

            return ($this->sortdirection === 'asc')
                ? $ensembles->sortBy($this->sortfield)
                : $ensembles->sortByDesc($this->sortfield);
        }

        $method = 'sortedNested'.ucwords($this->sortfield); //ex. sortedNestedInstrumentation()
        return $this->$method($ensembles);
    }

    /**
     * @todo figure out how to sort by members
     * @param $ensembles
     * @return mixed
     */
    private function sortedNestedMembers($ensembles)
    {
        return ($this->sortdirection === 'asc')
            ? $ensembles->sortBy('name')
            : $ensembles->sortByDesc('name');
    }

    private function sortedNestedType($ensembles)
    {
        return ($this->sortdirection === 'asc')
            ? $ensembles->sortBy('startyear')
            : $ensembles->sortByDesc('ensembletype.descr');
    }

    private function years()
    {
        $a = [];
        $start = ($this->senioryear() + 1);
        $end = 1960;

        for($i=$start; $i>=$end; $i--){
            $a[$i] = $i;
        }

        return $a;
    }
}
