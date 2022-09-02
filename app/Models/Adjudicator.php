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
        $eventVersionId = Userconfig::getValue('eventversion', auth()->id());

        return $this->room->instrumentations
            ->reduce(function ($carry, Instrumentation $instrumentation) use ($eventVersionId)
            {
                $instrumentFormattedDescr = $instrumentation->formattedDescr();

                $registrants = $instrumentation->registrants()
                        ->where('eventversion_id', $eventVersionId)
                        ->where('registranttype_id', Registranttype::REGISTERED)
                        ->with([
                           'eventversion',
                        ])
                    ->get();

                $carry[$instrumentFormattedDescr] = $registrants;
                return $carry;
            }, []);
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'user_id', 'user_id');
    }

    public function scores()
    {
        return $this->hasMany(Score::class, 'user_id', 'user_id');
    }

    public function registrantScore(\App\Models\Registrant $registrant)
    {
        /*
        return \App\Models\Score::where('registrant_id', $registrant->id)
            ->where('user_id', $this->user_id)
            ->sum('score') ?? 0;
        */
        $totalscore = 0;
                
        $scores = $this->scores()
            ->where('registrant_id', $registrant->id)
            ->with(['scoringcomponent'])            
            ->get();
            
        
        foreach($scores AS $score){
            $sc= $score->scoringcomponent;           
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
