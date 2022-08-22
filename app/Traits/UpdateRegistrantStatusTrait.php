<?php

namespace App\Traits;

use App\Models\Eventversion;
use App\Models\Registrant;
use App\Models\Registranttype;
use App\Models\Signature;

trait UpdateRegistrantStatusTrait
{
    /**
     * @since 2021.08.16
     *
     * Trait for updating $registrant status

     * @return string
     */
    public function updateRegistrantStatus(Registrant $registrant)
    {
        $eventversion = Eventversion::find($registrant->eventversion_id);
        $signature = new Signature();
        $eapplication = new \App\Models\Eapplication;

        if(
            $registrant->hasApplication &&
            $registrant->hasInstrumentation &&
            ($eventversion->requiredSignaturesCount == $signature->countForRegistrant($registrant)) &&
            $registrant->hasFileuploads
        ){
            $registranttype_id = Registranttype::REGISTERED;

        }elseif( //SJCDA
            (($eventversion->id === 66) || ($eventversion->id === 67)) &&
            ($eventversion->requiredSignaturesCount == $eapplication->countSignatures($registrant))) {

            $registranttype_id = Registranttype::REGISTERED;

        }elseif( //All-Shore
            ($eventversion->id === 69) &&
            ($eventversion->requiredSignaturesCount == $eapplication->countSignatures($registrant)) &&
            $registrant->hasFileuploads
        ){
                $registranttype_id = Registranttype::REGISTERED;

        }elseif(//CJMEA
            ($eventversion->id === 70) &&
            $registrant->hasApplication &&
            $registrant->signatureConfirmation
            ){

            $registranttype_id = Registranttype::REGISTERED;

        }elseif($registrant->hasApplication) {

            $registranttype_id = Registranttype::APPLIED;

        }else{

            $registranttype_id = Registranttype::ELIGIBLE;
        }
        /*
        echo 'application: '.$registrant->hasApplication.'<br />';
        echo 'instrumentations: '.$registrant->instrumentations->count().'<br />';
        echo 'signatures: '.$registrant->hasSignatures.'<br />';
        echo 'file uploads: '.$registrant->hasFileuploads.'<br />';
        dd('registranttype_id: '.$registranttype_id);
        */

        $registrant->update(['registranttype_id' => $registranttype_id]);
    }
}
