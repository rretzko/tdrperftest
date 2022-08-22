<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoletypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roletypes')->insert([
            ['descr' => 'subscriber', 'detail' => '',],
            ['descr' => 'customer', 'detail' => '',],
            ['descr' => 'patron', 'detail' => '',],
            ['descr' => 'student', 'detail' => '',],
            ['descr' => 'event_administrator', 'detail' => 'Will have access to ALL tables and data related to the organization\'s events.'],
            ['descr' => 'registration_manager', 'detail' => 'Will have access to tables and data related to event registration activities.'],
            ['descr' => 'rehearsal_manager', 'detail' => 'Will have access to records of students successfully auditioning for organization\'s events.'],
            ['descr' => 'conductor', 'detail' => '',],
            ['descr' => 'judge', 'detail' => '',],
            ['descr' => 'monitor', 'detail' => '',],
            ['descr' => 'judge_monitor', 'detail' => '',],
            ['descr' => 'guest', 'detail' => '',],
            ['descr' => 'other', 'detail' => '',],
            ['descr' => 'persona_non_grata', 'detail' => '',],
            ['descr' => 'teacher', 'detail' => '',],
            ['descr' => 'domainowner', 'detail' => '',],
            ['descr' => 'guardian', 'detail' => '',],
            ['descr' => 'membership manager', 'detail' => 'Grants/Denies access to current members and individuals requesting membership.'],
            ['descr' => 'officer', 'detail' => 'Will have access to ALL tables and data related to the organization\'s events.'],
        ]);
    }
}
