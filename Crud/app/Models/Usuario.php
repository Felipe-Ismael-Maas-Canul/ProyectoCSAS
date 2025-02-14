<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Nombre de la tabla en la base de datos
    protected $table = 'usuario';

    // Clave primaria
    protected $primaryKey = 'idUsuario';

    // Indicar que es autoincrementable
    public $incrementing = true;

    // Campos llenables masivamente
    protected $fillable = [
        'idUsuario',
        'id_admin',
        'matricula',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'correo',
        'password',
        'tipo',
        'genero',
        'edad',
    ];

    // Campos ocultos en la salida JSON
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * Relación con el modelo Alumno.
     */
    public function alumno()
    {
        return $this->hasOne(Alumno::class, 'idUsuario', 'idUsuario');
    }

    /**
     * Relación con el modelo Administrador.
     */
    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'idAdministrador', 'idUsuario');
    }

    /**
     * Mutador para encriptar automáticamente la contraseña antes de guardarla.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Método para autenticar por correo en lugar de idUsuario.
     */
    public function getAuthIdentifierName()
    {
        return 'correo';
    }

    /**
     * Método para verificar si el usuario es Alumno.
     */
    public function isAlumno()
    {
        return $this->tipo === 'Alumno';
    }

    /**
     * Método para verificar si el usuario es Administrador.
     */
    public function isAdministrador()
    {
        return $this->tipo === 'Administrador';
    }

    /**
     * Accesor para obtener el tipo de usuario en texto claro.
     */
    public function getTipoUsuarioAttribute()
    {
        return $this->tipo;
    }
}
