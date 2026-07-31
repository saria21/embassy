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
     
        Schema::create('staff', function (Blueprint $table) {
            $table->id('staff_id'); // Primary Key matching your ERD
            $table->string('full_name');
            $table->string('job_title');
            $table->string('role');
            
            // Defined as a plain column for now to prevent table-order errors
            $table->unsignedBigInteger('department_id'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
