<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnsembleassetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asset_ensemble')->insert([
            [
                'ensemble_id' => 1,
                'asset_id' => 1,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
            [
                'ensemble_id' => 1,
                'asset_id' => 2,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
            [
                'ensemble_id' => 2,
                'asset_id' => 1,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
            [
                'ensemble_id' => 2,
                'asset_id' => 2,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
            [
                'ensemble_id' => 2,
                'asset_id' => 3,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
            [
                'ensemble_id' => 2,
                'asset_id' => 4,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
            [
                'ensemble_id' => 2,
                'asset_id' => 5,
                'created_at' => '2021-06-12 13:25:21',
                'updated_at' => '2021-06-12 13:25:21',
            ],
        ]);
    }
}
