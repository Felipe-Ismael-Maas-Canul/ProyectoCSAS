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
            $table->bigIncrements('idUsuario'); // Definir el campo como autoincrementable
            $table->enum('tipo', ['Alumno', 'Administrador']);
            $table->unsignedBigInteger('Administrador_idAdministrador')->nullable();
            $table->unsignedBigInteger('Alumno_Matricula')->nullable();
            $table->integer('matricula')->unique()->nullable(); // Ahora es opcional
            $table->string('nombres', 45);
            $table->string('primer_apellido', 45);
            $table->string('segundo_apellido', 45);
            $table->string('correo', 45)->unique();
            $table->string('password', 255);
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro']); // Opciones para género
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
