<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SearchtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('searchtypes')->insert([
            ['descr' => 'name', 'unique' => 0,],
            ['descr' => 'email_other', 'unique' => 1,],
            ['descr' => 'email_personal', 'unique' => 1,],
            ['descr' => 'email_work', 'unique' => 1,],
            ['descr' => 'auditionnumber', 'unique' => 1,],
            ['descr' => 'user_id', 'unique' => 0,],
            ['descr' => 'misc', 'unique' => 0,],
            ['descr' => 'email_student_school', 'unique' => 0,],
            ['descr' => 'email_student_personal', 'unique' => 0,],
            ['descr' => 'email_guardian_work', 'unique' => 0,],
            ['descr' => 'email_guardian_personal', 'unique' => 0,],
            ['descr' => 'phone_mobile', 'unique' => 0,],
            ['descr' => 'phone_home', 'unique' => 0,],
            ['descr' => 'phone_work', 'unique' => 0,],
            ['descr' => 'phone_student_mobile', 'unique' => 0,],
            ['descr' => 'phone_student_home', 'unique' => 0,],
            ['descr' => 'phone_guardian_mobile', 'unique' => 0,],
            ['descr' => 'phone_guardian_home', 'unique' => 0,],
            ['descr' => 'phone_guardian_work', 'unique' => 0,],
        ]);
    }
}
