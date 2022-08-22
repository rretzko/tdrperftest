<?php

namespace Database\Seeders;

use App\Models\Eventversion;
use Illuminate\Database\Seeder;

class EventversionSeeder extends Seeder
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

            $model = new Eventversion;

            $model->id = $seed[0];
            $model->event_id = $seed[1];
            $model->name = $seed[2];
            $model->short_name = $seed[3];
            $model->senior_class_of = $seed[4];
            $model->eventversiontype_id = $seed[5];
            $model->created_at = $seed[6];
            $model->updated_at = $seed[7];

            $model->save();
        }
    }

    private function buildSeeds()
    {
        return [
            //EVENTVERSIONS
            [1,12,'59th Annual Senior High Chorus','SJCDA Sr. HS Chorus',2018,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [2,11,'55th Annual Junior High Chorus','SJCDA Jr. HS Chorus',2017,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [3,9,'2017 All-State Chorus Auditions','2017 NJ All-State Chorus',2017,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [4,1,'2017 Region II Chorus Auditions','2017 RII Chorus',2017,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [5,14,'81th Annual Event Demo','81st Demo Chorus',2017,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [6,9,'2017 All-State Treble Chorus Auditions','2017 NJ All-State Treble',2017,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [7,12,'60th Annual Senior High Chorus','60th Sr HS Chorus',2018,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [8,18,'2017 All-State Jazz Ensemble Auditions','2017 NJ All-State Jazz',2017,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [9,11,'56th Annual Junior High Chorus','56th Jr. HS Chorus',2018,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [10,20,'2017 All-State Honors Jazz Chorus Auditions','2017 NJ All-State Jazz Chorus',2017,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [22,19,'2017 New Jersey All-Shore Chorus','2017 NJ All-Shore Chorus',2018,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [23,9,'2018 All-State Chorus Auditions','2018 NJ All-State Chorus',2018,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [24,1,'2018 Region II Chorus','2018 RII Chorus',2018,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [25,19,'2018 New Jersey All-Shore Chorus','2018 NJ All-Shore Chorus',2018,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [26,21,'2017 All-State Housing Chorus &amp; Orchestra','2017 Housing Chorus/Orch',2017,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [27,22,'2017 All-State Housing Jazz','2017 Housing Jazz',2017,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [28,1,'2017 Region II Treble Chorus Auditions','2017 Region II Treble Chorus',2017,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [29,1,'2018 Region II Treble Chorus Auditions','2018 Region II Treble Chorus',2018,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [30,9,'2016 All-State Chorus Auditions','2016 NJ All-State Chorus',2016,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [31,9,'2008 All-State Chorus Auditions','2008 NJ All-State Chorus',2008,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [32,9,'2009 All-State Chorus Auditions','2009 NJ All-State Chorus',2009,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [33,9,'2010 All-State Chorus Auditions','2010 NJ All-State Chorus',2010,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [34,9,'2011 All-State Chorus Auditions','2011 NJ All-State Chorus',2011,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [35,9,'2012 All-State Chorus Auditions','2012 NJ All-State Chorus',2012,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [36,9,'2013 All-State Chorus Auditions','2013 NJ All-State Chorus',2013,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [37,9,'2014 All-State Chorus Auditions','2014 NJ All-State Chorus',2014,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [38,9,'2015 All-State Chorus Auditions','2014 NJ All-State Chorus',2015,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [39,9,'2018 All-State Treble Chorus Auditions','2018 NJ All-State Treble',2018,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [43,19,'2019 New Jersey All-Shore Chorus','2019 All-Shore',2019,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [44,12,'61st Annual Senior High Chorus','61st Senior',2019,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [45,11,'57th Annual Junior High Chorus','57th Junior',2019,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [46,1,'2019 Region II Chorus','2019 Region II Mixed',2019,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [47,1,'2019 Region II Treble Chorus Auditions','2019 Treble Chorus',2019,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [48,9,'2019 All-State Chorus','2019 All-State Chorus',2019,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [49,9,'2019 All-State Treble Chorus','2019 All-State Treble',2019,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [50,23,'2019-20 SJCDA Elementary Chorus','SJCDA Elem',2020,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [51,11,'58th Annual Junior High Chorus','SJCDA Jr. High',2020,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [52,12,'62nd Annual Senior High Chorus','SJCDA Sr. High',2020,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [55,19,'2020 New Jersey All-Shore Chorus','2020 All-Shore',2020,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [56,1,'2020 Region II Chorus','2020 Region II Mixed',2020,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [57,1,'2020 Region II Treble Chorus Auditions','2020 Region II Treble',2020,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [58,9,'2020 All-State Chorus','2020 All-State Chorus',2020,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [59,9,'2020 All-State Treble Chorus','2020 All-State Treble Chorus',2020,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [60,24,'Mass All-State','MMEA A-S',2020,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [61,19,'2021 New Jersey All-Shore Chorus','2021 All-Shore',2021,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [62,23,'2020-21 SJCDA Elementary Chorus','SJCDA Elem',2021,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [63,11,'59th Annual Junior High Chorus','SJCDA Jr. High',2021,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [64,12,'63rd Annual Senior High Chorus','SJCDA Sr. High',2021,22,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [65,9,'2021 NJ All-State Chorus','2021 NJASC',2021,21,'2020-08-20 10:31:00','2021-07-27 11:03:00'],
            [66,12,'64th Annual Senior High Chorus','SJCDA Sr. High',2022,21,'2021-08-25 07:53:54','2021-08-25 07:53:54',],
            [67,11,'60th Annual Junior High Chorus','SJCDA Jr. High',2022,21,'2021-08-25 07:53:54','2021-08-25 07:53:54',],
            [68,11,'2021-22 Elementary Chorus','SJCDA Elementary',2022,24,'2021-08-25 07:53:54','2021-08-25 07:53:54',],
            [69,19,'2022 New Jersey All-Shore Chorus','2022 All-Shore',2022,21,'2021-08-25 07:53:54','2021-08-25 07:53:54',]
        ];
    }
}
