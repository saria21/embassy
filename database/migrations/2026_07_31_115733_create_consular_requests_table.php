<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consular_requests', function (Blueprint $table) {
            $table->id('request_id'); 
            $table->foreignId('citizen_id')->constrained('citizens', 'citizen_id')->onDelete('cascade');
            
            $table->string('request_type');
            $table->string('request_status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consular_requests');
    }
};
