<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudenttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('studenttypes')->insert([
            ['id' => 2, 'descr' => 'alum',],
            ['id' => 4, 'descr' => 'pending',],
            ['id' => 7, 'descr' => 'migrated',],
            ['id' => 9, 'descr' => 'transferred',],
            ['id' => 10, 'descr' => 'accepted',],
            ['id' => 11, 'descr' => 'rejected'],
            ['id' => 13, 'descr' => 'teacher_added'],
        ]);
    }
}
