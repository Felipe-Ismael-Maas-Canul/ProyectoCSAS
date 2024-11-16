<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model{

    use HasFactory;

    protected $table = 'alumno';

    protected $fillable =[
        'matricula',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'Institucion_idInstitucion',
        'Carreras_idCarrera',
        'Generaciones_idGeneracion',
        'Grupo_idGrupo',
        'genero',
        'edad'
    ];
}
