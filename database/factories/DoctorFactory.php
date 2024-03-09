<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "specialization" => fake()->word(),
            "phone" => fake()->phoneNumber(),
            "email" => fake()->email(),
            "photo" => fake()->imageUrl(100, 100, 'person'),
            "address" => fake()->address(),
            "sip" => fake()->numberBetween(10000000, 99999999)
        ];
    }
}
