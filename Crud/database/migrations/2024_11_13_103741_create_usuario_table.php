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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('idUsuario');
            $table->integer('matricula')->unique();
            $table->string('nombres', 45);
            $table->string('primer_apellido', 45);
            $table->string('segundo_apellido', 45);
            $table->string('correo', 45)->unique();
            $table->string('conf_correo', 45);
            $table->string('contraseña', 45);
            $table->enum('tipo', ['Alumno', 'Administrador']);
            $table->unsignedBigInteger('Alumno_Matricula')->nullable();
            $table->unsignedBigInteger('Administrador_idAdministrador')->nullable();
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
        Schema::dropIfExists('usuario');
    }
};
