<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            [
                'id' => 1,
                'parent_id'=> 3,
                'name' => 'Central Jersey Music Educators Association',
                'organizationtype_id' => 4,
                'abbr' => 'CJMEA',
                'bio' => '',
                'logo_file' => 'cjmeaLogo.png',
                'logo_file_alt' => 'CJMEA REgion II Mixed and Treble Chorus'
            ],
            [
                'id' => 2,
                'parent_id'=> 5,
                'name' => 'New Jersey - American Choral Directors Association',
                'organizationtype_id' => 3,
                'abbr' => 'NJ ACDA',
                'bio' => '',
                'logo_file' => '',
                'logo_file_alt' => ''
            ],
            [
                'id' => 3,
                'parent_id'=> 11,
                'name' => 'New Jersey Music Educators Association',
                'organizationtype_id' => 3,
                'abbr' => 'NJMEA',
                'bio' => 'The mission of the New Jersey Music Educators Association is the advancement of music instruction in New Jersey’s educational institutions at all levels that provide in-service and enrichment opportunities for practicing and retired teachers and prospective music educators, as well as sponsoring various festivals and all-state performing groups for K-12 students.',
                'logo_file' => 'njmeaLogo_Transparent.png',
                'logo_file_alt' => 'NJMEA logo'
            ],
            [
                'id' => 4,
                'parent_id'=> 0,
                'name' => 'National Association for Music Education',
                'organizationtype_id' => 1,
                'abbr' => 'NAfME',
                'bio' => '',
                'logo_file' => 'NAfME_cropped.jpg',
                'logo_file_alt' => 'NAfME logo'
            ],
            [
                'id' => 5,
                'parent_id'=> 0,
                'name' => 'American Choral Directors Association',
                'organizationtype_id' => 1,
                'abbr' => 'ACDA',
                'bio' => '',
                'logo_file' => '',
                'logo_file_alt' => ''
            ],
            [
                'id' => 6,
                'parent_id'=> 3,
                'name' => 'North Jersey School Music Association',
                'organizationtype_id' => 4,
                'abbr' => 'NJSMA',
                'bio' => '',
                'logo_file' => '',
                'logo_file_alt' => ''
            ],
            [
                'id' => 7,
                'parent_id'=> 3,
                'name' => 'South Jersey Band and Orchestra Directors Association',
                'organizationtype_id' => 4,
                'abbr' => 'SJBODA',
                'bio' => '',
                'logo_file' => '',
                'logo_file_alt' => ''
            ],
            [
                'id' => 8,
                'parent_id'=> 3,
                'name' => 'South Jersey Choral Directors Association',
                'organizationtype_id' => 4,
                'abbr' => 'SJCDA',
                'bio' => '<p>The South Jersey Choral Directors\' Association, Inc. (SJCDA) was founded in 1958.</p>
    <p>The Association is an independently incorporated, non-profit organization, affiliated with the New Jersey Music Educators Association (NJMEA) and the Music Educators National Conference (MENC).</p>
    <p>The Association strives to foster and promote choral singing in order to provide artisitc and aesthetic experiences for students, as well as the intelligent understanding of all types of choral music.  SJCDA acitively supports the organization and development of choral groups of all types from all schools.  The Association dissemeinates professional news and information about choral music and music education issues to students and teachers in the Southern region of New Jersey, known as Region III of NJMEA.</p>
    <p>All school vocal/choral music directors in the eight county southern region are welcome to participate in SJCDA activities where applicable.  Together with the South Jersey Band & Orchestra Directors Association, SJCDA serves several hundred students each year in the pursuit of musical excellence.</p>',
                'logo_file' => 'sjcdaLogo_transparent.png',
                'logo_file_alt' => 'SJCDA Logo'
            ],
            [
                'id' => 9,
                'parent_id'=> 0,
                'name' => 'New Jersey All-Shore Chorus',
                'organizationtype_id' => 4,
                'abbr' => 'NJASC',
                'bio' => '<p>Bringing the best students together to sing since 1962</p>
        <p>All Shore Chorus brings together the best of the best high school choir singers from Monmouth and Ocean Counties in New Jersey. The organization strives to challenge our students by performing academic pieces that challenge and prepare them for singing beyond high school.</p>',
                'logo_file' => 'logo_all_shore.png',
                'logo_file_alt' => 'NJ All-Shore Chorus'
            ],
            [
                'id' => 10,
                'parent_id'=> 11,
                'name' => 'Massachusetts Music Educators Association',
                'organizationtype_id' => 3,
                'abbr' => 'MMEA',
                'bio' => '',
                'logo_file' => '',
                'logo_file_alt' => ''
            ],
            [
                'id' => 11,
                'parent_id'=> 4,
                'name' => 'Eastern Region',
                'organizationtype_id' => 2,
                'abbr' => 'NAfME-E',
                'bio' => '',
                'logo_file' => '',
                'logo_file_alt' => ''
            ],
            [
                'id' => 12,
                'parent_id'=> 4,
                'name' => 'North Central Region',
                'organizationtype_id' => 2,
                'abbr' => 'NAfME-NC',
                'bio' => '',
                'logo_file' => '',
                'logo_file_alt' => ''
            ],
            [
                'id' => 13,
                'parent_id'=> 4,
                'name' => 'Northwest Region',
                'organizationtype_id' => 2,
                'abbr' => 'NAfME-NW',
                'bio' => '',
                'logo_file' => '',
                'logo_file_alt' => ''
            ],
            [
                'id' => 14,
                'parent_id'=> 4,
                'name' => 'Southern Region',
                'organizationtype_id' => 2,
                'abbr' => 'NAfME-S',
                'bio' => '',
                'logo_file' => '',
                'logo_file_alt' => ''
            ],
            [
                'id' => 15,
                'parent_id'=> 4,
                'name' => 'Southwestern Region',
                'organizationtype_id' => 2,
                'abbr' => 'NAfME-SW',
                'bio' => '',
                'logo_file' => '',
                'logo_file_alt' => ''
            ],
            [
                'id' => 16,
                'parent_id'=> 4,
                'name' => 'Western Region',
                'organizationtype_id' => 2,
                'abbr' => 'NAfME-W',
                'bio' => '',
                'logo_file' => '',
                'logo_file_alt' => ''
            ],
        ]);

        DB::table('organization_user')->insert([
            [
                'organization_id' => 1,
                'user_id'=> 45,
                'created_at' => '2021-07-26 20:25:01',
                'updated_at' => '2021-07-26 20:25:01',
            ],
            [
                'organization_id' => 3,
                'user_id'=> 45,
                'created_at' => '2021-07-26 20:25:01',
                'updated_at' => '2021-07-26 20:25:01',
            ],
            [
                'organization_id' => 4,
                'user_id'=> 45,
                'created_at' => '2021-07-26 20:25:01',
                'updated_at' => '2021-07-26 20:25:01',
            ],
            [
                'organization_id' => 11,
                'user_id'=> 45,
                'created_at' => '2021-07-26 20:25:01',
                'updated_at' => '2021-07-26 20:25:01',
            ],
        ]);

        DB::table('memberships')->insert([
            [
                'user_id'=> 45,
                'organization_id' => 1,
                'membershiptype_id' => 1,
                'membership_id' => '12345',
                'expiration' => '2021-08-26 20:25:01',
                'created_at' => '2021-07-26 20:25:01',
                'updated_at' => '2021-07-26 20:25:01',
            ],
            [
                'user_id'=> 45,
                'organization_id' => 3,
                'membershiptype_id' => 1,
                'membership_id' => '12345',
                'expiration' => '2021-08-26 20:25:01',
                'created_at' => '2021-07-26 20:25:01',
                'updated_at' => '2021-07-26 20:25:01',
            ],
            [
                'user_id'=> 45,
                'organization_id' => 4,
                'membershiptype_id' => 1,
                'membership_id' => '12345',
                'expiration' => '2021-08-26 20:25:01',
                'created_at' => '2021-07-26 20:25:01',
                'updated_at' => '2021-07-26 20:25:01',
            ],
            [
                'user_id'=> 45,
                'organization_id' => 11,
                'membershiptype_id' => 1,
                'membership_id' => '12345',
                'expiration' => '2021-08-26 20:25:01',
                'created_at' => '2021-07-26 20:25:01',
                'updated_at' => '2021-07-26 20:25:01',
            ],
        ]);
    }
}
