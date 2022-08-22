<?php

namespace App\Mail;

use App\Models\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MembershipRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $datatable;
    public $event;
    public $sendto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, Person $sendto, $datatable)
    {
        $this->datatable = $datatable;
        $this->event = $event;
        $this->sendto = $sendto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.membershiprequest', ['event' => $this->event, 'sendto' => $this->sendto, 'datatable' => $this->datatable ]);
    }
}
