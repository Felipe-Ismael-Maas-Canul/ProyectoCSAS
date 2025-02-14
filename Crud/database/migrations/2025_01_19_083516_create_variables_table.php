<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('variables', function (Blueprint $table) {
            $table->id('idVariable');
            $table->unsignedBigInteger('Categoria_idCategoria');
            $table->unsignedBigInteger('Pregunta_idPregunta');
            $table->integer('valor'); // Valor asignado a cada categoría
            $table->timestamps();

            // Claves foráneas
            $table->foreign('Categoria_idCategoria')->references('idCategoria')->on('categorias')->onDelete('cascade');
            $table->foreign('Pregunta_idPregunta')->references('idPregunta')->on('preguntas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('variables');
    }
};
