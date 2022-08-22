<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShirtsizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shirtsizes')->insert([
                ['descr' => 'medium', 'abbr' => 'M', 'order_by' => 4],
                ['descr' => 'double extra small', 'abbr' => 'XXS', 'order_by' => 1],
                ['descr' => 'extra small', 'abbr' => 'XS', 'order_by' => 2],
                ['descr' => 'small', 'abbr' => 'S', 'order_by' => 3],
                ['descr' => 'large', 'abbr' => 'L', 'order_by' => 5],
                ['descr' => 'extra large', 'abbr' => 'XL', 'order_by' => 6],
                ['descr' => 'double extra large', 'abbr' => 'XXL', 'order_by' => 7],
            ]);
    }
}
