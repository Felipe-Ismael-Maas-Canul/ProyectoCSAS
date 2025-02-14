<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model{

    use HasFactory;

    protected $table = 'institucion';

    protected $primaryKey= 'idInstitucion';

    protected $fillable =[
        'idInstitucion',
        'nombre'
    ];

    /**
     * Relación con el modelo Carrera.
     * Una institución puede tener muchas carreras asociadas.
     */
    public function carreras()
    {
        return $this->hasMany(Carrera::class, 'institucion_idInstitucion', 'idInstitucion');
    }

    /**
     * Relación con el modelo Generacion.
     * Una institución puede tener muchas generaciones asociadas.
     */
    public function generaciones()
    {
        return $this->hasMany(Generacion::class, 'institucion_idInstitucion', 'idInstitucion');
    }
}
