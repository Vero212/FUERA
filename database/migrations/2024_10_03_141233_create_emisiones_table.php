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
        Schema::create('emisiones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('desc');
            $table->string('obs');
            $table->tinyInteger('activa')->default(1); // Aqu� defines 'activo' como tinyint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emisiones');
    }
};
