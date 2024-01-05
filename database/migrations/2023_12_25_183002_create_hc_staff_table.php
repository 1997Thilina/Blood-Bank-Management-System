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
        Schema::create('hc_staff', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('userEmail');
            $table->string('userId');
            $table->string('gender');
            $table->string('age');
            $table->string('phone');
            $table->string('nic');
            $table->string('possition');
            $table->string('workPlace');
            $table->string('bio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hc_staff');
    }
};
