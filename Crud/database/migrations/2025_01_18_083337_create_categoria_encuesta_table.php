<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categoria_encuesta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Encuesta_idEncuesta')->index();
            $table->unsignedBigInteger('Categoria_idCategoria')->index();
            $table->timestamps();

            // Claves foráneas
            $table->foreign('Encuesta_idEncuesta')->references('idEncuesta')->on('encuestas')->onDelete('cascade');
            $table->foreign('Categoria_idCategoria')->references('idCategoria')->on('categorias')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categoria_encuesta');
    }
};
