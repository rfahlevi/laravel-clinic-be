<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $table->string('nik');
        //     $table->string('no_kk');
        //     $table->string('name');
        //     $table->string('phone');
        //     $table->string('email')->nullable();
        //     $table->enum('gender', ['Pria', 'Wanita'])->default('Pria');
        //     $table->string('birth_place');
        //     $table->date('birth_date');
        //     $table->text('address_line');
        //     $table->string('city');
        //     $table->string('city_code');
        //     $table->string('province');
        //     $table->string('province_code');
        //     $table->string('district');
        //     $table->string('district_code');
        //     $table->string('village');
        //     $table->string('village_code');
        //     $table->string('rt');
        //     $table->string('rw');
        //     $table->string('postal_code');
        //     $table->enum('marital_status', ['Belum Menikah', 'Menikah', 'Cerai'])->default('Belum Menikah');
        //     $table->string('relationship_name')->nullable();
        //     $table->string('relationship_phone')->nullable();
        //     $table->boolean('is_deceased')->default(false);
        return [
            'nik' => fake()->randomNumber(8, true),
            'no_kk' => fake()->randomNumber(8, true),
            'name' => fake()->name(),
            "phone" => fake()->numberBetween(81000000000, 81999999999),
            'email' => fake()->email(),
            'gender' => fake()->randomElement(['Pria', 'Wanita']),
            'birth_place' => fake()->city(),
            'birth_date' => fake()->date(),
            'address_line' => fake()->streetAddress(),
            'city' => fake()->city(),
            'city_code' => fake()->postcode(),
            'province' => fake()->state(),
            'province_code' => fake()->postcode(),
            'district' => fake()->state(),
            'district_code' => fake()->postcode(),
            'village' => fake()->citySuffix(),
            'village_code' => fake()->postcode(),
            'rt' => fake()->randomDigit(),
            'rw' => fake()->randomDigit(),
            'postal_code' => fake()->postcode(),
            'marital_status' => fake()->randomElement(['Belum Menikah', 'Menikah', 'Cerai']),
            'is_deceased' => false
        ];
    }
}
