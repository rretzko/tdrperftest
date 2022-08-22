<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $with = ['scoringcomponent'];

    protected $fillable = ['eventversion_id', 'scoringcomponent_id', 'multiplier', 'proxy_id', 'registrant_id','score', 'user_id'];

    public function registrantScores(\App\Models\Registrant $registrant)
    {
        $scores = $this->where('registrant_id', $registrant->id)
            ->select('score', 'scoringcomponent_id')
            ->orderBy('user_id')
            ->orderBy('scoringcomponent_id')
            ->get()
            ->toArray();

        return $this->mapScores($scores);

  //      return array_column($scores,'score');
    }

    public function scoringcomponent()
    {
        return $this->belongsTo(Scoringcomponent::class);
    }

    public function mapScores($scores)
    {
        //NJ All-State Chorus; 2022
        foreach($scores AS $score){

            $scoringcomponents[$score['scoringcomponent_id']][] = $score['score'];
        }

        $scores = [
            $scoringcomponents[48][0], //judge 1, Scales Quality
            $scoringcomponents[49][0], //judge 1, Scales Low Scales
            $scoringcomponents[50][0], //judge 1, Scales High Scales
            $scoringcomponents[51][0], //judge 1, Scales Chromatic Scales
            $scoringcomponents[58][0], //judge 1, Solo Quality
            $scoringcomponents[59][0], //judge 1, Solo Intonation
            $scoringcomponents[60][0], //judge 1, Solo Musicianship
            $scoringcomponents[61][0], //judge 1, Quintet Quality
            $scoringcomponents[62][0], //judge 1, Quintet Intonation
            $scoringcomponents[63][0], //judge 1, Quintet Musicianship

            $scoringcomponents[48][1], //judge 2, Scales Quality
            $scoringcomponents[49][1], // etc.
            $scoringcomponents[50][1],
            $scoringcomponents[51][1],
            $scoringcomponents[58][1],
            $scoringcomponents[59][1],
            $scoringcomponents[60][1],
            $scoringcomponents[61][1],
            $scoringcomponents[62][1],
            $scoringcomponents[63][1],

            $scoringcomponents[48][2],
            $scoringcomponents[49][2],
            $scoringcomponents[50][2],
            $scoringcomponents[51][2],
            $scoringcomponents[58][2],
            $scoringcomponents[59][2],
            $scoringcomponents[60][2],
            $scoringcomponents[61][2],
            $scoringcomponents[62][2],
            $scoringcomponents[63][2],
        ];

        return $scores;
    }

}
