<?php

namespace Database\Seeders;

use App\Models\Paymenttype;
use Illuminate\Database\Seeder;

class PaymenttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = ['cash', 'check', 'paypal', 'purchase order'];

        for($i=0; $i<count($seeds); $i++) {
            Paymenttype::create([
                'descr' => $seeds[$i],
            ]);
        }
    }
}
