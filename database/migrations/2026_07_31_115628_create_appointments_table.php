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
            $table->id('appointment_id');
            $table->unsignedBigInteger('applicant_id'); // Plain column (applicant table coming later)
            $table->unsignedBigInteger('citizen_id');   // Plain column (citizen table coming later)
            
            // Safe to link since staff runs first
            $table->foreignId('interviewer_staff_id')->constrained('staff', 'staff_id')->onDelete('cascade');
            
            $table->dateTime('appointment_date');
            $table->string('purpose_of_visit');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
