<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditionsuitestatus extends Model
{
    use HasFactory;

    /**
     * status levels:
     *  - events = has directors in tdr and is using afdc for events
     *  - none = no directors on tdr
     *  - tdr = directors on tdr with $organization
     * @return string
     */
    static public function status($organization)
    {
        $statuses = [];

        $hasEvents = (bool)Event::where('organization_id', $organization->id)->first();

        if($hasEvents){

            $statuses[] = '<span class="text-blue-600">auds</span>';
        }

        if($organization['memberships']->count()){

            $statuses[] = '<span class="text-blue-600">tdr</span>';
        }

        return ($statuses) ? implode(', ', $statuses) : '<span class="text-gray-400">none</span>';
    }
}
