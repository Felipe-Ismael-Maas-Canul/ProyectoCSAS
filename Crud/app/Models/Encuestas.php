<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuestas extends Model
{
    use HasFactory;

    protected $table = 'encuestas';
    protected $primaryKey = 'idEncuesta';

    protected $fillable = [
        'titulo',
        'descripcion',
        'generaciones_idGeneracion',
        'fecha_inicio',
        'fecha_fin'
    ];

    // Una encuesta tiene muchas preguntas
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'Encuesta_idEncuesta', 'idEncuesta');
    }

    // Una encuesta tiene muchas respuestas
    public function respuestas()
    {
        return $this->hasMany(Respuestas::class, 'Encuesta_idEncuesta', 'idEncuesta');
    }

    /**
     * Relación muchos a muchos con Categorías.
     *
     * Cada encuesta puede pertenecer a múltiples categorías, y
     * cada categoría puede estar asociada con múltiples encuestas.
     * Esta relación se maneja a través de la tabla intermedia "categoria_encuesta".
    */
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_encuesta', 'Encuesta_idEncuesta', 'Categoria_idCategoria');
    }


    // Una encuesta puede ser respondida por muchos alumnos
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'encuesta_alumno', 'idEncuesta', 'matriculaAlumno')
                    ->withPivot('grupo', 'generaciones_idGeneracion', 'fecha_respuesta') // Cambiado 'Grupo_idGrupo' por 'grupo'
                    ->withTimestamps();
    }


    /**
     * Relación con el modelo Generación.
     * Un alumno pertenece a una generación.
     */
    public function generacion()
    {
        return $this->belongsTo(Generacion::class, 'generaciones_idGeneracion', 'idGeneracion');
    }

}
