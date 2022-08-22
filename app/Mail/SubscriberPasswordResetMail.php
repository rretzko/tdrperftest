<?php

namespace App\Mail;

use App\Events\FileuploadRejectionEvent;
use App\Events\SubscriberPasswordResetEvent;
use App\Models\Person;
use App\Models\Subscriberemail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class SubscriberPasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $person;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SubscriberPasswordResetEvent $event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $token = URL::temporarySignedRoute('resetpassword.tdr', now()->addHours(12),['user' => $this->event->email->user_id]);

        $person = Person::find($this->event->email->user_id);

        return $this->view('mails.subscriberpasswordreset',
            [
                'first' => $person->first,
                'token' => $token,
                'username' => $person->user->username,
            ]);
    }
}
