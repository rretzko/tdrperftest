<?php

namespace App\Http\Controllers\Registrants;

use App\Models\Eventversion;
use App\Http\Controllers\Controller;
use App\Models\Inpersonaudition;
use App\Models\Registrant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InpersonauditionController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Eventversion $eventversion
     * @param \App\Registrant $registrant
     * @return Response
     */
    public function update(Eventversion $eventversion, Registrant $registrant)
    {
        $state = ($registrant->inpersonaudition)
            ? $registrant->inpersonaudition->inperson
            : 0;

        $inperson = ($state) ? 0 : 1;

        Inpersonaudition::updateOrCreate(
            [
                'eventversion_id' => $eventversion->id,
                'registrant_id' => $registrant->id,
            ],
            [
                'user_id' => auth()->id(),
                'inperson' => $inperson,
            ]
        );

        return redirect(route('registrant.show', [$registrant]));
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
