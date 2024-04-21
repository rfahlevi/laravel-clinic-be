<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PatientReservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PatientReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PatientReservation::factory(10)->create();
    }
}
