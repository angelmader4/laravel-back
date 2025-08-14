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
        Schema::create('fk_tarifa_tarea', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tarifa')->constrained('tarifas')->noActionOnDelete();
            $table->foreignId('id_tarea')->constrained('tarea')->noActionOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fk_tarifa_tarea');
    }
};
