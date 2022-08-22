<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventensembletypeInstrumentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eventensembletype_instrumentation')->insert([
            //SSAATTBB
            ['eventensembletype_id' => 1, 'instrumentation_id'=> 63, 'order_by' => 1,],
            ['eventensembletype_id' => 1, 'instrumentation_id'=> 64, 'order_by' => 2,],
            ['eventensembletype_id' => 1, 'instrumentation_id'=> 65, 'order_by' => 3,],
            ['eventensembletype_id' => 1, 'instrumentation_id'=> 66, 'order_by' => 4,],
            ['eventensembletype_id' => 1, 'instrumentation_id'=> 67, 'order_by' => 5,],
            ['eventensembletype_id' => 1, 'instrumentation_id'=> 68, 'order_by' => 6,],
            ['eventensembletype_id' => 1, 'instrumentation_id'=> 69, 'order_by' => 7,],
            ['eventensembletype_id' => 1, 'instrumentation_id'=> 70, 'order_by' => 8,],
            //SATB'
            ['eventensembletype_id' => 2, 'instrumentation_id'=> 1, 'order_by' => 1,],
            ['eventensembletype_id' => 2, 'instrumentation_id'=> 1, 'order_by' => 2,],
            ['eventensembletype_id' => 2, 'instrumentation_id'=> 6, 'order_by' => 3,],
            ['eventensembletype_id' => 2, 'instrumentation_id'=> 3, 'order_by' => 4,],
            //SSAA
            ['eventensembletype_id' => 3, 'instrumentation_id'=> 63, 'order_by' => 1,],
            ['eventensembletype_id' => 3, 'instrumentation_id'=> 64, 'order_by' => 2,],
            ['eventensembletype_id' => 3, 'instrumentation_id'=> 65, 'order_by' => 3,],
            ['eventensembletype_id' => 3, 'instrumentation_id'=> 66, 'order_by' => 4,],
            //TTBB
            ['eventensembletype_id' => 4, 'instrumentation_id'=> 67, 'order_by' => 1,],
            ['eventensembletype_id' => 4, 'instrumentation_id'=> 68, 'order_by' => 2,],
            ['eventensembletype_id' => 4, 'instrumentation_id'=> 69, 'order_by' => 3,],
            ['eventensembletype_id' => 4, 'instrumentation_id'=> 70, 'order_by' => 4,],
            //SSAATB
            ['eventensembletype_id' => 5, 'instrumentation_id'=> 63, 'order_by' => 1,],
            ['eventensembletype_id' => 5, 'instrumentation_id'=> 64, 'order_by' => 2,],
            ['eventensembletype_id' => 5, 'instrumentation_id'=> 65, 'order_by' => 3,],
            ['eventensembletype_id' => 5, 'instrumentation_id'=> 66, 'order_by' => 4,],
            ['eventensembletype_id' => 5, 'instrumentation_id'=> 6, 'order_by' => 5,],
            ['eventensembletype_id' => 5, 'instrumentation_id'=> 3, 'order_by' => 6,],
        ]);
    }
}
