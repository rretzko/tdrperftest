<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompositiontypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compositiontypes')->insert([
            ['descr' => 'choral'],
            ['descr' => 'band'],
            ['descr' => 'orchestra'],
            ['descr' => 'mixed'],
        ]);
    }
}
