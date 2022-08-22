<?php

namespace Database\Seeders;

use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MembershipAllShoreSeeder extends Seeder
{
    private $seeds;

    public function __construct()
    {
        $this->seeds = $this->buildSeeds();
    }

    private function buildSeeds()
    {
        return [
            [1],
            [60],
            [119],
            [124],
            [126],
            [130],
            [135],
            [140],
            [147],
            [207],
            [218],
            [226],
            [229],
            [251],
            [272],
            [304],
            [304],
            [309],
            [368],
            [390],
            [420],
            [432],
            [434],
            [6690],
            [6925],
            [6926],
            [6927],
            [6942],
            [8494],
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->seeds AS $seed) {
            Membership::updateOrCreate(
                [
                    'user_id' => $seed[0],
                    'organization_id' => 9, //NJ All-Shore
                ],
                [
                    'membershiptype_id' => 1,
                    'membership_id' => 'allshore',
                    'expiration' => Carbon::now(),
                    'grade_levels' => '',
                    'subjects' => 'Chorus',
                ],
            );
        }
    }
}
