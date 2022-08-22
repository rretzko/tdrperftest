<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventensemblestatustypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eventensemblestatustypes')->insert([
            ['id' => 32, 'descr' => 'open',],
            ['id' => 33, 'descr' => 'closed',],
            ['id' => 34, 'descr' => 'other'],
            ['id' => 35, 'descr' => 'pending'],
        ]);
    }
}
