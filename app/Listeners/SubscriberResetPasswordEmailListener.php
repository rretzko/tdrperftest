<?php

namespace App\Listeners;

use App\Events\SubscriberPasswordResetEvent;
use App\Mail\SubscriberPasswordResetMail;
use App\Models\Person;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SubscriberResetPasswordEmailListener
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
    public function handle(SubscriberPasswordResetEvent $event)
    {
        $bcc = 'e@mfrholdings.com';

        Mail::to($event->email->email)
            ->bcc($bcc)
            ->send(new SubscriberPasswordResetMail($event));
    }
}
