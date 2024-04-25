<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientReservation>
 */
class PatientReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => $this->faker->unique()->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'doctor_id' => $this->faker->numberBetween(1, 10),
            'schedule_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'complaint' => $this->faker->text(),
            'status' => 'Menunggu',
            'queue_number' => $this->faker->unique()->numberBetween(1, 10),
            'payment_method' => 'Tunai',
            'total_price' => $this->faker->numberBetween(50000, 500000),
        ];
    }
}
