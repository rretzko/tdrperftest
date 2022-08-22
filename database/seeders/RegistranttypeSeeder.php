<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistranttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('registranttypes')->insert([
            ['id'=>14,'descr'=>'eligible'],
            ['id'=>15,'descr'=>'applied'],
            ['id'=>16,'descr'=>'registered'],
            ['id'=>17,'descr'=>'hidden'],
            ['id'=>18,'descr'=>'prohibited'],
            ['id'=>24,'descr'=>'no-app'],
            ['id'=>26,'descr'=>'pre-registered'],
            ['id'=>29,'descr'=>'withdrew'],
            ['id'=>41,'descr'=>'removed'],
        ]);
    }
}
