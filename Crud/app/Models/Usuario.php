<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model{
    
    use HasFactory;

    protected $table = 'usuario';

    protected $fillable =[
        'idUsuario',
        'matricula',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'correo',
        'conf_correo',
        'contraseña',
        //'tipo',
        //'Alumno_Matricula',
        //'Administrador_idAdministrador',
        'genero',
        'edad'
    ];
    
}
