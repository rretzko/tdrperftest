<?php

namespace App\Http\Livewire\Events;

use App\Models\Eventversion;
use App\Models\Membereventversion;
use Livewire\Component;

class Eventcomponent extends Component
{
    //common contract properties for pages
    public $allowimports = true; //allow user to import ensemble members
    public $confirmingdelete = 0;
    public $membershipmanagers = [];
    public $perpage = 0; //pagination
    public $population = 0; //ALL members count
    public $search = '';
    public $selectall = false;
    public $selected = [];
    public $selectpage = 0;
    public $showaddmodal = false;
    public $showDeleteModal = false;
    public $showeditmodal = false;
    public $showfileuploadmodal = false;
    public $showfilters = false;
    public $sortdirection = 'asc';
    public $sortfield = '';

    //organization-specific properties
    public $emailsent;
    public $events;

    public function mount()
    {
        $this->events = $this->events();
    }

    public function render()
    {
        return view('livewire.events.eventcomponent');
    }

    /**
     * Return eventversions where auth()->id()
     *  - Belongs to Organization
     *  - Organization has Events
     *  - Events have Eventversions
     *  - Eventversions are open
     *  - auth()->id() belongs to a role which is open for the Eventversion
     *
     * @return mixed
     */
    private function events()
    {
        return Membereventversion::open();
    }
}
