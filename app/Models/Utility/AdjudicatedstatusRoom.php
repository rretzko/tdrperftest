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
//        $this->scores = $this->roomScores();
        $this->scores = $this->roomScoresV2();

        //Count of component scores registered for $this->registrant in $this->room
        $this->countregistrantscores = $this->scores->count();
    }

    private function completed()
    {
        return $this->countregistrantscores === $this->countscores;
    }

    private function countScores()
    {
//        $cntr = 0;
        $filecontenttypeids = $this->room->filecontenttypes->modelKeys();
        
        return \App\Models\Scoringcomponent::where('eventversion_id', $this->eventversion->id)
            ->whereIn('filecontenttype_id',$filecontenttypeids)            
            ->count();

        /*
            foreach(\App\Models\Scoringcomponent::where('eventversion_id', $this->eventversion->id)->get() AS $scoringcomponent){

                $cntr += (in_array($scoringcomponent->filecontenttype_id, $filecontenttypeids));
            }
         * 
            return $cntr;
         *
         */

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
    private function roomScoresV2()
    {        
//        $registrantscores = new \App\Models\Utility\Registrantscores(['registrant' => $this->registrant]);

//        $scores = $registrantscores->componentscores();
        $scoresCount = $this->registrant->scores->count();

        //early exit
        if (!$scoresCount) {
            return collect([]);
        }
        
        $eventVersionId = \App\Models\Userconfig::getValue('eventversion', auth()->id());

        $adjudicatorsIds = $this->adjudicators->pluck('id');

        $roomscores = \App\Models\Score::query()
            ->where('scores.eventversion_id', $eventVersionId)
            ->where('scores.registrant_id', $this->registrant->id)
            ->join('adjudicators', 'adjudicators.user_id', '=', 'scores.user_id')
            ->whereIn('adjudicators.id', $adjudicatorsIds)
            ->where('adjudicators.room_id', $this->room->id)
            ->where('adjudicators.eventversion_id', $eventVersionId)
            ->get();

        return  $roomscores;        
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
