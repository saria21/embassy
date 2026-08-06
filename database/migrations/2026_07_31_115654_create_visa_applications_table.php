<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visa_applicants', function (Blueprint $table) {
            $table->id('applicant_id'); // Primary Key from your ERD
            $table->string('passport_number')->unique();
            $table->string('full_name');
            $table->string('nationality');
            $table->timestamps();
        });

        Schema::create('visa_applications', function (Blueprint $table) {
            $table->id('application_id'); // Primary Key from your ERD
            
            $table->foreignId('applicant_id')->constrained('visa_applicants', 'applicant_id')->onDelete('cascade');
            
            $table->string('visa_type');
            $table->string('application_status');
            $table->timestamps();
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('applicant_id')->references('applicant_id')->on('visa_applicants')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['applicant_id']);
        });
        
        Schema::dropIfExists('visa_applications');
        Schema::dropIfExists('visa_applicants');
    }
};
