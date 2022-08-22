<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Massmailing;

class MassmailingSeeder extends Seeder
{
    private $seeds;

    public function __construct()
    {
        //instantiate $this->seeds with guardiantype data
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

            $model = new Massmailing;

            $model->id = $seed[0];
            $model->eventversion_id = $seed[1];
            $model->massmailingtype_id = $seed[2];
            $model->audiencetype_id = $seed[3];

            $model->save();
        }
    }

    private function buildSeeds()
    {
        return [
            [1,66,1,1],
            [2,66,2,1],
            [3,66,3,1],
            [4,66,4,3],
            [5,66,5,3],
            [6,66,6,3],
            [7,67,1,1],
            [8,67,2,1],
            [9,67,3,1],
            [10,67,4,3],
            [11,67,5,3],
            [12,67,6,3],
            [13,68,1,1],
            [14,68,2,1],
            [15,68,3,1],
            [16,68,4,3],
            [17,68,5,3],
            [18,69,6,3],
            [19,69,1,1],
            [20,69,2,1],
            [21,69,3,1],
            [22,69,4,3],
            [23,69,5,3],
            [24,69,6,3],
            [25,70,1,1],
            [26,70,2,1],
            [27,70,3,1],
            [28,70,4,3],
            [29,70,5,3],
            [30,70,6,3],
            
        ];

    }
}
