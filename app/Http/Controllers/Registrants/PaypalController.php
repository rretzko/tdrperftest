<?php

namespace App\Http\Controllers\Registrants;

use App\Models\Eventversion;
use App\Models\School;
use App\Models\Userconfig;
use App\Models\Utility\Registrants;
use App\Models\Utility\Paypalregister;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventversion = Eventversion::find(Userconfig::getValue('eventversion', auth()->id()));
        $registrationfee = $eventversion->eventversionconfigs->registrationfee;

        $registrants = Registrants::registered();
        $school = School::find(Userconfig::getValue('school', auth()->id()));

        $paypalregister = new Paypalregister;
        $paypalregister->setEventversion($eventversion);
        
        $amountduegross = ($registrants->count() * $registrationfee);
        $paypalcollected = $paypalregister->paymentsBySchool($school);
        //account for the possibility of overpayments
        $amountduenet = (($amountduegross - $paypalcollected) > 0) ? ($amountduegross - $paypalcollected) : 0;

        return view('registrants.paypal.index',
            [
                'amountduegross' =>$amountduegross,
                'amountduenet' => $amountduenet,
                'eventversion' => $eventversion,
                'paypalcollected' => $paypalcollected,
                'paypalregister' => $paypalregister,
                'registrationfee' => $registrationfee,
                'registrants' => $registrants,
                'school' => $school,
            ]
        );
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
}
