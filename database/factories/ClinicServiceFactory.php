<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClinicService>
 */
class ClinicServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'category' => fake()->randomElement(['Obat-Obatan', 'Konsultasi', 'Treatment']),
            'price' => fake()->numberBetween(30000, 1000000),
            'qty' => fake()->numberBetween(1, 10),
        ];
    }
}
