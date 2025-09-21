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
        Schema::create('experiencia_matrimonio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('experiencia_id');
            $table->unsignedBigInteger('matrimonio_id');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('experiencia_id')->references('id')->on('experiencias')->onDelete('cascade');
            $table->foreign('matrimonio_id')->references('id')->on('matrimonios')->onDelete('cascade');

            // Índice único para evitar duplicados
            $table->unique(['experiencia_id', 'matrimonio_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiencia_matrimonio');
    }
};
