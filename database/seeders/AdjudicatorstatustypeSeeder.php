<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdjudicatorstatustypeSeeder extends Seeder
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

            \App\Models\Adjudicatorstatustype::create([
                'descr' => $seed,
            ]);
        }
    }

    private function buildSeeds()
    {
        return [
            'assigned','completed','delegated','left-early','no-show','substitute'
        ];
    }
}
