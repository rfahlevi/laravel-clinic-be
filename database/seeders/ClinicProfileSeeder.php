<?php

namespace Database\Seeders;

use App\Models\ClinicProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClinicProfile::factory(1)->create();
    }
}
