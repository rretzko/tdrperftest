<?php

namespace Database\Seeders;

use App\Models\Filecontenttype;
use Illuminate\Database\Seeder;

class FilecontenttypeSeeder extends Seeder
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

            Filecontenttype::create([
                'id' => $seed['id'],
                'descr' => $seed['descr'],
            ]);
        }
    }

    private function buildSeeds()
    {
        return [
            ['id'=>1,'descr'=>'scales'],
            ['id'=>2,'descr'=>'arpeggios'],
            ['id'=>3,'descr'=>'quartet'],
            ['id'=>4,'descr'=>'quintet'],
            ['id'=>5,'descr'=>'solo'],
            ['id'=>6,'descr'=>'performance: ensemble'],
            ['id'=>7,'descr'=>'other'],
            ['id'=>8,'descr'=>'performance: joint'],
            ['id'=>9,'descr'=>'performance: all ensembles'],
        ];
    }
}
