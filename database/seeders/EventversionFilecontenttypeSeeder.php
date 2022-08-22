<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventversionFilecontenttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eventversion_filecontenttype')
            ->insert([
                [
                   'eventversion_id' => 65,
                   'filecontenttype_id' => 1,
                   'title' => NULL,
                   'created_at' => '2021-08-22 14:13:00',
                   'updated_at' => '2021-08-22 14:13:00',
                ],
                [
                    'eventversion_id' => 65,
                    'filecontenttype_id' => 4,
                    'title' => 'The Silver Swan',
                    'created_at' => '2021-08-22 14:13:00',
                    'updated_at' => '2021-08-22 14:13:00',
                ],
                [
                    'eventversion_id' => 65,
                    'filecontenttype_id' => 5,
                    'title' => 'Shenandoah',
                    'created_at' => '2021-08-22 14:13:00',
                    'updated_at' => '2021-08-22 14:13:00',
                ],
            ]);
    }
}
