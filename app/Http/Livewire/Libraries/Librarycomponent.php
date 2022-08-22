<?php

namespace App\Http\Livewire\Libraries;

use App\Models\Composition;
use App\Models\Compositioncollectiontype;
use App\Models\Compositiontype;
use App\Models\Geostate;
use App\Models\Publisher;
use Livewire\Component;
use Livewire\WithPagination;

class Librarycomponent extends Component
{
    use WithPagination;

    //common contract properties for pages
    public $allowimports = true; //allow user to import ensemble members
    public $confirmingdelete = 0;
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

    //library-specific properties
    public $compositioncollectiontypes = [];
    public $compositiontypes = [];
    public $ensembles = [];
    public $geostates = [];

    //composition
    public $editcomposition = null;
    public $editcompositioncompositiontype_id = 1;
    public $editcompositioncompositioncollectiontype_id = 1;
    public $editcompositionfrom = '';
    public $editcompositiontitle = '';
    public $editcompositionsubtitle = '';

    //publisher
    public $publisherslist = [];
    public $publisheraddress0 = '';
    public $publisheraddress1 = '';
    public $publishercity = '';
    public $publishergeostateid = 37; //NJ
    public $publisherpostalcode = '';
    public $publisherid = 0;
    public $publishername = '';
    public $publishers = [];
    public $publisherselected = false;
    public $showpublisherform = false;

    public function mount()
    {
        $this->compositioncollectiontypes = $this->compositioncollectiontypes();
        $this->compositiontypes = $this->compositiontypes();
        $this->geostates = $this->geostates();
        $this->publishers = Publisher::all();
        $this->refreshPublishersList();
    }
    public function render()
    {
        return view('livewire.libraries.librarycomponent',
            [
              'compositions' => $this->compositions(),
            ]
        );
    }

    public function loadPublisher($id)
    {
        $this->publisherid = $id;
        $this->publishername = $this->publishers->find($id)->name;
        $this->showpublisherform = false;
        $this->publisherselected = true;
    }

    public function save()
    {
        $this->editcomposition = Composition::updateOrCreate([
            'title' => $this->editcompositiontitle,
            'subtitle' => $this->editcompositionsubtitle,
            'compositiontype_id' => $this->editcompositioncompositiontype_id,
            'compositioncollectiontype_id' => $this->editcompositioncompositioncollectiontype_id,
        ]);

        $this->reset('editcomposition', 'editcompositiontitle', 'editcompositionsubtitle',
            'editcompositioncompositiontype_id', 'editcompositioncompositioncollectiontype_id', 'showeditmodal');


    }

    public function savepublisher()
    {
        $publisher = Publisher::create([
            'name' => $this->publishername,
            'address0' => $this->publisheraddress0,
            'address1' => $this->publisheraddress1,
            'city' => $this->publishercity,
            'geostate_id' => $this->publishergeostateid,
            'postalcode' => $this->publisherpostalcode,
        ]);

        $this->publisherid = $publisher->id;

        $this->publishers = Publisher::all();
        $this->refreshPublishersList();

        $this->reset('publisheraddress0', 'publisheraddress1', 'publishercity', 'publishergeostateid',
            'publisherpostalcode');

        $this->showpublisherform = false;

    }

    public function updatedPublishername()
    {
        if((! $this->publisherselected) &&
            strlen($this->publishername) &&
            (! Publisher::where('name', $this->publishername)->first())){

            //NOTE: This if() must occur BEFORE the second if()
            //If the user has NOT selected a publisher from the publisherlist and tabs out of the publisher name field,
            //display the new publisher form
            $this->showpublisherform = true;

        }elseif($this->publisherselected && (! strlen($this->publishername))){

        //If the user has already selected a publisher, but selects the wrong publisher,
        //clearing the publisher name should re-display the publisherlist and NOT the publisher form

            $this->reset('publisherselected');

        }else{

            $this->reset('publisherid', 'publisherselected', 'showpublisherform');
        }
    }

    /**
     * Reset $this->publisherselected whenever user edits field
     */
    public function updatingPublishername()
    {
        $this->reset('publisherid','publisherselected');
    }

    public function updatedShowaddmodal()
    {
        $this->editcomposition = new Composition;
        $this->showeditmodal = true;
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    public function compositioncollectiontypes()
    {
        $a = [];

        foreach(Compositioncollectiontype::all() AS $collectiontype){
            $a[$collectiontype->id] = $collectiontype->descr.' ('.$collectiontype->media.')';
        }

        return $a;
    }

    public function compositiontypes()
    {
        $a = [];

        foreach(Compositiontype::all() AS $compositiontype){
            $a[$compositiontype->id] = $compositiontype->descr;
        }

        return $a;
    }

    private function compositions()
    {
        return collect();
    }

    private function geostates()
    {
        $a = [];

        foreach(Geostate::all() AS $geostate){
            $a[$geostate->id] = $geostate->abbr;
        }

        return $a;
    }

    private function refreshPublishersList()
    {
        foreach(Publisher::all() AS $publisher){

            $this->publisherslist[$publisher->id] = $publisher->name;
        }
    }
}
