<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupo'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'idGrupo'; // Clave primaria de la tabla

    protected $fillable = [
        'nombre',                   // Nombre del grupo
        'semestre',                 // Semestre del grupo (1-8)
        'generaciones_idGeneracion', // Relación con generación
        'idAdministrador'           // Relación con administrador
    ];

    /**
     * Relación con el modelo Generacion.
     */
    public function generacion()
    {
        return $this->belongsTo(Generacion::class, 'generaciones_idGeneracion', 'idGeneracion');
    }

    /**
     * Relación con el modelo Administrador.
     * Relación directa con el administrador que supervisa este grupo (opcional).
     */
    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'idAdministrador', 'idAdministrador');
    }

    /**
     * Relación con el modelo Administrador.
     * Relación many-to-many para los administradores vinculados al grupo.
     */
    public function administradores()
    {
        return $this->belongsToMany(
            Administrador::class,
            'administrador_grupo', // Tabla pivot
            'Grupo_idGrupo', // FK en pivot hacia Grupo
            'idAdministrador' // FK en pivot hacia Administrador
        )->withPivot('Generaciones_idGeneracion'); // Incluye el dato adicional de generación
    }

    /**
     * Relación con el modelo Alumno.
     */
    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'Grupo_idGrupo', 'idGrupo');
    }

    /**
     * Relación con el modelo Respuestas (opcional).
     */
    public function respuesta()
    {
        return $this->belongsTo(Respuestas::class, 'Respuesta_idRespuesta', 'idRespuesta');
    }
}
