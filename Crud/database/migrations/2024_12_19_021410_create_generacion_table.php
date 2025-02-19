<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('generaciones', function (Blueprint $table) {
            $table->bigIncrements('idGeneracion'); // Cambiado a bigIncrements
            $table->date('fecha')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('generaciones');
    }
};
