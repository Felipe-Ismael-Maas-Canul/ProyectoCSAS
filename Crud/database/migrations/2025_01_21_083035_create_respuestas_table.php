<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id('idRespuesta');
            $table->unsignedBigInteger('Pregunta_idPregunta');
            $table->unsignedBigInteger('Alumno_idAlumno');
            $table->unsignedBigInteger('Opcion_idOpcion');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('Pregunta_idPregunta')->references('idPregunta')->on('preguntas')->onDelete('cascade');
            $table->foreign('Alumno_idAlumno')->references('idUsuario')->on('usuario')->onDelete('cascade');
            $table->foreign('Opcion_idOpcion')->references('idOpcion')->on('opciones')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('respuestas');
    }
};
