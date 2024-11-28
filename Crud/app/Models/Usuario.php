<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';

    protected $primaryKey = 'idUsuario';

    protected $fillable = [
        'idUsuario',
        'matricula',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'correo',
        'password', // Se usará en el código, pero mapeará a "contraseña"
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

    /**
     * Accessor para obtener el valor de la columna "contraseña" usando "password".
     */
    public function getPasswordAttribute()
    {
        return $this->attributes['contraseña'];
    }

    /**
     * Mutator para establecer el valor en la columna "contraseña" usando "password".
     */
    public function setPasswordAttribute($value)
    {
        // Encriptar la contraseña antes de almacenarla
        $this->attributes['contraseña'] = bcrypt($value);
    }
}
