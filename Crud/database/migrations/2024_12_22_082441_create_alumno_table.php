<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alumno', function (Blueprint $table) {
            $table->unsignedBigInteger('idUsuario')->primary(); // Clave primaria
            $table->string('matricula', 10)->unique(); // Matrícula única
            $table->unsignedBigInteger('Institucion_idInstitucion'); // Relación con institución
            $table->unsignedBigInteger('Carreras_idCarrera'); // Relación con carrera
            $table->integer('semestre')->unsigned(); // Semestre (1-8)
            $table->string('grupo', 5); // Grupo (e.g., "A", "1B")
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idUsuario')->references('idUsuario')->on('usuario')->onDelete('cascade');
            $table->foreign('Institucion_idInstitucion')->references('idInstitucion')->on('institucion')->onDelete('cascade');
            $table->foreign('Carreras_idCarrera')->references('idCarrera')->on('carrera')->onDelete('cascade');

            // Índices adicionales
            $table->index('semestre');
            $table->index('grupo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumno');
    }
};
