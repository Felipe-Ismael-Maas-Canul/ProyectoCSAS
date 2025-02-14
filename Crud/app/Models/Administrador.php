<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'administrador';

    // Clave primaria
    protected $primaryKey = 'idAdministrador';

    // Indicar que no es autoincrementable
    public $incrementing = false;

    // Tipo de clave primaria
    protected $keyType = 'integer';

    // Timestamps habilitados
    public $timestamps = true;

    // Campos llenables
    protected $fillable = [
        'idAdministrador', // Relación con usuario
        'id_admin', // Nuevo identificador único para administradores
        'nombres',
        'Institucion_idInstitucion'
    ];

    /**
     * Relación con el modelo Usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idAdministrador', 'idUsuario');
    }

    /**
     * Relación con el modelo Institución.
     */
    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'Institucion_idInstitucion', 'idInstitucion');
    }

    /**
     * Relación con el modelo Carrera.
     * Un administrador puede estar asociado a muchas carreras.
     */
    public function carreras()
    {
        return $this->belongsToMany(
            Carrera::class,
            'administrador_carrera', // Tabla pivot
            'Administrador_idAdministrador', // FK en pivot hacia Administrador
            'Carreras_idCarrera' // FK en pivot hacia Carrera
        );
    }

    /**
     * Relación con el modelo Grupo.
     * Un administrador puede estar asociado a muchos grupos.
     */
    public function grupos()
    {
        return $this->belongsToMany(
            Grupo::class,
            'administrador_grupo', // Tabla pivot
            'idAdministrador', // FK en pivot hacia Administrador
            'Grupo_idGrupo' // FK en pivot hacia Grupo
        )->withPivot('Generaciones_idGeneracion'); // Incluye el dato adicional de generación
    }
}
