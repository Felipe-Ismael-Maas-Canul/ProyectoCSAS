<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model{

    use HasFactory;

    protected $table = 'pregunta';

    protected $primaryKey= 'idPregunta';

    protected $fillable =[
            'idPregunta',
            'texto',
            'variable_idVariable'
    ];
    /**
     * Relación con el modelo Variable.
     * Una pregunta pertenece a una única variable.
     */
    public function variable()
    {
        return $this->belongsTo(Variable::class, 'variable_idVariable', 'idVariable');
    }

    /**
     * Relación con el modelo Opciones.
     * Una pregunta tiene muchas opciones.
     */
    public function opciones()
    {
        return $this->hasMany(Opciones::class, 'pregunta_idPregunta', 'idPregunta');
    }
}