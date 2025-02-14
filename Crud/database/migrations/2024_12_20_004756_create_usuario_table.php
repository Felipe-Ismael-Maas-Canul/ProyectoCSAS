<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigIncrements('idUsuario'); // Clave primaria autoincremental
            $table->enum('tipo', ['Alumno', 'Administrador']);
            $table->string('id_admin', 10)->unique()->nullable(); // Solo para administradores
            $table->string('matricula', 10)->unique()->nullable(); // Solo para alumnos
            $table->string('nombres', 45);
            $table->string('primer_apellido', 45);
            $table->string('segundo_apellido', 45)->nullable();
            $table->string('correo', 45)->unique();
            $table->string('password', 255);
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro']);
            $table->integer('edad');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};

