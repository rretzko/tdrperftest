<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnsembletypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ensembletypes')->insert([
            ['descr' => 'SSAATTBB',],
            ['descr' => 'SATB',],
            ['descr' => 'SSAA'],
            ['descr' => 'TTBB'],
            ['descr' => 'SSAATB'],
            ['descr' => 'Tone Chimes'],
        ]);
    }
}
