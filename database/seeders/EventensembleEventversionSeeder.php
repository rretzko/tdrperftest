<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventensembleEventversionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eventensemble_eventversion')->insert([
            [
                'eventensemble_id' => 1,
                'eventversion_id' => 62,
                'created_at' => '2021-07-27 11:50:21',
                'updated_at' => '2021-07-27 11:50:21',
            ],
            [
                'eventensemble_id' => 2,
                'eventversion_id' => 63,
                'created_at' => '2021-07-27 11:50:21',
                'updated_at' => '2021-07-27 11:50:21',
            ],
            [
                'eventensemble_id' => 3,
                'eventversion_id' => 64,
                'created_at' => '2021-07-27 11:50:21',
                'updated_at' => '2021-07-27 11:50:21',
            ],
            [
                'eventensemble_id' => 5,
                'eventversion_id' => 61,
                'created_at' => '2021-07-27 11:50:21',
                'updated_at' => '2021-07-27 11:50:21',
            ],
            [
                'eventensemble_id' => 20,
                'eventversion_id' => 65,
                'created_at' => '2021-07-27 11:50:21',
                'updated_at' => '2021-07-27 11:50:21',
            ],
            [
                'eventensemble_id' => 21,
                'eventversion_id' => 65,
                'created_at' => '2021-07-27 11:50:21',
                'updated_at' => '2021-07-27 11:50:21',
            ],
        ]);
    }
}
