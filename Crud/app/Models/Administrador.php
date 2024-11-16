<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model{

    use HasFactory;

    protected $table = 'administrador';

    protected $fillable =[
        'idAdministrador',
        'nombre',
        'Grupo_idGrupo',
        'Alumno_Matricula'

    ];    
}
