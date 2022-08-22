<?php

namespace App\Http\Controllers\Registrants;

use App\Http\Controllers\Controller;
use App\Models\Eventversion;
use App\Models\Registrant;
use App\Models\Registranttype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrantAdjudicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Eventversion $eventversion)
    {
        $adjudicator = \App\Models\Adjudicator::with('user','user.person')
            ->where('user_id', auth()->id())
            ->where('eventversion_id', $eventversion->id)
            ->first();

        $registrants = $adjudicator->registrants;

        $registrantscount = 0;
        foreach($registrants AS $collection){
            $registrantscount += $collection->count();
        }

        return view('registrants.adjudication.index', [
            'eventversion' => $eventversion,
            'room' => \App\Models\Room::with('adjudicators')->where('id', $adjudicator->room_id)->first(),
            'registrants' => $registrants,
            'registrantscount' => $registrantscount,
            'auditioner' => null,
            'scoringcomponents' => null,
            'useradjudicator' => \App\Models\Adjudicator::find(auth()->id()),
            'viewers' => $this->viewers(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id //registrant->id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auditioner = \App\Models\Registrant::find($id);
        $eventversion = Eventversion::find(\App\Models\Userconfig::getValue('eventversion', auth()->id()));

        $useradjudicator = \App\Models\Adjudicator::with('user','user.person')
            ->where('user_id', auth()->id())
            ->where('eventversion_id', $eventversion->id)
            ->first();

        $scoringcomponents = \App\Models\Scoringcomponent::where('eventversion_id', $eventversion->id)->get();

        $registrants = $useradjudicator->registrants;

        $registrantscount = 0;
        foreach($registrants AS $collection){
            $registrantscount += $collection->count();
        }

        return view('registrants.adjudication.index', [
            'eventversion' => $eventversion,
            'room' => \App\Models\Room::with('adjudicators')->where('id', $useradjudicator->room_id)->first(),
            'registrants' => $registrants,
            'registrantscount' => $registrantscount,
            'auditioner' => $auditioner,
            'scoringcomponents' => $scoringcomponents,
            'useradjudicator' => $useradjudicator,
            'viewers' => $this->viewers(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->validate([
           'scoringcomponents' => ['required', 'array'],
           'scoringcomponents.*' => ['required', 'numeric'],
        ]);

        $eventversion = Eventversion::find(\App\Models\Userconfig::getValue('eventversion', auth()->id()));

        foreach($inputs['scoringcomponents'] AS $scoringcomponent_id => $score) {

            \App\Models\Score::updateOrCreate(
                [
                    'eventversion_id' => $eventversion->id,
                    'scoringcomponent_id' => $scoringcomponent_id,
                    'registrant_id' => $id,
                    'user_id' => auth()->id(),
                ],
                [
                    'proxy_id' => auth()->id(),
                    'score' => $score,
                ]
            );
        }

        event(new \App\Events\UpdateScoreSummaryEvent($id));

        event(new \App\Events\UpdateAuditionStatusEvent($id));

        //auto-advance to next registered registrant
        return $this->show($this->findNextRegistrant($id));//$this->index($eventversion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function findNextRegistrant($id)
    {
        $registrant = Registrant::find($id);

        return DB::table('registrants')
            ->join('instrumentation_registrant', 'instrumentation_registrant.registrant_id','=','registrants.id')
            ->where('eventversion_id', '=', $registrant->eventversion_id)
            ->where('instrumentation_registrant.instrumentation_id', '=',$registrant->instrumentations->first()->id)
            ->where('registrants.id', '>', $registrant->id)
            ->where('registrants.registranttype_id', '=', Registranttype::REGISTERED)
            ->orderBy('registrants.id')
            ->limit(1)
            ->value('id');
    }

    private function viewers()
    {
        return [228,3,43,187,307,55,125,259,200,33,237,265,398,122,222,105,44];
    }
}
