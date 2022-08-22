<?php

namespace Database\Seeders;

use App\Models\Datetype;
use Illuminate\Database\Seeder;

class DatetypeSeeder extends Seeder
{
    private $seeds;

    public function __construct()
    {
        $this->seeds = $this->buildSeeds();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->seeds AS $seed){
            Datetype::create([
                'id' => $seed['id'],
                'descr' => $seed['descr'],
            ]);
        }
    }

    private function buildSeeds()
    {
        return [
            ['id' => 1,'descr' =>'admin_open'],
            ['id' => 2,'descr' =>'admin_close'],
            ['id' => 3,'descr' =>'membership_open'],
            ['id' => 4,'descr' =>'membership_close'],
            ['id' => 5,'descr' =>'student_open'],
            ['id' => 6,'descr' =>'student_close'],
            ['id' => 7,'descr' =>'voice_change_open'],
            ['id' => 8,'descr' =>'voice_change_close'],
            ['id' => 9,'descr' =>'signature_open'],
            ['id' => 10,'descr' =>'signature_close'],
            ['id' => 11,'descr' =>'score_open'],
            ['id' => 12,'descr' =>'score_close'],
            ['id' => 13,'descr' =>'tab_close'],
            ['id' => 14,'descr' =>'results_release'],
            ['id' => 15,'descr' =>'applications_close'],
            ['id' => 16,'descr' =>'applications_open'],
            ['id' => 17,'descr' =>'videos_membership_open'],
            ['id' => 18,'descr' =>'videos_membership_close'],
            ['id' => 19,'descr' =>'videos_student_open'],
            ['id' => 20,'descr' =>'videos_student_close'],
            ['id' => 21,'descr' =>'membership_valid'],
        ];
    }
}
