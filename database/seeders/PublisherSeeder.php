<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    private $seeds;

    public function __construct()
    {
        //instantiate $this->seeds with publisher data
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

            $model = new Publisher;

            $model->id = $seed[0];
            $model->name = $seed[1];
            $model->address0 = $seed[2];
            $model->address1 = $seed[3];
            $model->city = $seed[4];
            $model->geostate_id = $seed[5];
            $model->postalcode = $seed[6];
            $model->created_at = (isset($seed[7])) ? $seed[7] : date('Y-m-d H:i:s');
            $model->updated_at = (isset($seed[8])) ? $seed[8] : date('Y-m-d H:i:s');

            $model->save();
        }
    }

    private function buildSeeds()
    {
        return [
            [1, 'Charles Hansen II Music & Books of California', '2030 S. Sepulveda Blvd', '', 'West Lost Angeles', 6, '90025', '2021-7-15', '2021-7-15'],
            [2, 'Hansen House', '1860 Broadway', '', 'New York City', 40, '10023', '2021-07-17', '2021-07-17'],
        ];
    }
}
