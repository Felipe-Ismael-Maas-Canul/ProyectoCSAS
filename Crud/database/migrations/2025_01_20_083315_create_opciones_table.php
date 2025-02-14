<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     */
    public function up(): void
    {
        Schema::create('opciones', function (Blueprint $table) {
            $table->id('idOpcion'); // Clave primaria
            $table->unsignedBigInteger('pregunta_idPregunta'); // Relación con Pregunta
            $table->string('texto', 255); // Texto de la opción (Ejemplo: "Totalmente de acuerdo")
            $table->integer('valor')->nullable(); // Valor numérico para Likert
            $table->timestamps();

            // Clave foránea
            $table->foreign('pregunta_idPregunta')->references('idPregunta')->on('preguntas')->onDelete('cascade');
        });
    }

    /**
     * Reversa la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('opciones');
    }
};
