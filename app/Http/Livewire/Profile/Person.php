<?php

namespace App\Http\Livewire\Profile;

use App\Events\UpdateSearchablesEvent;
use App\Models\Honorific;
use App\Models\Pronoun;
use App\Models\User;
use App\Traits\UpdateSearchablesTrait;
use Livewire\Component;

class Person extends Component
{
    use UpdateSearchablesTrait;

    private $person;

    public $first;
    public $honorific_id;
    public $honorifics;
    public $last;
    public $message = 'Your personal information has been updated!';
    public $middle;
    public $pronoun_id;
    public $pronouns;

    protected $rules= [
        'first' => ['required','string'],
        'honorific_id' => ['required', 'numeric'],
        'last' => ['required', 'string'],
        'middle' => ['nullable','string'],
        'pronoun_id' => ['required','numeric'],
        ];

    public function mount()
    {
        $this->first = auth()->user()->person->first;
        $this->middle = auth()->user()->person->middle;
        $this->last = auth()->user()->person->last;

        $this->honorifics = Honorific::orderBy('order_by')->get();
        $this->honorific_id = auth()->user()->person->honorific_id;

        $this->pronouns = Pronoun::orderBy('order_by')->get();
        $this->pronoun_id = auth()->user()->person->pronoun_id;
    }

    public function render()
    {
        return view('livewire.profile.person-form');
    }

    public function save()
    {
        \App\Models\Person::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'first' => $this->first,
                'middle' => $this->middle,
                'last' => $this->last,
                'honorific_id' => $this->honorific_id,
                'pronoun_id' => $this->pronoun_id,
            ]
        );

        $this->updateSearchables(
            User::find(auth()->id()),
            'name',
            $this->first.$this->middle.$this->last
            );

        //emit $this->message
        $this->emit('saved');
    }
}
