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
            $table->string('donorEmail');
            $table->string('donorId');
            $table->string('date');
            $table->string('time'); 
            $table->enum('appointmentStatus',['Pending','Scheduled','Cancelled'])->default('Pending');
            $table->string('NearestHospital'); 
            $table->timestamps();
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
