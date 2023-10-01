<?php

namespace Database\Factories;

use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Participant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'type' => $this->faker->randomNumber,
            'group' => $this->faker->randomNumber(0),
            'gender' => \Arr::random(['male', 'female', 'other']),
        ];
    }
}
