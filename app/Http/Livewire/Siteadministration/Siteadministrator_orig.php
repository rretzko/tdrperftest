<?php

namespace App\Http\Livewire\Siteadministration;

use App\Models\Person;
use App\Models\School;
use Livewire\Component;

class Siteadministrator_orig extends Component
{
    public $search='';
    public $searchschool='';
    public $selectedschool=NULL;
    public $selectedschoolname='';
    public $selectedteachers=[];
    public $students=NULL;
    public $teachers=NULL;

    public function mount()
    {
        $this->selectedschool = NULL;
        $this->selectedschoolname = '';
        $this->students=NULL;
        $this->teachers=NULL;
    }

    public function transferStudents()
    {
        dd(__METHOD__);
    }

    public function updateSchool($value)
    {
        $this->reset('search');

        $this->selectedschool = School::find($value);
        $this->selectedschoolname = ($this->selectedschool ? $this->selectedschool->name : '');
        $this->students = $this->selectedschool->currentStudents;
        $this->teachers = $this->selectedschool->teachersForTransfer();
        $this->reset('searchschool');
    }

    public function updatedSearch($value)
    {
        $this->reset(['selectedschool','selectedschoolname', 'teachers']);

        $this->render();
    }

    public function render()
    {
        return view('livewire.siteadministration.siteadministrator',
        [
            'persons' => $this->persons(),
            'schools' => $this->schools(),
        ]);
    }

    private function persons()
    {
        //early exit
        if(! strlen($this->search)){ return collect(); }

        $likevalue = '%'.$this->search.'%';

        return Person::where('last','LIKE', $likevalue)
            ->orWhere('first', 'LIKE', $likevalue)
            ->limit(25)
            ->get()
            ->sortBy(['person.last','person.first']);
    }

    private function schools()
    {
        //early exit
        if(! strlen($this->searchschool)){ return collect(); }

        $likevalue = '%'.$this->searchschool.'%';

        return School::where('name','LIKE', $likevalue)
            ->limit(25)
            ->get()
            ->sortBy(['name', 'city']);
    }

    public function updatedSearchschool()
    {
        $this->reset('search','selectedschool','selectedschoolname','selectedteachers','students','teachers');

        //$this->render();
    }
}
