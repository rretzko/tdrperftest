<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstrumentationbranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instrumentationbranches')->insert([
            ['descr' => 'choral',],
            ['descr' => 'instrumental',],
            ['descr' => 'mixed',],
            ['descr' => 'none',],
        ]);
    }
}
