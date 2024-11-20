<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variable extends Model{
    
    use HasFactory;

    protected $table = 'variable';

    protected $primaryKey= 'idVariable';

    protected $fillable =[
        'idVariable',
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
     * Una variable puede tener muchas preguntas asociadas.
     */
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'variable_idVariable', 'idVariable');
    }
}