<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emailtypes')->insert([
            ['descr' => 'work', 'subscriber' => 1],
            ['descr' => 'personal', 'subscriber' => 1],
            ['descr' => 'other', 'subscriber' => 1],
            ['descr' => 'email_student_school', 'subscriber' => 0],
            ['descr' => 'email_student_personal', 'subscriber' => 0],
            ['descr' => 'email_guardian_alternate', 'subscriber' => 0],
            ['descr' => 'email_guardian_primary', 'subscriber' => 0],
        ]);
    }
}
