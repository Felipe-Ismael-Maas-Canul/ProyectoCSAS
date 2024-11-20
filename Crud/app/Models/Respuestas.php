<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuestas extends Model{

    use HasFactory;

    protected $table = 'respuestas';

    protected $primaryKey= 'idRespuestas';

    protected $fillable =[
            'idRespuestas',
            'opciones_idOpciones',
            'opciones_pregunta_idPregunta',
            'opciones_pregunta_variable_idVariable'
    ];
    
    /**
     * Relación con el modelo Opciones.
     * Una respuesta pertenece a una única opción.
     */
    public function opciones()
    {
        return $this->belongsTo(Opciones::class, 'opciones_idOpciones', 'idOpciones');
    }

    /**
     * Relación con el modelo Pregunta.
     * Una respuesta también se puede asociar con una pregunta a través de la opción.
     */
    public function pregunta()
    {
        return $this->hasOneThrough(Pregunta::class, Opciones::class, 'idOpciones', 'idPregunta', 'opciones_idOpciones', 'pregunta_idPregunta');
    }

    /**
     * Relación con el modelo Variable.
     * Una respuesta también se puede asociar con una variable a través de la opción.
     */
    public function variable()
    {
        return $this->hasOneThrough(Variable::class, Opciones::class, 'idOpciones', 'idVariable', 'opciones_idOpciones', 'variable_idVariable');
    }
}