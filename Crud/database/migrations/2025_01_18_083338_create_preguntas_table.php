<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id('idPregunta'); // Clave primaria
            $table->unsignedBigInteger('Encuesta_idEncuesta'); // Relación con Encuestas
            $table->unsignedBigInteger('Categoria_idCategoria')->nullable(); // Relación con Categorías
            $table->string('texto', 500); // Texto de la pregunta
            $table->enum('tipo_pregunta', ['likert', 'opcion_multiple', 'si_no', 'abierta'])->default('likert'); // Tipo de pregunta
            $table->timestamps();

            // Definir claves foráneas
            $table->foreign('Encuesta_idEncuesta')->references('idEncuesta')->on('encuestas')->onDelete('cascade');
            $table->foreign('Categoria_idCategoria')->references('idCategoria')->on('categorias')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
