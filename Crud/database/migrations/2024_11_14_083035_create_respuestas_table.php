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
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id('idRespuesta');
            $table->unsignedBigInteger('opciones_idOpciones');
            $table->unsignedBigInteger('opciones_pregunta_idPregunta');
            $table->unsignedBigInteger('opciones_pregunta_variable_idVariable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas');
    }
};
