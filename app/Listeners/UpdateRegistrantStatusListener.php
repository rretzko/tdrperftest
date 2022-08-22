<?php

namespace App\Listeners;

use App\Events\UpdateRegistrantStatusEvent;
use App\Models\Eventversion;
use App\Models\Registranttype;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateRegistrantStatusListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UpdateRegistrantStatusEvent $event)
    {
        $eventversion = Eventversion::find($event->registrant->eventversion_id);
        $registrant = $event->registrant;

        if(
            $registrant->hasApplication &&
            $registrant->instrumentations->count() &&
            $registrant->hasSignatures &&
            $registrant->hasFileuploads
        ){
            $registranttype_id = Registranttype::REGISTERED;

        }elseif($registrant->hasApplication){

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

        $registrant->registranttype_id = $registranttype_id;
        $registrant->save();
    }
}
