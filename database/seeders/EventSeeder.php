<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    private $seeds;

    public function __construct()
    {
        //instantiate $this->seeds with teacher data
        $this->seeds = $this->buildSeeds();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->seeds as $seed) {

            $model = new Event();

            $model->id = $seed[0];
            $model->name = $seed[1];
            $model->short_name = $seed[2];
            $model->organization_id = $seed[3];
            $model->auditioncount = $seed[4];
            $model->frequency = $seed[5];
            $model->grades = $seed[6];
            $model->status = $seed[7];
            $model->first_event = $seed[8];
            $model->logo_file = $seed[9];
            $model->logo_file_alt = $seed[10];
            $model->requiredheight = $seed[11];
            $model->requiredshirtsize = $seed[12];
            $model->created_at = $seed[13];
            $model->updated_at = $seed[14];

            $model->save();
        }
    }

    private function buildSeeds()
    {
        return [
            //EVENTS
            [1,'CJMEA High School Chorus','Region II Chorus',1,1,'annual','9,10,11,12','active',2017,'cjmeaLogo.png','CJMEA Region II MIxed and Treble Chorus',0,0,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
            [9,'NJ All-State Chorus','NJ A-S Chorus',3,1,'annual','9,10,11','active',1958,'njmeaLogo_transparent.png','NJMEA logo',0,0,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
            [11,'South Jersey Junior High School Chorus','SJCDA Jr.HS',8,1,'annual','7,8,9','active',1961,'sjcdaLogo_transparent.png','SJCDA logo',0,0,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
            [12,'South Jersey Senior High School Chorus','SJCDA Sr.HS',8,1,'annual','10,11,12','active',1957,'sjcdaLogo_transparent.png','SJCDA logo',0,0,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
            [14,'AE Demo','AE Demo',3,1,'annual','9,10,11,12','inactive',1935,'','',0,0,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
            [17,'New Jersey All-State Orchestra','NJ A-S Orchestra',3,1,'annual','9,10,11','inactive',2017,'logo_beta.png','NJ All-Shore Chorus',0,0,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
            [18,'NJ All-State Jazz Ensemble','NJ A-S Jazz Ens',3,1,'annual','9,10,11','inactive',2017,'','',0,0,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
            [19,'All-Shore Chorus','All-Shore Chorus',9,1,'annual','9,10,11,12','active',2017,'','',1,1,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
            [20,'NJ All-State Honors Jazz Chorus','NJ A-S Jazz Chr',3,1,'annual','9,10,11','inactive',2017,'','',0,0,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
            [21,'NJ All-State Housing: Chorus &amp; Orchestra','NJ A-S Hsng C&amp;O',3,1,'annual','9,10,11','inactive',2017,'','',0,0,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
            [22,'NJ All-State Housing: Jazz Ensemble &amp; Honors Chorus','NJ A-S Hsng Jazz',3,1,'annual','9,10,11','inactive',2017,'','',0,0,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
            [23,'South Jersey Elementary School Choir','SJCDA Elem',8,1,'annual','4,5,6','active',2020,'sjcdaLogo_transparent.png','sjcda logo',0,0,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
            [24,'Mass All-State','MMEA AS',4,1,'annual','9,10,11,12','sandbox',2020,'','',0,0,'2021-07-27 10:50:00','2021-07-27 10:50:00'],
        ];
    }
}
