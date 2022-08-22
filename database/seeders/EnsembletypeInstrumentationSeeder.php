<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnsembletypeInstrumentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ensembletype_instrumentation')->insert([
            //SSAATTBB
            ['ensembletype_id' => 1, 'instrumentation_id'=> 63, 'order_by' => 1,],
            ['ensembletype_id' => 1, 'instrumentation_id'=> 64, 'order_by' => 2,],
            ['ensembletype_id' => 1, 'instrumentation_id'=> 65, 'order_by' => 3,],
            ['ensembletype_id' => 1, 'instrumentation_id'=> 66, 'order_by' => 4,],
            ['ensembletype_id' => 1, 'instrumentation_id'=> 67, 'order_by' => 5,],
            ['ensembletype_id' => 1, 'instrumentation_id'=> 68, 'order_by' => 6,],
            ['ensembletype_id' => 1, 'instrumentation_id'=> 69, 'order_by' => 7,],
            ['ensembletype_id' => 1, 'instrumentation_id'=> 70, 'order_by' => 8,],
            //SATB'
            ['ensembletype_id' => 2, 'instrumentation_id'=> 1, 'order_by' => 1,],
            ['ensembletype_id' => 2, 'instrumentation_id'=> 1, 'order_by' => 2,],
            ['ensembletype_id' => 2, 'instrumentation_id'=> 6, 'order_by' => 3,],
            ['ensembletype_id' => 2, 'instrumentation_id'=> 3, 'order_by' => 4,],
            //SSAA
            ['ensembletype_id' => 3, 'instrumentation_id'=> 63, 'order_by' => 1,],
            ['ensembletype_id' => 3, 'instrumentation_id'=> 64, 'order_by' => 2,],
            ['ensembletype_id' => 3, 'instrumentation_id'=> 65, 'order_by' => 3,],
            ['ensembletype_id' => 3, 'instrumentation_id'=> 66, 'order_by' => 4,],
            //TTBB
            ['ensembletype_id' => 4, 'instrumentation_id'=> 67, 'order_by' => 1,],
            ['ensembletype_id' => 4, 'instrumentation_id'=> 68, 'order_by' => 2,],
            ['ensembletype_id' => 4, 'instrumentation_id'=> 69, 'order_by' => 3,],
            ['ensembletype_id' => 4, 'instrumentation_id'=> 70, 'order_by' => 4,],
            //SSAATB
            ['ensembletype_id' => 5, 'instrumentation_id'=> 63, 'order_by' => 1,],
            ['ensembletype_id' => 5, 'instrumentation_id'=> 64, 'order_by' => 2,],
            ['ensembletype_id' => 5, 'instrumentation_id'=> 65, 'order_by' => 3,],
            ['ensembletype_id' => 5, 'instrumentation_id'=> 66, 'order_by' => 4,],
            ['ensembletype_id' => 5, 'instrumentation_id'=> 6, 'order_by' => 5,],
            ['ensembletype_id' => 5, 'instrumentation_id'=> 3, 'order_by' => 6,],
        ]);
    }
}
