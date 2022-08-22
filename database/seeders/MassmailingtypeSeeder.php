<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Massmailingtype;

class MassmailingtypeSeeder extends Seeder
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

            $model = new Massmailingtype;

            $model->id = $seed[0];
            $model->descr = $seed[1];

            $model->save();
        }
    }

    private function buildSeeds()
    {
        return [
            [1,'absent_student'],
            [2,'early exit'],
            [3,'late arrival'],
            [4,'concert'],
            [5,'rehearsal'],
            [6,'reminder'],
        ];

    }
}
