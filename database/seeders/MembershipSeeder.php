<?php

namespace Database\Seeders;

use App\Models\Membership;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Teacher::all() AS $teacher){
            $user_id = $teacher->user_id;
            if($user_id != 45) {
                Membership::updateOrCreate([
                    'user_id' => $user_id,
                    'organization_id' => 4, //NAfME
                    'membershiptype_id' => 1,
                    'membership_id' => 'unknown',
                    'expiration' => '2021-08-05',
                    'grade_levels' => 'Secondary',
                    'subjects' => 'Chorus',
                ]);

                Membership::updateOrCreate([
                    'user_id' => $user_id,
                    'organization_id' => 11, //Eastern Division
                    'membershiptype_id' => 1,
                    'membership_id' => 'unknown',
                    'expiration' => '2021-08-05',
                    'grade_levels' => 'Secondary',
                    'subjects' => 'Chorus',
                ]);

                Membership::updateOrCreate([
                    'user_id' => $user_id,
                    'organization_id' => 3, //NJMEA
                    'membershiptype_id' => 1,
                    'membership_id' => 'unknown',
                    'expiration' => '2021-08-05',
                    'grade_levels' => 'Secondary',
                    'subjects' => 'Chorus',
                ]);
            }
        }

        //just barbara
        $orgids1 = [8,9];
        foreach($orgids1 AS $orgid){
            Membership::updateOrCreate([
                'user_id' => 45,
                'organization_id' => $orgid,
                'membershiptype_id' => 1,
                'membership_id' => '123456',
                'expiration' => '2022-08-05',
                'grade_levels' => 'Secondary',
                'subjects' => 'Chorus',
            ]);
        }

        $orgids2 = [1,3,4,8,9,11];
        foreach($orgids2 AS $orgid){
            DB::table('organization_user')
                ->insert([
                    'organization_id' => $orgid,
                    'user_id' => 45,
                    'created_at' => '2021-08-24 17:54.38',
                    'updated_at' => '2021-08-24 17:54:38',
                ]);
        }


    }
}
