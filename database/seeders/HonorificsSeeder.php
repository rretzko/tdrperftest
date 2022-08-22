<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HonorificsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('honorifics')->insert([
            ['descr' => 'Ms.','abbr' => 'Ms.', 'order_by'=>1],
            ['descr' => 'Misses','abbr' => 'Mrs.', 'order_by'=>2],
            ['descr' => 'Mister','abbr' => 'Mr.', 'order_by'=>3],
            ['descr' => 'Doctor','abbr' => 'Dr.', 'order_by'=>5],
            ['descr' => 'Sister','abbr' => 'Sr.', 'order_by'=>6],
            ['descr' => 'Mx.','abbr' => 'Mx.', 'order_by'=>4],
        ]);
    }
}
