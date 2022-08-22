<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjudicatedstatus extends Model
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
        $this->room = (isset($attributes['room'])) ?: NULL; //$attributes['room'];
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
        //Count of  component scores possible for $this->eventversion
        $this->countscores = \App\Models\Scoringcomponent::where('eventversion_id', $this->eventversion->id)->count();

        //Object to access all scores for $this->registrant
        $this->scores = new \App\Models\Utility\Registrantscores([ 'registrant' => $this->registrant]);

        //Count of component scores registered for $this->registrant
        $this->countregistrantscores = $this->scores->componentscores()->count();

        //Adjudicators registered for $this->registrant
        $this->adjudicators = $this->room ? $this->room->adjudicators : NULL;
    }

    private function completed()
    {
        return $this->countregistrantscores === $this->countscores;
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
     * Return true if OUT of tolerance
     * @todo TEST FOR ADJUDICATOR ASSIGNED TO TWO ROOMS with SAME and DIFFERENT REGISTRANT POOLS
     * @return bool
     */
    private function tolerance()
    {
        if($this->adjudicators){

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

        return false;  //default = no one is out of tolerance
    }

    private function unauditioned()
    {
        return (! $this->countregistrantscores);
    }
}
