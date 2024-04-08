<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\PatientSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\DoctorScheduleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ClinicProfileSeeder::class,
            // DoctorSeeder::class,
            // DoctorScheduleSeeder::class,
            PatientSeeder::class,
        ]);
    }
}
