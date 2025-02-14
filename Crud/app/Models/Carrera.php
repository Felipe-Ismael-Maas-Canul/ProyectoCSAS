<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = 'carrera';

    protected $primaryKey = 'idCarrera';

    protected $fillable = [
        'idCarrera',
        'nombre',
        'institucion_idInstitucion'
    ];

    /**
     * Relación con el modelo Institucion.
     */
    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucion_idInstitucion', 'idInstitucion');
    }

    /**
     * Relación con el modelo Alumno.
     */
    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'Carreras_idCarrera', 'idCarrera');
    }

    /**
     * Relación con el modelo Administrador.
     * Una carrera puede estar asociada a muchos administradores.
     */
    public function administradores()
    {
        return $this->belongsToMany(
            Administrador::class,
            'administrador_carrera', // Tabla pivot
            'Carreras_idCarrera', // FK en pivot hacia Carrera
            'Administrador_idAdministrador' // FK en pivot hacia Administrador
        );
    }
}
