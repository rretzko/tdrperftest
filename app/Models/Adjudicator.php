<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Adjudicator extends Model
{
    use HasFactory;

    protected $with = ['user'];

    public function getBioBlockAttribute()
    {
        $str = '<div>';

            //name header
            $str .= '<div class="font-bold">'.$this['user']['person']->fullName.'</div>';

            //indented communication details
            $str .= '<div class="text-sm ml-3 flex">';

                //email block
                $str .= '<div>';
                    foreach($this['user']['person']->subscriberemails AS $email){
                        $str.= '<div><a href="mailto:'.$email->email.'" class="text-blue-700">'.$email->email.'</a></div>';
                    }
                $str .= '</div>';

                //phone block
                $str .= '<div class="ml-4">';
                    foreach($this['user']['person']->subscriberPhoneArray AS $phone){
                        $str.= '<div>'.$phone.'</div>';
                    }
                $str .= '</div>';

            $str .= '</div>';

        $str .= '</div>';

        return $str;
    }

    public function getRegistrantsAttribute()
    {
        $rs = [];
        $roominstrumentations = $this['room']->instrumentations->modelKeys();

        $registrants =  Registrant::where('eventversion_id', Userconfig::getValue('eventversion', auth()->id()))
            ->where('registranttype_id', Registranttype::REGISTERED)
            ->whereHas('instrumentations', function($query) use($roominstrumentations){
                $query->whereIn('id',$roominstrumentations);
            })->get();

        foreach($roominstrumentations AS $roominstrumentation){
            $rs[Instrumentation::find($roominstrumentation)->formattedDescr()] = Registrant::where('eventversion_id', Userconfig::getValue('eventversion', auth()->id()))
                ->where('registranttype_id', Registranttype::REGISTERED)
                ->whereHas('instrumentations', function($query) use($roominstrumentation){
                    $query->whereIn('id',[$roominstrumentation]);
                })->get();
        }

        return $rs;

        //return $registrants;
/*

        $x = Registrant::where('eventversion_id', Userconfig::getValue('eventversion', auth()->id()))
            ->where('registranttype_id', Registranttype::REGISTERED)
            ->whereHas('instrumentations', function($query) use($roominstrumentation){
                $query->whereIn('id',$roominstrumentation);
            })->get();

        foreach($x AS $y){
            if($y->id === 656923){

                dd($y->instrumentations);
            }
        }
        return $x;
*/
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'user_id', 'user_id');
    }

    public function registrantScore(\App\Models\Registrant $registrant)
    {
        /*
        return \App\Models\Score::where('registrant_id', $registrant->id)
            ->where('user_id', $this->user_id)
            ->sum('score') ?? 0;
        */
        $totalscore = 0;

        $scores = \App\Models\Score::where('registrant_id', $registrant->id)
            ->where('user_id', $this->user_id)
            ->get();

        foreach($scores AS $score){

            $sc = \App\Models\Scoringcomponent::find($score->scoringcomponent_id);

            $totalscore += ($score->score * $sc->multiplier);
        }

        return $totalscore;
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
