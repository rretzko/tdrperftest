<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateScoreSummaryListener
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
    public function handle(\App\Events\UpdateScoreSummaryEvent $event)
    {
        //update score total and count
        $scoresummary = new \App\Models\Scoresummary;
        $scoresummary->registrant_id = $event->registrant_id;
        $scoresummary->updateStats();
    }
}
