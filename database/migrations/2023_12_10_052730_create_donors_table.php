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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('userEmail')->unique();
            $table->string('userId');
            $table->string('bloodType');
            $table->string('gender');
            $table->string('age');
            $table->string('phone');
            $table->string('nic');
            $table->string('availability');
            $table->string('hospital');
            $table->string('bio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
