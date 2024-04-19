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
        // Dr. Andi Puspita, Sp.A (Spesialis Anak)
        // Dr. Budi Santoso, Sp.B (Spesialis Bedah)
        // Dr. Cinta Lestari, Sp.OG (Spesialis Obstetri dan Ginekologi)
        // Dr. Dian Surya, Sp.KK (Spesialis Kulit dan Kelamin)
        // Dr. Eko Wibowo, Sp.THT (Spesialis Telinga Hidung Tenggorokan)
        // Dr. Fika Rahman, Sp.PD (Spesialis Penyakit Dalam)
        // Dr. Galih Prasetyo, Sp.AK (Spesialis Anatomi Klinik)
        // Dr. Hadi Utomo, Sp.U (Spesialis Urologi)
        // Dr. Ika Pratiwi, Sp.PA (Spesialis Patologi Anatomi)
        // Dr. Joko Susilo, Sp.JP (Spesialis Jantung dan Pembuluh Darah)

        $names = ['Dr. Andi Puspita', 'Dr. Budi Santoso', 'Dr. Cinta Lestari', 'Dr. Eko Wibowo', 'Dr. Fika Rahman', 'Dr. Galih Prasetyo', 'Dr. Hadi Utomo', 'Dr. Ika Pratiwi', 'Dr. Joko Susilo', 'Dr. Dian Surya'];

        $specializations = ['Sp.A', 'Sp.B', 'Sp.OG', 'Sp.KK', 'Sp.THT', 'Sp.PD', 'Sp.AK', 'Sp.U', 'Sp.JP'];
        return [
            'name' => fake()->unique()->randomElement($names),
            'specialization' => fake()->randomElement($specializations),
            'phone' => fake()->numberBetween(81000000000, 81999999999),
            'email' => fake()->email(),
            'photo' => 'https://img.freepik.com/free-vector/hand-drawn-doctor-cartoon-illustration_23-2150696182.jpg?w=1380&t=st=1713247452~exp=1713248052~hmac=9577a7ec13c38b3970158e3ce731b4441ea4f2c5f2bc9ac3fc487377360e4f64',
            'address' => fake()->address(),
            'sip' => fake()->numberBetween(10000000, 99999999),
            'id_ihs' => fake()->numberBetween(10000000, 99999999),
            'nik' => fake()->numberBetween(10000000, 99999999),
        ];
    }
}
