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
        Schema::create('administrador', function (Blueprint $table) {
            $table->unsignedBigInteger('idAdministrador')->primary(); // Clave primaria vinculada con usuario
            $table->string('id_admin', 10)->unique()->nullable(); // Identificador único del administrador
            $table->string('nombres', 100); // Aumentar tamaño del nombre para más flexibilidad
            $table->unsignedBigInteger('Institucion_idInstitucion'); // Relación con institución
            $table->timestamps();

            // Relaciones
            $table->foreign('idAdministrador')->references('idUsuario')->on('usuario')->onDelete('cascade');
            $table->foreign('Institucion_idInstitucion')->references('idInstitucion')->on('institucion')->onDelete('cascade');

            // Índices
            $table->index('id_admin');
            $table->index('Institucion_idInstitucion');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrador');
    }
};
