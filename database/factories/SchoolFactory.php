<?php

namespace Database\Factories;

use App\Models\geostate;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word.' High School',
            'address0' => $this->faker->address,
            'city' => $this->faker->city,
            'geostate_id' => function(){
                return Geostate::factory()->create()->id;
            },
            'postalcode' => $this->faker->postcode,
        ];
    }
}
