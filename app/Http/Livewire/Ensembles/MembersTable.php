<?php

namespace App\Http\Livewire\Ensembles;

use App\Models\Ensemble;
use App\Models\Ensemblemember;
use App\Models\Schoolyear;
use App\Models\Userconfig;
use Livewire\Component;

class MembersTable extends Component
{
    public $countmembers;
    public $schoolyear_id;
    public $schoolyears;

    public function mount()
    {
        $this->schoolyear_id = Schoolyear::find(Userconfig::getValue('schoolyear_id', auth()->id()))->id;
        $this->schoolyears = Schoolyear::all()->sortByDesc('descr');
        $this->ensemblemembers();
    }

    public function render()
    {
        return view('livewire.ensembles.members-table',[
            'ensemblemembers' => $this->ensemblemembers(),
        ]);
    }

    public function updatedSchoolyearId()
    {
        Userconfig::setValue('schoolyear_id', auth()->id(), $this->schoolyear_id);

    }

    private function ensemblemembers()
    {
        $test = Ensemblemember::with('person', 'instrumentation')
            ->get();

        $ensemblemembers = Ensemblemember::with('person', 'instrumentation')
            ->where('schoolyear_id', $this->schoolyear_id)
            ->where('ensemble_id', Userconfig::getValue('ensemble_id', auth()->id()))
            ->paginate(Userconfig::getValue('pagination', auth()->id()));

        $this->countmembers = $ensemblemembers->total();

        return $ensemblemembers;
    }
}
