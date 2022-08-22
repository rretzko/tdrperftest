<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AfdcSeeder extends Seeder
{
    private $dtseeds;

    public function __construct()
    {
        $this->dtseeds = $this->buildDateSeeds();
    }

    private function buildDateSeeds()
    {
        return [
            65 => [ //NJ ALL-STATE CHORUS
                1 => '2021-08-25 08:51:19', //admin_open
                2 => '2021-11-30 23:59:59', //admin_close
                3 => '2021-08-25 08:51:19', //membership_open
                4 => '2021-10-05 23:59:59', //membership_close
                5 => '2021-09-01 00:00:01', //student_open
                6 => '2021-09-29 23:59:59', //student_close
                7 => '2021-08-25 08:51:19', //voice_change_open
                8 => '2021-10-05 23:59:59', //voice_change_close
                9 => '2021-08-25 08:51:19', //signature_open
                10 => '2021-10-05 23:59:59', //signature_close
                11 => '2021-10-14 00:00:01', //score_open
                12 => '2021-10-16 23:59:59', //score_close
                13 => '2021-10-16 23:59:59', //tab_close
                14 => NULL, //results_release
                15 => '2021-08-25 08:51:19', //applications_open
                16 => '2021-10-05 23:59:59', //applications_close
                17 => '2021-08-25 08:51:19', //videos_membership_open
                18 => '2021-10-05 23:59:59', //videos_membership_close
                19 => '2021-09-01 00:00:01', //videos_student_open
                20 => '2021-09-29 23:59:59', //videos_student_close
                21 => '2021-10-31 23:59:59', //membership_valid
            ],
            66 => [ //SJCDA SENIOR HIGH
                1 => '2021-08-25 08:51:19', //admin_open
                2 => '2021-11-30 23:59:59', //admin_close
                3 => '2021-08-25 08:51:19', //membership_open
                4 => '2021-11-08 23:59:59', //membership_close
                5 => '2021-09-01 00:00:01', //student_open
                6 => '2021-10-29 23:59:59', //student_close
                7 => '2021-08-25 08:51:19', //voice_change_open
                8 => '2021-11-08 23:59:59', //voice_change_close
                9 => '2021-08-25 08:51:19', //signature_open
                10 => '2021-11-08 23:59:59', //signature_close
                11 => '2021-11-13 00:00:01', //score_open
                12 => '2021-11-13 23:59:59', //score_close
                13 => '2021-11-13 23:59:59', //tab_close
                14 => NULL, //results_release
                15 => '2021-08-25 08:51:19', //applications_open
                16 => '2021-11-08 23:59:59', //applications_close
                17 => '2021-08-25 08:51:19', //videos_membership_open
                18 => '2021-11-08 23:59:59', //videos_membership_close
                19 => '2021-10-13 00:00:01', //videos_student_open
                20 => '2021-10-29 23:59:59', //videos_student_close
                21 => '2021-10-31 23:59:59', //membership_valid
            ],
            67 => [ //SJCDA SENIOR HIGH
                1 => '2021-08-25 08:51:19', //admin_open
                2 => '2021-11-30 23:59:59', //admin_close
                3 => '2021-08-25 08:51:19', //membership_open
                4 => '2021-11-08 23:59:59', //membership_close
                5 => '2021-09-01 00:00:01', //student_open
                6 => '2021-10-29 23:59:59', //student_close
                7 => '2021-08-25 08:51:19', //voice_change_open
                8 => '2021-11-08 23:59:59', //voice_change_close
                9 => '2021-08-25 08:51:19', //signature_open
                10 => '2021-11-08 23:59:59', //signature_close
                11 => '2021-11-13 00:00:01', //score_open
                12 => '2021-11-13 23:59:59', //score_close
                13 => '2021-11-13 23:59:59', //tab_close
                14 => NULL, //results_release
                15 => '2021-08-25 08:51:19', //applications_open
                16 => '2021-11-08 23:59:59', //applications_close
                17 => '2021-08-25 08:51:19', //videos_membership_open
                18 => '2021-11-08 23:59:59', //videos_membership_close
                19 => '2021-10-13 00:00:01', //videos_student_open
                20 => '2021-10-29 23:59:59', //videos_student_close
                21 => '2021-10-31 23:59:59', //membership_valid
            ],
            68 => [ //SJCDA ELEMENTARY
                1 => '2021-08-25 08:51:19', //admin_open
                2 => '2021-12-31 23:59:59', //admin_close
                3 => '2021-11-07 00:00:01', //membership_open
                4 => '2021-12-31 23:59:59', //membership_close
                5 => '2021-12-10 00:00:01', //student_open
                6 => '2021-12-24 23:59:59', //student_close
                7 => '2021-11-07 00:00:01', //voice_change_open
                8 => '2021-12-31 23:59:59', //voice_change_close
                9 => '2021-11-07 00:00:01', //signature_open
                10 => '2021-12-31 23:59:59', //signature_close
                11 => '2021-12-24 23:59:59', //score_open
                12 => '2021-12-24 23:59:59', //score_close
                13 => '2021-12-24 23:59:59', //tab_close
                14 => NULL, //results_release
                15 => '2021-11-07 00:00:01', //applications_open
                16 => '2021-12-31 23:59:59', //applications_close
                17 => '2021-08-25 08:51:19', //videos_membership_open
                18 => '2021-11-08 23:59:59', //videos_membership_close
                19 => '2021-12-10 00:00:01', //videos_student_open
                20 => '2021-12-24 23:59:59', //videos_student_close
                21 => '2021-10-31 23:59:59', //membership_valid
            ],
            69 => [ //ALL-SHORE
                1 => '2021-08-25 08:51:19', //admin_open
                2 => '2021-11-30 23:59:59', //admin_close
                3 => '2021-08-25 08:51:19', //membership_open
                4 => '2021-11-08 23:59:59', //membership_close
                5 => '2021-09-01 00:00:01', //student_open
                6 => '2021-10-29 23:59:59', //student_close
                7 => '2021-08-25 08:51:19', //voice_change_open
                8 => '2021-11-08 23:59:59', //voice_change_close
                9 => '2021-08-25 08:51:19', //signature_open
                10 => '2021-11-08 23:59:59', //signature_close
                11 => '2021-11-13 00:00:01', //score_open
                12 => '2021-11-13 23:59:59', //score_close
                13 => '2021-11-13 23:59:59', //tab_close
                14 => NULL, //results_release
                15 => '2021-08-25 08:51:19', //applications_open
                16 => '2021-11-08 23:59:59', //applications_close
                17 => '2021-08-25 08:51:19', //videos_membership_open
                18 => '2021-11-08 23:59:59', //videos_membership_close
                19 => '2021-10-13 00:00:01', //videos_student_open
                20 => '2021-10-29 23:59:59', //videos_student_close
                21 => '2021-10-31 23:59:59', //membership_valid
            ],
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->runEventversionensembles();

        $this->runEventversiondates();
    }

    private function runEventversionensembles()
    {
        //SJCDA SENIOR
        DB::table('eventensemble_eventversion')
            ->insert([
                'eventensemble_id' => 3,
                'eventversion_id' => 66,
                'created_at' => '2021-08-25 08:32:27',
                'updated_at' => '2021-08-25 08:32:27',
            ]);

        //SJCDA JUNIOR
        DB::table('eventensemble_eventversion')
            ->insert([
                'eventensemble_id' => 2,
                'eventversion_id' => 67,
                'created_at' => '2021-08-25 08:32:27',
                'updated_at' => '2021-08-25 08:32:27',
            ]);

        //SJCDA ELEMENTARY
        DB::table('eventensemble_eventversion')
            ->insert([
                'eventensemble_id' => 1,
                'eventversion_id' => 68,
                'created_at' => '2021-08-25 08:32:27',
                'updated_at' => '2021-08-25 08:32:27',
            ]);

        //ALL-SHORE
        DB::table('eventensemble_eventversion')
            ->insert([
                'eventensemble_id' => 5,
                'eventversion_id' => 69,
                'created_at' => '2021-08-25 08:32:27',
                'updated_at' => '2021-08-25 08:32:27',
            ]);
    }

    private function runEventversiondates()
    {
        foreach($this->dtseeds AS $eventversion_id => $seed) {

            foreach ($seed as $dtid => $dt){
                DB::table('eventversiondates')
                    ->insert([
                        'eventversion_id' => $eventversion_id,
                        'datetype_id' => $dtid,
                        'dt' => $dt,
                        'created_at' => '2021-08-25 08:41:33',
                        'updated_at' => '2021-08-25 08:41:33',
                    ]);
            }
        }
    }
}
