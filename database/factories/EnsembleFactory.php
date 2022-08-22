<?php

namespace Database\Factories;

use App\Models\Ensemble;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class EnsembleFactory extends Factory
{
    use WithFaker;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ensemble::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition($args = [])
    {
        return [
     //       'user_id' => $user->id,
     //       'school_id' => $school->id,
            'name' => implode(' ',$this->faker->words(4)),
            'abbr' => $this->faker->lexify('??????'),
            'descr' => $this->faker->paragraph(),
        ];
    }
}
