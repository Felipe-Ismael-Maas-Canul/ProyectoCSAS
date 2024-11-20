<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model{

    use HasFactory;

    protected $table = 'administrador';

    protected $primaryKey= 'idAdministrador';

    protected $fillable =[
        'idAdministrador',
        'nombre',
        'Grupo_idGrupo',
        'Alumno_Matricula'

    ];

    /**
     * Relación con el modelo Grupo.
     */
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'Grupo_idGrupo', 'idGrupo');
    }

    /**
     * Relación con el modelo Alumno.
     */
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'Alumno_Matricula', 'matricula');
    }

    /**
     * Relación con el modelo Usuario.
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'Administrador_idAdministrador', 'idAdministrador');
    }
}
