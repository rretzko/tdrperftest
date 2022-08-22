<?php

namespace App\Http\Controllers\Registrants;

use App\Http\Controllers\Controller;
use App\Models\Eventversion;
use App\Models\Payment;
use App\Models\Paymenttype;
use App\Models\Registrant;
use App\Models\User;
use App\Models\Userconfig;
use App\Models\Utility\Registrants;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegistrantPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('registrants.payments.index',
        [
            'eventversion' => Eventversion::with('event')
                ->where('id', Userconfig::getValue('eventversion', auth()->id()))
                ->first(),
            'payer' => new Registrant,
            'paymenttypes' => Paymenttype::all(),
            'registrants' => Registrants::eligible(),
        ]);
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
        $data = $request->validate([
            'amount' => ['required', 'numeric'],
            'payment_id' => ['required', 'numeric'],
            'paymenttype_id' => ['required', 'numeric'],
            'registrant_id' => ['required', 'numeric'],
            'vendor_id' => ['nullable', 'string'],
        ]);

        $user_id = ($data['registrant_id'])
            ? Registrant::find($data['registrant_id'])->user_id
            : Payment::find($data['payment_id'])->user_id;

        Payment::create([
            'user_id' => $user_id,
            'registrant_id' => $data['registrant_id'],
            'eventversion_id' => Userconfig::getValue('eventversion', auth()->id()),
            'paymenttype_id'=> $data['paymenttype_id'],
            'school_id' => Userconfig::getValue('school', auth()->id()),
            'vendor_id' => $data['vendor_id'],
            'amount' => $data['amount'],
            'updated_by' => auth()->id(),
        ]);

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  Registrant $registrant
     * @return Response
     */
    public function show(Registrant $registrant)
    {
        return view('registrants.payments.index',
            [
                'eventversion' => Eventversion::with('event')
                    ->where('id', Userconfig::getValue('eventversion', auth()->id()))
                    ->first(),
                'payer' => $registrant,
                'paymenttypes' => Paymenttype::all(),
                'registrants' => Registrants::eligible(),
            ]);

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
