<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assets')->insert([
            [
                'descr' => 'folder',
                'created_by' => 45,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
            [
                'descr' => 'gown',
                'created_by' => 45,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
            [
                'descr' => 'tuxedo jacket',
                'created_by' => 45,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
            [
                'descr' => 'tuxedo pants',
                'created_by' => 45,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
            [
                'descr' => 'cummerbund',
                'created_by' => 45,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
            [
                'descr' => 'sash',
                'created_by' => 45,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
        ]);
    }
}
