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
        Schema::create('geometrias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('desc')->nullable();
            $table->string('obs')->nullable();
            $table->tinyInteger('activa')->default(1); // Aquí defines 'activo' como tinyint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geometrias');
    }
};
