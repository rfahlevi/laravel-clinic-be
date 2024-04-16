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
            "name" => fake()->unique()->name(),
            "specialization" => fake()->word(),
            "phone" => fake()->numberBetween(81000000000, 81999999999),
            "email" => fake()->email(),
            "photo" => 'https://img.freepik.com/free-vector/hand-drawn-doctor-cartoon-illustration_23-2150696182.jpg?w=1380&t=st=1713247452~exp=1713248052~hmac=9577a7ec13c38b3970158e3ce731b4441ea4f2c5f2bc9ac3fc487377360e4f64',
            "address" => fake()->address(),
            "sip" => fake()->numberBetween(10000000, 99999999),
            "id_ihs" => fake()->numberBetween(10000000, 99999999),
            "nik" => fake()->numberBetween(10000000, 99999999)
        ];
    }
}
