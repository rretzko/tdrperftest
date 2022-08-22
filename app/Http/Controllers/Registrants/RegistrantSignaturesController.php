<?php

namespace App\Http\Controllers\Registrants;

use App\Events\UpdateRegistrantStatusEvent;
use App\Http\Controllers\Controller;
use App\Models\Registrant;
use App\Models\Signature;
use App\Models\Signaturetype;
use App\Traits\UpdateRegistrantStatusTrait;
use Carbon\Carbon;

class RegistrantSignaturesController extends Controller
{
    use UpdateRegistrantStatusTrait;

    public function update(Registrant $registrant)
    {
        if($registrant->hasSignatures){

            //nullify the 'confirmed' value for the teacher's signature if it currently exists
            $this->updateSignature($registrant->id, Signaturetype::TEACHER, NULL);

        }else{

            //update the registrant's record with ALL signaturetypes
            foreach(Signaturetype::all() AS $signaturetype){

                $this->updateSignature($registrant->id, $signaturetype->id, Carbon::now());
            }
        }

        $registrant->fresh();

        $this->updateRegistrantStatus($registrant);

        return back();
    }

    private function updateSignature($registrant_id, $signaturetype_id, $confirmed)
    {
        Signature::updateOrCreate(
            [
                'registrant_id' => $registrant_id,
                'signaturetype_id' => $signaturetype_id,
            ],
            [
                'confirmed' => $confirmed,
                'confirmed_by' => auth()->id(),
            ],
        );
    }
}
