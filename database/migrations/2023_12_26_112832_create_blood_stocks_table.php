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
        Schema::create('blood_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('bloodType');
            $table->integer('units');
            $table->string('status');
            $table->string('expireDate');
            $table->string('hospital_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_stocks');
    }
};
