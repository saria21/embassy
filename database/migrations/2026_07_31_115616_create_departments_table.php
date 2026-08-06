<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('related_buildings', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->timestamps();
        });
      
        Schema::create('departments', function (Blueprint $table) {
            $table->id('department_id');
            $table->string('name');
            $table->foreignId('building_id')->constrained('related_buildings')->onDelete('cascade');
            
            $table->timestamps();
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->foreign('department_id')->references('department_id')
            ->on('departments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Drop foreign keys first, then drop the tables in reverse order
        Schema::table('staff', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });

        Schema::dropIfExists('departments');
        Schema::dropIfExists('related_buildings');
    }
};
