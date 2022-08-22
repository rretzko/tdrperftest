<?php

namespace Database\Factories;

use App\Models\geostate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class GeostateFactory extends Factory
{
    use WithFaker;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = geostate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->state,
            'abbr' => strtoupper($this->faker->randomLetter.$this->faker->randomLetter),
        ];
    }
}
