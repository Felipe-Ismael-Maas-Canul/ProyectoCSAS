<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'idCategoria';

    protected $fillable = [
        'nombre',
        'descripcion', // Esto debe estar en el modelo para poder actualizarlo
    ];

    // Relación muchos a muchos con Encuestas a través de la tabla intermedia "categoria_encuesta"
    public function encuestas()
    {
        return $this->belongsToMany(Encuestas::class, 'categoria_encuesta', 'Categoria_idCategoria', 'Encuesta_idEncuesta');
    }

    // Relación uno a muchos con Preguntas
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'Categoria_idCategoria', 'idCategoria');
    }
}
