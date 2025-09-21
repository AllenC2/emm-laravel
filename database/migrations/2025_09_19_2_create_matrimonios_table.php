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
        Schema::create('matrimonios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('telefono_ella')->nullable();
            $table->string('telefono_el')->nullable();
            $table->string('fin_de_semana')->nullable();
            $table->boolean('cabeza_comunidad')->default(false);
            $table->boolean('equipo_post')->default(false);
            $table->string('cargo_post')->nullable();
            $table->string('direccion')->nullable();
            $table->string('colonia')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('cumpleaños_el')->nullable();
            $table->string('cumpleaños_ella')->nullable();
            $table->string('aniversario')->nullable();
            $table->integer('numero_hijos')->nullable();
            $table->integer('hijos_solteros')->nullable();
            $table->string('edades_hijos')->nullable();
            $table->unsignedBigInteger('comunidad_id')->nullable();
            $table->foreign('comunidad_id')->references('id')->on('comunidades')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matrimonios');
    }
};
