<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuestas extends Model{
    
    use HasFactory;

    protected $table = 'encuestas';

    protected $fillable =[
        'idEncuestas',
        'fecha',
        'Alumno_Matricula',
        'Respuesta_idRespuesta'
    ];
}
