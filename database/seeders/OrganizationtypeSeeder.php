<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizationtypes')->insert([
            ['descr' => 'parent', 'order_by' => 1,],
            ['descr' => 'section', 'order_by' => 2,],
            ['descr' => 'state', 'order_by' => 3,],
            ['descr' => 'region', 'order_by' => 4],
            ['descr' => 'subregion', 'order_by' => 5,],
        ]);
    }
}
