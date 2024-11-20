<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model{

    use HasFactory;

    protected $table = 'alumno';

    protected $primaryKey= 'matricula';

    protected $fillable =[
        'matricula',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'Institucion_idInstitucion',
        'Carreras_idCarrera',
        'Generaciones_idGeneracion',
        'Grupo_idGrupo',
        'genero',
        'edad'
    ];

    /**
     * Relación con el modelo Institucion.
     */
    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'Institucion_idInstitucion', 'idInstitucion');
    }

    /**
     * Relación con el modelo Carrera.
     */
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'Carreras_idCarrera', 'idCarrera');
    }

    /**
     * Relación con el modelo Generacion.
     */
    public function generacion()
    {
        return $this->belongsTo(Generacion::class, 'Generaciones_idGeneracion', 'idGeneracion');
    }

    /**
     * Relación con el modelo Grupo.
     */
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'Grupo_idGrupo', 'idGrupo');
    }

    /**
     * Relación con el modelo Usuario.
     */
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'Alumno_Matricula', 'matricula');
    }
}
