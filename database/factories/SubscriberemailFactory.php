<?php

namespace Database\Factories;

use App\Models\Subscriberemail;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberemailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscriberemail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $sequence = 0;
        return [
            'emailtype_id' => rand(1,3),
            'user_id' => ++$sequence,
            'email' => $this->faker->email(),
        ];
    }
}
