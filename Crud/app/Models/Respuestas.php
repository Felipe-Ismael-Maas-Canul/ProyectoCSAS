<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuestas extends Model{

    use HasFactory;

    protected $table = 'respuestas';
    protected $primaryKey = 'idRespuesta';

    protected $fillable = [
        'alumno_id',
        'Encuesta_idEncuesta',
        'Pregunta_idPregunta',
        'respuesta_texto',
    ];

    // Relación con Encuesta (Cada respuesta pertenece a una encuesta)
    public function encuesta()
    {
        return $this->belongsTo(Encuestas::class, 'Encuesta_idEncuesta', 'idEncuesta');
    }

    // Relación con Pregunta (Cada respuesta pertenece a una pregunta)
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'Pregunta_idPregunta', 'idPregunta');
    }
}
