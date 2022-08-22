<?php

namespace App\Http\Controllers\Siteadministration;

use App\Http\Controllers\Controller;
use App\Models\Eventversion;
use App\Models\Registrant;
use App\Models\Scoresummary;
use App\Models\Userconfig;
use Illuminate\Http\Request;

class ParticipatingstudentstableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventversion = Eventversion::find(Userconfig::getValue('eventversion', auth()->id()));
        $participating = $this->participating($eventversion);

        return view('siteadministrator.participatingstudentstables.index',
        [
           'eventversion' => $eventversion,
            'participating' => $participating,
            'scoresummary' => new Scoresummary,
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
    public function show($id)
    {
        //
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

    private function participating(Eventversion $eventversion)
    {
        $a = [];
        $a['MX'] =  Registrant::whereIn('id', Scoresummary::where('eventversion_id', $eventversion->id)
            ->where('result', 'MX')
            ->pluck('registrant_id')
            ->toArray())
            ->get();

        $a['TB'] = Registrant::whereIn('id', Scoresummary::where('eventversion_id', $eventversion->id)
            ->where('result', 'TB')
            ->pluck('registrant_id')
            ->toArray())
            ->get();

        return $a;
    }
}
