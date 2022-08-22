<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditionstatustypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auditionstatustypes')->insert([
            ['descr' => 'unauditioned', 'background' => 'white', 'color' => 'black'], //black on white
            ['descr' => 'tolerance', 'background' => 'rgba(255,0,0,0.1)', 'color' => 'darkred'], //darkred on lightred
            ['descr' => 'partial', 'background' => 'rgba(245,234,39,0.3)', 'color' => 'black'], //black on yellow
            ['descr' => 'excess', 'background' => 'rgba(39,101,245,0.2)', 'color' => 'darkblue'], //darkblue on lightblue
            ['descr' => 'completed', 'background' => 'rgba(0,255,0,0.1)', 'color' => 'darkgreen'], //darkgreen on lightgreen
            ['descr' => 'error','background' => 'black','color' => 'white'], //white on black
        ]);
    }
}
