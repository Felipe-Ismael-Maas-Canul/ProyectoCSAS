<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generacion extends Model
{
    use HasFactory;

    protected $table = 'generaciones'; // Nombre de la tabla en plural

    protected $primaryKey = 'idGeneracion'; // Llave primaria personalizada

    protected $fillable = [
        'fecha', // Fecha de generación
    ];

    /**
     * Relación con el modelo Grupo.
     */
    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'generaciones_idGeneracion', 'idGeneracion');
    }

    /**
     * Relación con el modelo Alumno.
     */
    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'generaciones_idGeneracion', 'idGeneracion');
    }
}
