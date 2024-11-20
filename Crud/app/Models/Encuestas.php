<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuestas extends Model{
    
    use HasFactory;

    protected $table = 'encuestas';

    protected $primaryKey= 'idEncuestas';

    protected $fillable =[
        'idEncuestas',
        'fecha',
        'Alumno_Matricula',
        'Respuesta_idRespuesta'
    ];

    /**
     * Relación con el modelo Alumno.
     */
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'Alumno_Matricula', 'matricula');
    }

    /**
     * Relación con el modelo Respuesta.
     */
    public function respuesta()
    {
        return $this->belongsTo(Respuestas::class, 'Respuesta_idRespuesta', 'idRespuesta');
    }
}