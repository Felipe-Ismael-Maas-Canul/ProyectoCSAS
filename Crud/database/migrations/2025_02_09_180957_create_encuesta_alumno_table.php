<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Ejecuta la migración.
     */
    public function up(): void
    {
        Schema::create('encuesta_alumno', function (Blueprint $table) {
            $table->id(); // Clave primaria única
            $table->unsignedBigInteger('idEncuesta'); // Relación con encuestas
            $table->string('matriculaAlumno', 10); // Cambiado a string para coincidir con alumno.matricula
            $table->unsignedBigInteger('Carreras_idCarrera')->nullable(); // Nueva columna para la relación con carreras
            $table->string('grupo', 5)->nullable(); // Ahora grupo es string
            $table->unsignedBigInteger('generaciones_idGeneracion')->nullable(); // Acepta valores nulos
            $table->timestamp('fecha_respuesta')->nullable(); // Fecha de respuesta
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idEncuesta')->references('idEncuesta')->on('encuestas')->onDelete('cascade');
            $table->foreign('matriculaAlumno')->references('matricula')->on('alumno')->onDelete('cascade');
            $table->foreign('generaciones_idGeneracion')->references('idGeneracion')->on('generaciones')->onDelete('cascade');
            $table->foreign('Carreras_idCarrera')->references('idCarrera')->on('carrera')->onDelete('cascade'); // Nueva clave foránea para la relación con carreras

            // Restricción única
            $table->unique(['idEncuesta', 'matriculaAlumno', 'grupo', 'generaciones_idGeneracion'], 'encuesta_alumno_unique');
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuesta_alumno');
    }
};
