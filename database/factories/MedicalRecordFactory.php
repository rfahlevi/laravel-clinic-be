<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //  $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
        //     $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
        //     $table->foreignId('patient_reservation_id')->constrained('patient_reservations')->onDelete('cascade');
        //     $table->text('diagnosis');
        //     $table->text('medical_treatment')->nullable();
        //     $table->text('doctor_notes')->nullable();
        return [
            'patient_id' => 1,
            'doctor_id' => 1,
            'patient_reservation_id' => 1,
            'diagnosis' => $this->faker->text(),
            'medical_treatment' => $this->faker->text(),
            'doctor_notes' => $this->faker->text(),
        ];
    }
}
