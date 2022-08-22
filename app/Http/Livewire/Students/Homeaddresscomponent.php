<?php

namespace App\Http\Livewire\Students;

use App\Models\Address;
use App\Models\Geostate;
use Livewire\Component;

class Homeaddresscomponent extends Component
{
    public $address01 = '';
    public $address02 = '';
    public $city = '';
    public $geostate_id = 37; //NJ
    public $geostates;
    public $postalcode = '';
    public $student = null;

    protected $rules = [
        'address01' => ['nullable', 'string',],
        'address02' => ['nullable', 'string',],
        'city' => ['nullable', 'string',],
        'geostate_id' => ['required', 'integer',],
        'postalcode' => ['nullable', 'string', 'min:5','max:25'],
    ];

    protected $validationAttributes = [
        'address01' => 'first address',
        'address02' => 'second address',
        'geostate_id' => 'state',
        'postalcode' => 'zip code',
    ];

    public function mount()
    {
        $address = $this->student->person->user->address ?? $this->resolveNullAddressFields();
        if ($address && $address->user_id){
            $this->address01 = $address->address01 ?? '';
            $this->address02 = $address->address02 ?? '';
            $this->city = $address->city ?? '';
            $this->geostate_id = $address->geostate_id ?? 37;
            $this->postalcode = $address->postalcode ?? '';
        }

        $this->geostates = $this->geostates();
    }

    public function render()
    {
        return view('livewire.students.homeaddresscomponent');
    }

    public function save()
    {
        $address = $this->student->person->user->address ?? new Address;
        $address->user_id = $this->student->user_id;
        $address->address01 = $this->address01;
        $address->address02 = $this->address02;
        $address->city = $this->city;
        $address->geostate_id = $this->geostate_id;
        $address->postalcode = $this->postalcode;

        $address->save();

        $this->emit('homeaddress-saved');
    }

    private function geostates()
    {
        $a = [];

        foreach(Geostate::all()->sortBy('name') AS $geostate){
            $a[$geostate->id] = $geostate->name;
        }

        return $a;
    }

    private function resolveNullAddressFields()
    {
        $address = new Address();
        $address->resolveNullAddressFields($this->student->user_id);

        return $this->student->person->address;
    }
}
