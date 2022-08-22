<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradetypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gradetypes')->insert([
            ['descr' => '1', 'orderby' => 1],
            ['descr' => '2', 'orderby' => 2],
            ['descr' => '3', 'orderby' => 3],
            ['descr' => '4', 'orderby' => 4],
            ['descr' => '5', 'orderby' => 5],
            ['descr' => '6', 'orderby' => 6],
            ['descr' => '7', 'orderby' => 7],
            ['descr' => '8', 'orderby' => 8],
            ['descr' => '9', 'orderby' => 9],
            ['descr' => '10', 'orderby' => 10],
            ['descr' => '11', 'orderby' => 11],
            ['descr' => '12', 'orderby' => 12],
            ['descr' => 'collegiate', 'orderby' => 13],
            ['descr' => 'adult', 'orderby' => 14],
        ]);
    }
}
