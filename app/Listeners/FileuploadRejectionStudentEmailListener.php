<?php

namespace App\Listeners;

use App\Events\FileuploadRejectionEvent;
use App\Mail\FileuploadRejectionMail;
use App\Mail\MembershipRequestMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class FileuploadRejectionStudentEmailListener
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
     * @param FileuploadRejectionEvent $event
     * @return void
     */
    public function handle(FileuploadRejectionEvent $event)
    {
        $emails = $event->registrant->student->nonsubscriberemails;

        $ccemail = (auth()->user()->subscriberemailwork)
            ? auth()->user()->subscriberemailwork
            : 'e@mfrholdings.com';  //temporary catch basin for recording mailing

        foreach($emails AS $email){

            Mail::to($email->email)
                ->cc($ccemail)
                ->send(new FileuploadRejectionMail($event, $email->email));
        }
    }
}
