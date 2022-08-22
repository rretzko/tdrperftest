<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnsemblememberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ensemblemembers')->insert([
            [
                'ensemble_id' => 1,
                'schoolyear_id' =>2020,
                'user_id' => 1223,
                'teacher_user_id' => 45,
                'instrumentation_id' => 63,
                'created_at' => '2021-06-12 13:38:48',
                'updated_at' => '2021-06-12 13:38:48',
            ],
            [
            'ensemble_id' => 1,
            'schoolyear_id' =>2020,
            'user_id' => 499,
            'teacher_user_id' => 45,
            'instrumentation_id' => 64,
            'created_at' => '2021-06-12 13:38:48',
            'updated_at' => '2021-06-12 13:38:48',
            ],
            [
            'ensemble_id' => 1,
                'schoolyear_id' =>2020,
                'user_id' => 500,
                'teacher_user_id' => 45,
                'instrumentation_id' => 64,
                'created_at' => '2021-06-12 13:38:48',
                'updated_at' => '2021-06-12 13:38:48',
            ],
            [
                'ensemble_id' => 1,
                'schoolyear_id' =>2020,
                'user_id' => 640,
                'teacher_user_id' => 45,
                'instrumentation_id' => 64,
                'created_at' => '2021-06-12 13:38:48',
                'updated_at' => '2021-06-12 13:38:48',
            ],
            [
            'ensemble_id' => 1,
                'schoolyear_id' =>2020,
                'user_id' => 840,
                'teacher_user_id' => 45,
                'instrumentation_id' => 63,
                'created_at' => '2021-06-12 13:38:48',
                'updated_at' => '2021-06-12 13:38:48',
            ],
        ]);
    }
}
