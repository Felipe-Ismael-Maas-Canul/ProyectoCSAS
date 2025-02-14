<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $table = 'preguntas';
    protected $primaryKey = 'idPregunta';

    protected $fillable = [
        'texto',
        'tipo_pregunta', // Se agrega el tipo de pregunta
        'Encuesta_idEncuesta',
        'Categoria_idCategoria',
        'Variable_idVariable'
    ];

    // Relación: Una pregunta pertenece a una encuesta
    public function encuesta()
    {
        return $this->belongsTo(Encuestas::class, 'Encuesta_idEncuesta', 'idEncuesta');
    }

    // Relación: Una pregunta pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'Categoria_idCategoria', 'idCategoria')->nullable();
    }

    // Relación: Una pregunta tiene muchas opciones (para preguntas de tipo múltiple)
    public function opciones()
    {
        return $this->hasMany(Opciones::class, 'Pregunta_idPregunta', 'idPregunta');
    }

    // Relación: Una pregunta pertenece a una variable (para cálculos estadísticos)
    public function variable()
    {
        return $this->belongsTo(Variable::class, 'Variable_idVariable', 'idVariable');
    }
}
