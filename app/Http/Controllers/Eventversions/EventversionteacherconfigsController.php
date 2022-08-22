<?php

namespace App\Http\Controllers\Eventversions;

use App\Http\Controllers\Controller;
use App\Models\Eventversion;
use App\Models\Eventversionteacherconfig;
use App\Models\Userconfig;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventversionteacherconfigsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\eventversionteacherconfig  $eventversionteacherconfig
     * @return Response
     */
    public function show(eventversionteacherconfig $eventversionteacherconfig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\eventversionteacherconfig  $eventversionteacherconfig
     * @return Response
     */
    public function edit(eventversionteacherconfig $eventversionteacherconfig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * The sole configuration is paypalstudent
     *
     * @param Request $request
     * @param Eventversion $eventversion
     * @return Response
     */
    public function update(Request $request, Eventversion $eventversion)
    {
        $user_id = auth()->id();
        $eventversion_id = $eventversion->id;
        $school_id = Userconfig::getValue('school', $user_id);
        $paypalstudent = 1;

        $model = Eventversionteacherconfig::where('user_id', auth()->id())
            ->where('eventversion_id', $eventversion_id)
            ->where('school_id', $school_id)
            ->first() ?? NULL;

        if(($model) && ($model->paypalstudent)) {
            $paypalstudent = 0;
        }

        Eventversionteacherconfig::updateOrCreate(
            [
                'user_id' => $user_id,
                'school_id' => $school_id,
                'eventversion_id' => $eventversion_id,
            ],
            [
                'paypalstudent' => $paypalstudent,
            ]
        );

        return redirect(route('registrants.index', [$eventversion]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\eventversionteacherconfig  $eventversionteacherconfig
     * @return Response
     */
    public function destroy(eventversionteacherconfig $eventversionteacherconfig)
    {
        //
    }
}
