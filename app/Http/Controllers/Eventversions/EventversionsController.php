<?php

namespace App\Http\Controllers\Eventversions;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Eventversion;
use App\Models\Membereventversion;
use App\Models\Userconfig;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventversionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $eventversions = Membereventversion::open();

        //early exit: if only one eventversion is open,
        // skip displaying the eventversions page and
        // directly display that eventversion's registrants
        if($eventversions->count() === 1){

            $eventversion = $eventversions->first();

            Userconfig::setValue('eventversion', auth()->id(), $eventversion->id);
            Userconfig::setValue('event', auth()->id(), $eventversion->event->id);
            Userconfig::setValue('organization', auth()->id(), $eventversion->event->organization->id);

            if($eventversion->dates('results_release') !== 'not found'){

                return redirect(route('auditionresults.index', [$eventversion]));

            }elseif($eventversion->obligationMet(auth()->id())){

                return $this->show($eventversion);

            }else{

                return view('eventversions.obligations', ['eventversion' => $eventversions->first()]);
            }
        }

        //else display choice of eventversions
        return view('eventversions.index');
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
     * @param  Eventversion $eventversion
     * @return Response
     */
    public function show(Eventversion $eventversion)
    {
        //set userconfigs
        Userconfig::setValue('eventversion', auth()->id(), $eventversion->id);
        Userconfig::setValue('event',auth()->id(),$eventversion['event']->id);
        Userconfig::setValue('organization',auth()->id(),$eventversion['event']['organization']->id);

        return view('registrants.index');
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
