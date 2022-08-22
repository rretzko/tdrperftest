<?php

namespace Database\Seeders;

use App\Models\Eventversionvideos;
use Illuminate\Database\Seeder;

class EventversionvideosSeeder extends Seeder
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
        foreach($this->seeds AS $seed) {
            Eventversionvideos::create([
                'eventversion_id' => $seed['eventversion_id'],
                'videotype_ids' => $seed['videotype_ids'],
            ]);
        }
    }

    private function buildSeeds()
    {
        return [
            [
                'eventversion_id' => 61,
                'videotype_ids' => '2,3,1,5',
            ],
            [
                'eventversion_id' => 62,
                'videotype_ids' => '9,6',
            ],
            [
                'eventversion_id' => 63,
                'videotype_ids' => '9,6,8',
            ],
            [
                'eventversion_id' => 64,
                'videotype_ids' => '9,6,8',
            ],
            [
                'eventversion_id' => 65,
                'videotype_ids' => '4,1,5',
            ],
        ];
    }
}
