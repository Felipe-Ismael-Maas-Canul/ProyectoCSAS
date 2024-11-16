<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuestas extends Model{

    use HasFactory;

    protected $table = 'respuestas';

    protected $fillable =[
            'idRespuesta',
            'opciones_idOpciones',
            'opciones_pregunta_idPregunta',
            'opciones_pregunta_variable_idVariable'
    ];
}
