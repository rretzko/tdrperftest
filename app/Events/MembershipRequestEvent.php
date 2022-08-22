<?php

namespace App\Events;

use App\Models\Organization;
use App\Models\Person;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MembershipRequestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $organization;
    public $requester;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Organization $organization, Person $requester)
    {
        $this->organization = $organization;
        $this->requester = $requester;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
