<?php

namespace Database\Seeders;

use App\Models\Eventensemble;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventensembleSeeder extends Seeder
{
    private $seeds;

    public function __construct()
    {
        $this->seeds = self::buildSeeds();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->seeds AS $seed){

            $model = new Eventensemble;

            $model->id = $seed[0];
            $model->event_id = $seed[1];
            $model->name = $seed[2];
            $model->short_name = $seed[3];
            $model->eventensembletype_id = $seed[4];
            $model->eventensemblestatustype_id = $seed[5];
            $model->user_id = $seed[6];
            $model->created_at = $seed[7];
            $model->updated_at = $seed[8];

            $model->save();
        }

    }

    private function buildSeeds()
    {
        return [
            [1,23,'SJCDA Elementary School Choir','SJCDA Elementary School Choir',12,32,386,'2020-10-20 13:53:00','2021-07-27 13:47:00'],
            [2,11,'SJCDA Junior High Chorus','SJCDA Junior High Chorus',18,32,386,'2020-10-20 13:53:00','2021-07-27 13:47:00'],
            [3,12,'SJCDA Senior High Chorus','SJCDA Senior High Chorus',1,32,386,'2020-10-20 13:53:00','2021-07-27 13:47:00'],
            [5,19,'2021 All-Shore Chorus','2021 A-S Chorus',1,32,386,'2020-10-20 13:53:00','2021-07-27 13:47:00'],
            [20,9,'NJ All-State Mixed Chorus','NJ A-S Mixed',1,32,368,'2020-10-20 13:53:00','2021-07-27 13:47:00'],
            [21,9,'NJ All-State Treble Chorus','NJ A-S Treble',6,32,368,'2020-10-20 13:53:00','2021-07-27 13:47:00'],

        ];
    }
}
