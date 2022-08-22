<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershiptypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('membershiptypes')->insert([
            ['descr' => 'active',],
            ['descr' => 'inactive',],
            ['descr' => 'retired',],
            ['descr' => 'guest',],
            ['descr' => 'declined',],
            ['descr' => 'expelled',],
            ['descr' => 'student',],
            ['descr' => 'ex-officio',],
            ['descr' => 'trial',],
            ['descr' => 'deceased',],
            ['descr' => 'pending'],
        ]);
    }
}
