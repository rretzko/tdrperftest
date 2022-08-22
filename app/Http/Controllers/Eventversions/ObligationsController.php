<?php

namespace App\Http\Controllers\Eventversions;

use App\Http\Controllers\Controller;
use App\Models\Eventversion;
use App\Models\Obligation;
use App\Models\Userconfig;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ObligationsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $eventversion = Eventversion::find(Userconfig::getValue('eventversion', auth()->id()));
        $eventversionid = $eventversion->id;
        $eventid = $eventversion->event->id;

        $link = '<x-obligations.'.$eventid.'.'.$eventversionid.'.obligations />';

        Obligation::create([
            'user_id' => auth()->id(),
            'eventversion_id' => $eventversionid,
            'acknowledgment' => 1,
            'link' => $link,
        ]);

        return view('registrants.index',['exception' => false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
