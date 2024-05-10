<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pickup = fake()->dateTimeBetween('-100 minutes', '-80 minutes')->format('Y-m-d H:i:s');
        $dropoff = fake()->dateTimeBetween('-79 minutes', '-50 minutes')->format('Y-m-d H:i:s');
        $minutes = round((strtotime($dropoff) - strtotime($pickup)/60), 2);

        return [
            'id' => fake()->unique()->randomNumber(5),
            'driver_id' => fake()->unique()->randomNumber(5),
            'pickup' => $pickup,
            'dropoff' => $dropoff,
            'minutes' => $minutes,
        ];
    }
}
