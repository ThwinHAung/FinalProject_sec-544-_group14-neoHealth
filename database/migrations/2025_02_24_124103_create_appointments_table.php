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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('time_slot_id');
            $table->text('note')->nullable();
            $table->enum('status', ['Booked', 'Completed', 'Cancelled'])->default('Booked');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('time_slot_id')->references('id')->on('time_slots')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
