<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateAuditionStatusListener
{
    private $adjudicator_count;

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
    public function handle(\App\Events\UpdateAuditionStatusEvent $event)
    {
        $registrant = \App\Models\Registrant::find($event->registrant_id);
        $eventversion = \App\Models\Eventversion::find($registrant->eventversion_id);
        $rooms = $this->registrantRooms($registrant, $eventversion);

        $this->adjudicator_count = $eventversion->eventversionconfigs->judge_count;

        //update the statuses per room
        foreach($rooms AS $room){

            \App\Models\Auditionstatus::updateOrCreate(
                [
                   'registrant_id' => $registrant->id,
                   'eventversion_id' => $eventversion->id,
                   'room_id' => $room->id,
               ],
               [
                    'auditionstatustype_id' => $this->auditionStatusTypeId($registrant, $room),
               ]
            );
        }

        //update the event status
        \App\Models\Auditionstatus::updateOrCreate(
            [
                'registrant_id' => $registrant->id,
                'eventversion_id' => $eventversion->id,
                'room_id' => 0,
            ],
            [
                'auditionstatustype_id' => $this->auditionStatusTypeIdEventversion($registrant),
            ]
        );

    }

    private function auditionStatusTypeId(\App\Models\Registrant $registrant, \App\Models\Room $room): int
    {
        $status = new \App\Models\Utility\AdjudicatedstatusRoom(['registrant' => $registrant, 'room' => $room]);

        return \App\Models\Auditionstatustype::where('descr', $status->status())->first()->id;
    }

    private function auditionStatusTypeIdEventversion(\App\Models\Registrant $registrant): int
    {
        $status = new \App\Models\Utility\Adjudicatedstatus(['registrant' => $registrant]);

        return \App\Models\Auditionstatustype::where('descr', $status->status())->first()->id;
    }

    private function registrantRooms(\App\Models\Registrant $registrant, \App\Models\Eventversion $eventversion): Collection
    {
        $instrumentationids = $registrant->instrumentations->modelKeys();

        foreach($registrant->instrumentations AS $instrumentation){

            $roomids = DB::table('rooms')
                ->join('instrumentation_room', 'instrumentation_room.room_id', '=', 'rooms.id')
                ->where('rooms.eventversion_id', '=', $eventversion->id)
                ->whereIn('instrumentation_room.instrumentation_id', $instrumentationids)
                ->pluck('rooms.id')
                ->toArray();
        }

        return \App\Models\Room::find($roomids);
    }
}
