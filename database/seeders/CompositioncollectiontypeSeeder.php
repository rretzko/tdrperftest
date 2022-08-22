<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompositioncollectiontypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compositioncollectiontypes')->insert([
            ['media' => 'print', 'descr' => 'sheetmusic'],
            ['media' => 'print', 'descr' => 'book'],
            ['media' => 'print', 'descr' => 'medley'],
            ['media' => 'digital', 'descr' => 'cd'],
            ['media' => 'digital', 'descr' => 'dvd'],
            ['media' => 'digital', 'descr' => 'cloud'],
        ]);
    }
}
