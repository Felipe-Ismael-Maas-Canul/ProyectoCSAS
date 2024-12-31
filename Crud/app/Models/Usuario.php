<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Cambiar a Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable // Extiende Authenticatable para usar autenticación
{
    use HasFactory, Notifiable;

    // Especifica el nombre de la tabla en la base de datos
    protected $table = 'usuario'; // Nombre de la tabla

    // Define la clave primaria
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
        'tipo',
        'Alumno_Matricula',
        'Administrador_idAdministrador',
        'genero',
        'edad',
    ];

    /**
     * Ocultar campos sensibles en las respuestas JSON.
     */
    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];

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
     * Configura el campo de autenticación
     */
    public function getAuthIdentifierName()
    {
        return 'correo'; // Cambia esto si usas 'correo' en lugar de 'email'
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
