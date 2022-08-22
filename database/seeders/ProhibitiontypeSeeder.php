<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProhibitiontypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = ['missed rehearsals', 'late arrivals','early departures',
            'missed concert','behavioral issues','inappropriate behavior'];
        
        foreach($seeds AS $seed){
            \App\Models\Prohibitiontype::create([
                'descr' => $seed,
            ]);
        }
    }
}
