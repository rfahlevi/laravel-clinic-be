<?php

namespace Database\Seeders;

use App\Models\PaymentDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentDetail::factory(1)->create();
    }
}
