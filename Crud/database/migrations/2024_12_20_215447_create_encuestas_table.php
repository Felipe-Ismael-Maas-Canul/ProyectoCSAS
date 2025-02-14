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
        Schema::create('encuestas', function (Blueprint $table) {
            $table->id('idEncuesta'); // Clave primaria
            $table->string('titulo', 255); // Título de la encuesta
            $table->text('descripcion')->nullable(); // Descripción opcional de la encuesta
            $table->unsignedBigInteger('generaciones_idGeneracion')->nullable(); // Acepta valores nulos
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->timestamps(); // created_at y updated_at

            // Índice opcional para mejorar búsquedas
            $table->index('fecha_inicio');
            $table->index('fecha_fin');
        });
    }

    /**
     * Reversa la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuestas');
    }
};
