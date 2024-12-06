<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada al modelo
    protected $table = 'alumno';

    // Clave primaria de la tabla
    protected $primaryKey = 'matricula';

    // Indicamos que la clave primaria no es autoincrementable
    public $incrementing = false;

    // Tipo de la clave primaria
    protected $keyType = 'string';

    // Campos que pueden ser llenados masivamente
    protected $fillable = [
        'matricula',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'Institucion_idInstitucion',
        'Carreras_idCarrera',
        'Generaciones_idGeneracion',
        'Grupo_idGrupo',
        'genero',
        'edad',
    ];

    /**
     * Relación con el modelo Institución.
     * Un alumno pertenece a una institución.
     */
    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'Institucion_idInstitucion', 'idInstitucion');
    }

    /**
     * Relación con el modelo Carrera.
     * Un alumno pertenece a una carrera.
     */
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'Carreras_idCarrera', 'idCarrera');
    }

    /**
     * Relación con el modelo Generación.
     * Un alumno pertenece a una generación.
     */
    public function generacion()
    {
        return $this->belongsTo(Generacion::class, 'Generaciones_idGeneracion', 'idGeneracion');
    }

    /**
     * Relación con el modelo Grupo.
     * Un alumno pertenece a un grupo.
     */
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'Grupo_idGrupo', 'idGrupo');
    }

    /**
     * Relación con el modelo Usuario.
     * Un alumno pertenece a un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'matricula', 'Alumno_Matricula');
    }
}
