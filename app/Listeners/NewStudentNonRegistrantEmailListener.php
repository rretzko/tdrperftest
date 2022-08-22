<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewStudentNonRegistrantEmailListener 
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
    public function handle(\App\Events\NewStudentNonRegistrantEmailEvent $event)
    {dd(__FILE__) ;
        \App\Mail::to('rick@mfrholdings.com')
            ->send(new NewStudentNonRegistrantMail($event));

    }
}
