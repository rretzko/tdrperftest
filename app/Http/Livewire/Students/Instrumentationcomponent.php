<?php

namespace App\Http\Livewire\Students;

use App\Models\Instrumentation;
use App\Models\Instrumentationbranch;
use Livewire\Component;

class Instrumentationcomponent extends Component
{
    public $addinstrumentation = false;
    public $branch_id = 1;
    public $branches = [];
    public $student = null;
    public $instrumentation_id = 1;
    public $instrumentations = [];
    public $studentinstrumentations = [];

    public function mount()
    {
        $this->branches = Instrumentationbranch::all();
        $this->setInstrumentations();
        $this->studentInstrumentations();
    }

    public function render()
    {
        return view('livewire.students.instrumentationcomponent');
    }

    public function delete($instrumentation_id)
    {
        $this->student->person->user->instrumentations()->detach($instrumentation_id);
        $this->student->refresh();
        $this->studentInstrumentations();
    }

    public function updatedBranchId()
    {
        $this->setInstrumentations();
    }

    /** @todo add a 'make primary' checkbox to form to all the auth()->user() to indicate $this->student primary instrumentation
     */
    public function save()
    {

        if($this->student->person->user->instrumentations->contains($this->instrumentation_id)){
            //do nothing with duplicate record
        }else {
            $this->student->person->user->instrumentations()->attach($this->instrumentation_id, ['order_by' => 1]);
            $this->student->refresh();
            $this->studentInstrumentations();
        }

        $this->emit('instrumentation-saved');
    }

    private function setInstrumentations()
    {
        //early exit
        if($this->branch_id === Instrumentationbranch::NONE){ //none
            $this->instrumentations = collect();
        }elseif($this->branch_id === Instrumentationbranch::MIXED){ //mixed
            $this->instrumentations = Instrumentation::all()->sortBy('descr');
        }else{ //choral or instrumental
            $this->instrumentations = Instrumentation::where('instrumentationbranch_id', $this->branch_id)
                ->get()
                ->sortBy('descr');
        }
    }

    private function studentInstrumentations()
    {
        $this->studentinstrumentations = $this->student->person->user->instrumentations
            ->sortBy([
                ['instrumentationbranch.descr', 'asc'],
                ['descr', 'asc'],
            ]);
    }
}
