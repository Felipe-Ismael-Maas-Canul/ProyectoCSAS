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
        Schema::create('alumno', function (Blueprint $table) {
            $table->integer('matricula')->primary();
            $table->string('nombres', 45);
            $table->string('primer_apellido', 45);
            $table->string('segundo_apellido', 45);
            $table->unsignedBigInteger('Institucion_idInstitucion');
            $table->unsignedBigInteger('Carreras_idCarrera');
            $table->unsignedBigInteger('Generaciones_idGeneracion');
            $table->unsignedBigInteger('Grupo_idGrupo');
            $table->string('genero', 45);
            $table->integer('edad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno');
    }
};
