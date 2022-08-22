<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhonetypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phonetypes')->insert([
            ['descr' => 'mobile', 'abbr' => 'c',],
            ['descr' => 'work', 'abbr' => 'w',],
            ['descr' => 'home', 'abbr' => 'h',],
            ['descr' => 'phone_student_mobile', 'abbr' => 'c',],
            ['descr' => 'phone_student_home', 'abbr' => 'h',],
            ['descr' => 'phone_guardian_mobile', 'abbr' => 'c',],
            ['descr' => 'phone_guardian_work', 'abbr' => 'w',],
            ['descr' => 'phone_guardian_home', 'abbr' => 'h',],
        ]);
    }
}
