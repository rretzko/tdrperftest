<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjudicatedstatusRoom extends Model
{
    use HasFactory;

    private $eventversion;
    private $countroomscores;
    private $countscores;
    private $registrant;
    private $registrantscores;
    private $room;
    private $scores;
    private $status;

    protected $fillable = ['registrant','room'];

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->registrant = $attributes['registrant'];
        $this->room = $attributes['room'];
        $this->eventversion = $this->registrant->eventversion;
        $this->status = 'unauditioned';

        $this->init();
    }

    public function status()
    {
        if($this->unauditioned()){
            return 'unauditioned';
        }elseif($this->tolerance()){
            return 'tolerance';
        }elseif($this->partial()) {
            return 'partial';
        }elseif($this->excess()){
            return 'excess';
        }elseif($this->completed()) {
            return 'completed';
        }else{
            return 'error';
        }
    }
    /** END OF PUBLIC PROPERTIES *************************************************/

    private function init()
    {
        //Adjudicators registered for $this->registrant
        $this->adjudicators = $this->room->adjudicators;

        //Count of  component scores possible for $this->eventversion in $this->room
        $this->countscores = ($this->countScores() * $this->adjudicators->count());

        //Object to access all scores for $this->registrant in $this->room
        $this->scores = $this->roomScores();

        //Count of component scores registered for $this->registrant in $this->room
        $this->countregistrantscores = $this->scores->count();
    }

    private function completed()
    {
        return $this->countregistrantscores === $this->countscores;
    }

    private function countScores()
    {
        $cntr = 0;
        $filecontenttypeids = $this->room->filecontenttypes->modelKeys();

        foreach(\App\Models\Scoringcomponent::where('eventversion_id', $this->eventversion->id)->get() AS $scoringcomponent){

            $cntr += (in_array($scoringcomponent->filecontenttype_id, $filecontenttypeids));
        }

        return $cntr;
    }

    private function excess()
    {
        return $this->countregistrantscores > $this->countscores;
    }

    private function partial()
    {
        return $this->countregistrantscores < $this->countscores;
    }

    /**
     * Return a collection of scores specific to $this->room
     *
     * @return \Illuminate\Support\Collection
     */
    private function roomScores()
    {
        $roomscores = collect();
        $registrantscores = new \App\Models\Utility\Registrantscores([ 'registrant' => $this->registrant]);
        $scores = $registrantscores->componentscores();

        //early exit
        if(! $scores){ return $roomscores;}

        foreach($scores AS $score){

            if($this->adjudicators->contains(
                \App\Models\Adjudicator::where('user_id',$score->user_id)
                    ->where('eventversion_id', \App\Models\Userconfig::getValue('eventversion', auth()->id()))
                    ->where('room_id', $this->room->id)
                    ->first())){

                $roomscores->push($score);
            }
        }

        return $roomscores;
    }

    /**
     * Return true if OUT of tolerance
     * @todo TEST FOR ADJUDICATOR ASSIGNED TO TWO ROOMS with SAME and DIFFERENT REGISTRANT POOLS
     * @return bool
     */
    private function tolerance()
    {
        //container for total scores
        $scores = [];

        //iterate through each of the room's adjudicators to determine their total ROOM score FOR $this->registrant
        foreach($this->adjudicators AS $adjudicator){

            $scores[] = \App\Models\Score::where('registrant_id', $this->registrant->id)
                ->where('user_id', $adjudicator->user_id)
                ->sum('score');
        }

        //Return true if OUT of tolerance
        return ((max($scores) - min($scores)) > $this->room->tolerance);
    }

    private function unauditioned()
    {
        return (! $this->countregistrantscores);
    }
}
