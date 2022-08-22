<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\County;

class CountySeeder extends Seeder
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
            
            County::create([
                'name' => $seed,
            ]);
        }
    }
    
    private function buildSeeds()
    {
        return [
            'Atlantic','Bergen','Burlington','Camden','Cape May','Cumberland','Essex','Gloucester','Hudson',
            'Hunterdon','Mercer','Middlesex','Morris','Ocean','Passaic','Salem','Somerset','Sussex','Union','Warren',
            'Monmouth',
        ];
    }
}
