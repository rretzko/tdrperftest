<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewStudentNonRegistrantEmailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $eventversion;
    public $reasons;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Models\User $user, \App\Models\Eventversion $eventversion, array $reasons)
    {
        $this->eventversion = $eventversion;
        $this->reasons = $reasons;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
