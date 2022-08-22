<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Audiencetype;

class AudiencetypeSeeder extends Seeder
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

            $model = new Audiencetype;

            $model->id = $seed[0];
            $model->descr = $seed[1];

            $model->save();
        }
    }

    private function buildSeeds()
    {
        return [
            [1,'students'],
            [2,'parents'],
            [3,'teachers'],
        ];

    }
}
