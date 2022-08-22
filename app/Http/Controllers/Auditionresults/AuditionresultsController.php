<?php

namespace App\Http\Controllers\Auditionresults;

use App\Http\Controllers\Controller;
use App\Models\Userconfig;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class AuditionresultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(\App\Models\Eventversion $eventversion)
    {
        Userconfig::setValue('eventversion', auth()->id(), $eventversion->id);
        Userconfig::setValue('event', auth()->id(), $eventversion->event->id);
        Userconfig::setValue('organization', auth()->id(), $eventversion->event->organization->id);

        $registrants = \App\Models\Registrant::where('school_id', \App\Models\Userconfig::getValue('school', auth()->id()))
            ->where('registranttype_id', \App\Models\Registranttype::REGISTERED)
            ->where('eventversion_id', $eventversion->id)
            ->get()
            ->sortBy('student.person.last');

        return view('auditionresults.index',
        [
            'eventversion' => $eventversion,
            'registrants' => $registrants,
            'scoresummary' => new \App\Models\Scoresummary,
            'scorestable' => NULL,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Registrant $registrant)
    {
        $eventversion = \App\Models\Eventversion::find(\App\Models\Userconfig::getValue('eventversion', auth()->id()));

        $registrants = \App\Models\Registrant::where('school_id', \App\Models\Userconfig::getValue('school', auth()->id()))
            ->where('registranttype_id', \App\Models\Registranttype::REGISTERED)
            ->where('eventversion_id', $eventversion->id)
            ->get()
            ->sortBy('student.person.last');

        $scorestable = $this->buildScoresTable($eventversion,$registrant);

        return view('auditionresults.index',
            [
                'eventversion' => $eventversion,
                'registrants' => $registrants,
                'scoresummary' => new \App\Models\Scoresummary,
                'scorestable' => $scorestable,
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
        //
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

    /**
     * @param \App\Models\Eventversion $eventversion
     */
    public function pdf(\App\Models\Eventversion $eventversion)
    {
        $registrants = \App\Models\Registrant::where('eventversion_id', $eventversion->id)
            ->where('registranttype_id', \App\Models\Registranttype::REGISTERED)
            ->where('school_id', Userconfig::getValue('school', auth()->id()))
            ->get()
            ->sortBy('student.person.last');

        $score = new \App\Models\Score;

        $scoresummary = new \App\Models\Scoresummary;

        //ex. pages.pdfs.applications.12.64.application
        $pdf = PDF::loadView('pdfs.auditionresults.'//9.65.2021_22_application',
            . $eventversion->event->id
            .'.'
            . $eventversion->id
            . '.auditionresults',
            //.applicationTest',
            compact('eventversion', 'registrants','score','scoresummary'));


        return $pdf->download('auditionresults_'.str_replace(' ','_',$eventversion->short_name).'.pdf');
    }

    private function buildScoresTable($eventversion, $registrant)
    {
        $scores = \App\Models\Score::where('registrant_id', $registrant->id)->get();
        $scoringcomponents = \App\Models\Scoringcomponent::where('eventversion_id', $eventversion->id)->get();

        $str = '';

        $str .= '<table>';
        foreach($scores AS $score){

            $str .= '<tr>';
                $str .= '<td>Judge '.$score->user_id.'</td>';
                $str .= '<td>SC id '.$score->scoringcomponent_id.'</td>';
                $str .= '<td>Score: '.$score->score.'</td>';
            $str .= '</tr>';
        }
        $str .= '</table>';

        return $str;


        return $str;
    }

}
