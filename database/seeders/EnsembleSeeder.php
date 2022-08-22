<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnsembleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ensembles')->insert([
            [
                'user_id' => 45,
                'school_id' => 4190,
                'name' => 'Ridge Chorale',
                'abbr' => 'RC',
                'descr' => '9th and 10th grade upper voices',
                'ensembletype_id' => 3,
                'startyear' => 1985,
                'created_at' => '2021-06-12 13:16:52',
                'updated_at' => '2021-06-12 13:16:52',
            ],
            [
                'user_id' => 45,
                'school_id' => 4190,
                'name' => 'A Cappella Choir',
                'abbr' => 'ACC',
                'descr' => 'Honors Choir',
                'ensembletype_id' => 1,
                'startyear' => 1988,
                'created_at' => '2021-06-12 13:16:52',
                'updated_at' => '2021-06-12 13:16:52',
            ],
            [
                'user_id' => 45,
                'school_id' => 4190,
                'name' => 'Voices of Ridge',
                'abbr' => 'VR',
                'descr' => 'Women\'s literature',
                'ensembletype_id' => 3,
                'startyear' => 1988,
                'created_at' => '2021-06-12 13:16:52',
                'updated_at' => '2021-06-12 13:16:52',
            ],
            [
                'user_id' => 45,
                'school_id' => 4190,
                'name' => 'Tone Chime Ensemble',
                'abbr' => 'TCE',
                'descr' => 'Holiday music',
                'ensembletype_id' => 6,
                'startyear' => 2014,
                'created_at' => '2021-06-12 13:16:52',
                'updated_at' => '2021-06-12 13:16:52',
            ],
            [
                'user_id' => 45,
                'school_id' => 4190,
                'name' => 'Madrigal Singers',
                'abbr' => 'MS',
                'descr' => 'Madrigal literature',
                'ensembletype_id' => 1,
                'startyear' => 1988,
                'created_at' => '2021-06-12 13:16:52',
                'updated_at' => '2021-06-12 13:16:52',
            ],
            [
                'user_id' => 45,
                'school_id' => 4190,
                'name' => 'Ridgemen',
                'abbr' => 'RM',
                'descr' => 'Men\'s Choir',
                'ensembletype_id' => 4,
                'startyear' => 1988,
                'created_at' => '2021-06-12 13:16:52',
                'updated_at' => '2021-06-12 13:16:52',
            ],
            [
                'user_id' => 45,
                'school_id' => 4190,
                'name' => 'RHS Jazz Chorale',
                'abbr' => 'JC',
                'descr' => 'Jazz Choir',
                'ensembletype_id' => 1,
                'startyear' => 1996,
                'created_at' => '2021-06-12 13:16:52',
                'updated_at' => '2021-06-12 13:16:52',
            ],
            [
                'user_id' => 368,
                'school_id' => 7485,
                'name' => 'A Cappella Choir',
                'abbr' => 'ACC',
                'descr' => 'Honors Choir',
                'ensembletype_id' => 1,
                'startyear' => 2015,
                'created_at' => '2021-06-12 13:16:52',
                'updated_at' => '2021-06-12 13:16:52',
            ],

        ]);
    }
}
