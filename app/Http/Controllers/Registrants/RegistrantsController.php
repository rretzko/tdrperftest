<?php

namespace App\Http\Controllers\Registrants;

use App\Http\Controllers\Controller;
use App\Models\Eventversion;
use App\Models\Obligation;
use App\Models\Userconfig;
use App\Traits\ExceptionsTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegistrantsController extends Controller
{
    use ExceptionsTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Eventversion $eventversion)
    {
        //set userconfigs
        Userconfig::setValue('eventversion',auth()->id(),$eventversion->id);
        Userconfig::setValue('event',auth()->id(),$eventversion->event->id);
        Userconfig::setValue('organization',auth()->id(),$eventversion->event->organization->id);

        if($eventversion->obligationMet(auth()->id())){

            return $this->show($eventversion);

        }else{

            return view('eventversions.obligations', [
                'eventversion' => $eventversion,
                'exception' => $this->exceptions(),
                ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
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
     * @param  App\Models\Eventversion $eventversion
     * @return Response
     */
    public function show(Eventversion $eventversion)
    {
        //set userconfigs
        Userconfig::setValue('eventversion', auth()->id(), $eventversion->id);
        Userconfig::setValue('event',auth()->id(),$eventversion['event']->id);
        Userconfig::setValue('organization',auth()->id(),$eventversion['event']['organization']->id);

        return view('registrants.index',
            [
                'exception' => $this->exceptions(),
            ]
        );
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
