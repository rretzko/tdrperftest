<?php

namespace App\Http\Livewire\Profile;

use App\Models\Emailtype;
use App\Models\Phonetype;
use App\Models\Searchable;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Phone extends Component
{
    public $phone_mobile;
    public $phone_home;
    public $phone_work;
    public $message = 'Your phone records have been updated!';
    public $user;

    protected $rules= [
        'phone_home' => ['string', 'min:10', 'max:20','different:phone_mobile','different:phone_work'],
        'phone_mobile' => ['string', 'min:10', 'max:20','different:phone_home','different:phone_work'],
        'phone_work' => ['string', 'min:10', 'max:20','different:phone_home','different:phone_mobile'],
    ];

    public function mount()
    {
        $this->phone_mobile = $this->phone('mobile');
        $this->phone_home = $this->phone('home');
        $this->phone_work = $this->phone('work');
    }

    public function render()
    {
        return view('livewire.profile.phone-form');
    }

    public function save()
    {
        $descrs = ['home', 'mobile', 'work'];

        //cycle through each phone type
        for($i=0; $i<count($descrs); $i++){

            //define the related variable (ex. $this->phone_work)
            $label = 'phone_'.$descrs[$i];

            //define the attributes for updateOrCreate() and delete() functions
            $attributes = [
                'user_id' => auth()->id(),
                'phonetype_id' => Phonetype::where('descr', $descrs[$i])->first()->id,
            ];

            //if a phone number exists, updateOrCreate table row
            if($this->$label) {
                \App\Models\Phone::updateOrCreate(
                    $attributes,
                    ['phone' => $this->$label,],
                );

                //add hashed value to searchables table
                $s = new Searchable;
                $s->add(auth()->user(),$label, $this->$label);

            }else{ //delete table row if it exists
                $s = new Searchable;
                $s->remove(auth()->user(), $label);
                \App\Models\Phone::where($attributes)->delete();
            }
        }

        //emit $this->message
        $this->emit('saved');
    }

    public function updatedPhoneMobile()
    {
        $this->phone_mobile = $this->transform($this->phone_mobile);
    }

    public function updatedPhoneHome()
    {
        $this->phone_home = $this->transform($this->phone_home);
    }

    public function updatedPhoneWork()
    {
        $this->phone_work = $this->transform($this->phone_work);
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    private function phone($descr) : string
    {
        return auth()->user()->person->phones
                ->where('phonetype_id',
                    Phonetype::where('descr', $descr)->first()->id)
                ->first()
                ->phone ?? '';
    }

    private function transform($string)
    {
        $str = '';

        foreach(str_split($string) AS $char){

            $str .= (is_numeric($char)) ? $char : '';
        }

        $xfrm = '('.substr($str,0,3).') '.substr($str,3,3).'-'.substr($str,6,4);

        if(strlen($str) > 10){

            $xfrm .= ' x'.substr($str,10);
        }

        return $xfrm;
    }
}
