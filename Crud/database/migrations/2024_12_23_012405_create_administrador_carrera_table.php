<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('administrador_carrera', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Administrador_idAdministrador');
            $table->unsignedBigInteger('Carreras_idCarrera');
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('Administrador_idAdministrador')->references('idAdministrador')->on('administrador')->onDelete('cascade');
            $table->foreign('Carreras_idCarrera')->references('idCarrera')->on('carrera')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('administrador_carrera');
    }
};
