<?php

namespace App\Http\Controllers\Registrants;

use App\Http\Controllers\Controller;
use App\Models\Registrant;
use App\Models\Registranttype;

class RegisterController extends Controller
{
    public function update(Registrant $registrant)
    {
        if(
            ($registrant->registranttype_id !== Registranttype::REGISTERED) &&
            ($registrant->hasApplication) &&
            ($registrant->hasSignatures)
        ){

            $registranttype_id = Registranttype::REGISTERED;

        }elseif($registrant->hasApplication){

            $registranttype_id = Registranttype::APPLIED;

        }else{

            $registranttype_id = Registranttype::ELIGIBLE;
    }

        $registrant->update([
            'registranttype_id' => $registranttype_id,
        ]);

        return view('registrants.index');
    }
}
