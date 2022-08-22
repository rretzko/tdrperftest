<?php

namespace App\Mail;

use App\Events\FileuploadRejectionEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileuploadRejectionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $sendto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(FileuploadRejectionEvent $event, $sendto)
    {
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
        return $this->view('mails.fileuploadrejection',
            [
                'filecontenttype' => $this->event->filecontenttype,
                'registrant' => $this->event->registrant,
                'eventversion' => $this->event->eventversion,
                'sendto' => $this->sendto,
            ]);
    }
}
