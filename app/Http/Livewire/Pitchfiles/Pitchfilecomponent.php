<?php

namespace App\Http\Livewire\Pitchfiles;

use App\Models\Eventversion;
use App\Models\Userconfig;
use Livewire\Component;

class Pitchfilecomponent extends Component
{
    public $filecontenttype_id;
    public $eventversion;
    public $filecontenttypes;
    public $instrumentation_id;
    public $instrumentations;

    public function mount()
    {
        $this->eventfiletype_id = 0;
        $this->eventversion = Eventversion::find(Userconfig::getValue('eventversion', auth()->id()));
        $this->instrumentation_id=0;
        $this->instrumentations = $this->eventversion->instrumentations();
        $this->filecontenttypes = $this->eventversion->filecontenttypes;
    }

    public function render()
    {
        return view('livewire.pitchfiles.pitchfilecomponent',[
            'pitchfiles' => $this->pitchfiles(),
        ]);
    }

    public function updatedFilecontenttypeId()
    {
        $this->pitchfiles();
    }

    public function updatedInstrumentationId()
    {
       //$this->pitchfiles();
    }

/** END OF PUBLIC FUNCTIONS  *************************************************/

    private function pitchfiles()
    {
        $instrumentation_id = $this->instrumentation_id;

        if($this->instrumentation_id && $this->filecontenttype_id){

            return $this->eventversion->pitchfiles
                ->where('filecontenttype_id', $this->filecontenttype_id)
                ->where('instrumentation_id', $this->instrumentation_id);

        }elseif($this->filecontenttype_id){

            return $this->eventversion->pitchfiles
                ->where('filecontenttype_id', $this->filecontenttype_id);

        }elseif($this->instrumentation_id) {

            return $this->eventversion->pitchfiles->filter(function ($pitchfile) use($instrumentation_id){

                return (
                    ($pitchfile->instrumentation_id == $instrumentation_id) ||
                    is_null($pitchfile->instrumentation_id)
                );
            });

        }else{

            return $this->eventversion->pitchfiles;
        }

    }
}
