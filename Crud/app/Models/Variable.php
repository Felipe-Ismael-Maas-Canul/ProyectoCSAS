<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variable extends Model{

    use HasFactory;

    protected $table = 'variable'; // Cambia a plural si la tabla en BD es "variables"

    protected $primaryKey = 'idVariable';

    protected $fillable = [
        'nombre',
        'categoria_idCategoria'
    ];

    /**
     * Relación con el modelo Categoria.
     * Una variable pertenece a una categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_idCategoria', 'idCategoria');
    }

    /**
     * Relación con el modelo Pregunta.
     * Una variable puede estar asociada a varias preguntas.
     */
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'variable_idVariable', 'idVariable');
    }
}
