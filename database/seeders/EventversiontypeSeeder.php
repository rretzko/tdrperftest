<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventversiontypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eventversiontypes')->insert([
            ['id' => 3, 'descr' => 'inactive'],
            ['id' => 20, 'descr' => 'member-only'],
            ['id' => 21, 'descr' => 'open',],
            ['id' => 22, 'descr' => 'closed',],
            ['id' => 23, 'descr' => 'other'],
            ['id' => 24, 'descr' => 'pending'],
            ['id' => 25, 'descr' => 'admin'],
            ['id' => 31, 'descr' => 'sandbox'],
        ]);
    }
}
