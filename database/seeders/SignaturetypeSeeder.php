<?php

namespace Database\Seeders;

use App\Models\Signaturetype;
use Illuminate\Database\Seeder;

class SignaturetypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['guardian','principal', 'student','teacher'];

        for($i=0;$i<4;$i++){
            Signaturetype::create([
                'descr' => $types[$i],
            ]);
        }
    }
}
