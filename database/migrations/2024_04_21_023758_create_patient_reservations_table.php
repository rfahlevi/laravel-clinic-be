<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients');
            $table->foreignId('doctor_id')->constrained('doctors');
            $table->dateTime('schedule_time');
            $table->text('complaint');
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai', 'Batal'])->default('Menunggu');
            $table->integer('queue_number')->nullable();
            $table->enum('payment_method', ['Tunai', 'QRIS'])->default('Tunai');
            $table->bigInteger('total_price')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_reservations');
    }
};
