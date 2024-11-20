<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model{
    
    use HasFactory;

    protected $table = 'usuario';

    protected $primaryKey= 'idUsuario';
    
    protected $fillable =[
        'idUsuario',
        'matricula',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'correo',
        'contraseña',
        'tipo',
        'Alumno_Matricula',
        'Administrador_idAdministrador',
        'genero',
        'edad'
    ];
    
 /**
     * Relación con el modelo Alumno.
     */
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'Alumno_Matricula', 'matricula');
    }

    /**
     * Relación con el modelo Administrador.
     */
    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'Administrador_idAdministrador', 'idAdministrador');
    }
}
