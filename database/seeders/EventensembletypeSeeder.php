<?php

namespace Database\Seeders;

use App\Models\Eventensembletype;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventensembletypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(self::buildSeeds() AS $seed){

            Eventensembletype::create([
                'id' => $seed[0],
                'descr' => $seed[1],
                'instrumentationbranch_id' => $seed[2],
                'created_at' => $seed[3],
                'updated_at' => $seed[4],
            ]);
        }
    }

    private function buildSeeds()
    {
        return [
            [1,'sr choral (satb)',1,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [2,'jazz band',2,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [3,'jazz choir',1,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [4,'orchestra',2,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [5,'none',4,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [6,'treble choral (ssaa)',1,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [7,'elementary (dsa)',1,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [8,'mixed',3,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [9,'band',2,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [10,'wind ensemble',2,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [11,'instrumental',2,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [12,'children (dsa)',1,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [13,'choral',1,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [14,'string orchestra',2,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [15,'other',3,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [16,'lower voices (ttbb)',1,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [17,'tone chimes',2,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
            [18,'jr choral (ssaatb)',1,'2021-07-27 14:37:00','2021-07-27 14:37:00'],
        ];
    }
}
