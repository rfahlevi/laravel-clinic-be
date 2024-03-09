<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClinicProfile>
 */
class ClinicProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => "Medical Healtcare",
            "address" => "Jl. Raya Bekasi KM.27, Kota Bekasi",
            "phone" => "081211223344",
            "email" => "medicalhealtcare@gmail.com",
            "logo" => fake()->imageUrl(),
            "description" => fake()->text(500),
            "doctor_name" => "Dr. Reza Fahlevi",
            "unique_code" => fake()->unique()->numberBetween(1000, 9999)
        ];
    }
}
