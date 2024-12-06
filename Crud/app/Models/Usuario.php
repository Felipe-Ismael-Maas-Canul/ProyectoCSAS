<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario'; // Nombre de la tabla
    protected $primaryKey = 'idUsuario'; // Clave primaria personalizada

    /**
     * Campos permitidos para asignación masiva.
     */
    protected $fillable = [
        'matricula',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'correo',
        'password',
        //'tipo',
        //'Alumno_Matricula',
        //'Administrador_idAdministrador',
        'genero',
        'edad',
    ];

    /**
     * Ocultar campos sensibles en las respuestas JSON.
     */
    protected $hidden = ['password', 'created_at', 'updated_at'];

    /**
     * Mutador para encriptar la contraseña automáticamente.
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value) && !password_get_info($value)['algo']) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    /**
     * Relación con el modelo Alumno.
     * Un usuario puede ser un alumno.
     */
    public function alumno()
    {
        return $this->hasOne(Alumno::class, 'usuario_id', 'idUsuario');
    }

    /**
     * Relación con el modelo Administrador.
     * Un usuario puede ser un administrador.
     */
    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'usuario_id', 'idUsuario');
    }
}
