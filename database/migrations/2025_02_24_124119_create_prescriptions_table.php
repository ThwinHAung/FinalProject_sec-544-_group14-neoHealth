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
        Schema::create('medicine_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->string('medicine_name', 255);
            $table->text('description')->nullable();
            $table->string('dosage', 255);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('appointment_id')->references('id')->on('appointments')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
