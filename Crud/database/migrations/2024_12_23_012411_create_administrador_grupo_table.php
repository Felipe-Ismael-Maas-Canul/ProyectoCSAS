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
        Schema::create('administrador_grupo', function (Blueprint $table) {
            $table->id(); // Clave primaria única
            $table->unsignedBigInteger('idAdministrador'); // Relación con administrador
            $table->unsignedBigInteger('Grupo_idGrupo'); // Relación con grupo
            $table->unsignedBigInteger('Generaciones_idGeneracion')->nullable(); // Relación con generaciones
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idAdministrador')->references('idAdministrador')->on('administrador')->onDelete('cascade');
            $table->foreign('Grupo_idGrupo')->references('idGrupo')->on('grupo')->onDelete('cascade');
            $table->foreign('Generaciones_idGeneracion')->references('idGeneracion')->on('generaciones')->onDelete('set null'); // Cambiado a generaciones
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrador_grupo');
    }
};

