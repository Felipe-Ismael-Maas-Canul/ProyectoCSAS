<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumno'; // Tabla asociada
    protected $primaryKey = 'idUsuario'; // Clave primaria
    public $incrementing = false; // No autoincremental
    protected $keyType = 'integer'; // Tipo de clave primaria

    protected $fillable = [
        'idUsuario',
        'matricula',
        'Institucion_idInstitucion',
        'Carreras_idCarrera',
        'semestre',
        'grupo',
    ];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario', 'idUsuario');
    }

    // Relación con Institución
    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'Institucion_idInstitucion', 'idInstitucion');
    }

    // Relación con Carrera
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'Carreras_idCarrera', 'idCarrera');
    }

    // Relación con Encuestas (muchos a muchos)
    public function encuestas()
    {
        return $this->belongsToMany(Encuestas::class, 'encuesta_alumno', 'matriculaAlumno', 'idEncuesta')->withTimestamps();
    }
}
