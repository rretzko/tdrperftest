<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipRoletypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('membership_roletype')
            ->insert([
                [
                    'membership_id' => 3,
                    'roletype_id' => 18,
                    'created_at' => '2021-08-22 14:25:00',
                    'updated_at' => '2021-08-22 14:25:00',
                ],
            ]);
    }
}
