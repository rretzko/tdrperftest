<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scoresummary extends Model
{
    use HasFactory;

    public $registrant_id;

    protected $fillable = ['eventversion_id', 'instrumentation_id','registrant_id', 'result',
        'score_count', 'score_total'];

    private $count;
    private $instrumentation_id;
    private $scores;
    private $total;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->count = 0;
        $this->instrumentation_id;
        $this->result = 'inc'; //default
        $this->scores = NULL;
        $this->total = 0;
    }

    public function updateStats()
    {
        $this->scores = Score::where('registrant_id', $this->registrant_id);

        $this->calcCount();

        $this->calcTotal();

        $this->findInstrumentationId();

        $this->calcResult();

        $this->updateRow();
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    private function calcCount()
    {
        $this->count = $this->scores->count();
    }

    private function calcResult()
    {
        $this->result = 'inc'; //default

        $registrant = Registrant::find($this->registrant_id);
        $eventversion = Eventversion::find($registrant->eventversion_id);
        $countscoringcomponents = ($eventversion->scoringcomponents->count() * $eventversion->eventversionconfigs->judge_count);

        if($this->count == $countscoringcomponents){
            $this->result = 'pend';
        }
    }

    private function calcTotal()
    {
        $this->total = 0;

        foreach($this->scores->get() AS $score){

            $this->total += ($score->score * $score['scoringcomponent']->multiplier);
        }
    }

    private function findInstrumentationId()
    {
        $registrant = \App\Models\Registrant::find($this->registrant_id);

        $this->instrumentation_id = $registrant->instrumentations()->first()->id;
    }

    public function registrantScore(\App\Models\Registrant $registrant)
    {
        return $this->where('registrant_id', $registrant->id)
            ->value('score_total');
    }

    public function registrantResult(\App\Models\Registrant $registrant)
    {
        return $this->where('registrant_id', $registrant->id)
            ->value('result');
    }

    private function updateRow()
    {
        $this->updateOrCreate(
            [
               'eventversion_id' => \App\Models\Userconfig::getValue('eventversion', auth()->id()),
               'registrant_id' => $this->registrant_id,
               'instrumentation_id' => $this->instrumentation_id,
           ],
           [
               'score_total' => $this->total,
               'score_count' => $this->count,
               'result' => $this->result,
           ],
        );
    }
}
