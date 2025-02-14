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
        Schema::create('grupo', function (Blueprint $table) {
            $table->id('idGrupo'); // Clave primaria
            $table->string('nombre', 1); // Nombre del grupo (una letra)
            $table->integer('semestre'); // Semestre
            $table->unsignedBigInteger('generaciones_idGeneracion')->nullable(); // Relación con generaciones
            $table->unsignedBigInteger('idAdministrador')->nullable(); // Relación con administrador
            $table->timestamps();

            // Clave foránea con generaciones (nombre actualizado)
            $table->foreign('generaciones_idGeneracion')->references('idGeneracion')->on('generaciones') // Cambiado a plural
                ->onDelete('set null');

            // Clave foránea con administrador
            $table->foreign('idAdministrador')->references('idAdministrador')->on('administrador')
                ->onDelete('set null');

            // Índices
            $table->index('semestre');
            $table->index('nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo');
    }
};
