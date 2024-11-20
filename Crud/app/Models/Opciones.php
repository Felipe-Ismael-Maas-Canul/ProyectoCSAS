<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opciones extends Model{

    use HasFactory;

    protected $table = 'opciones';

    protected $primaryKey= 'idOpciones';

    protected $fillable =[
        'idOpciones',
        'texto',
        'valor',
        'pregunta_idPregunta'
    ];

    /**
     * Relación con el modelo Pregunta.
     * Una opción pertenece a una única pregunta.
     */
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'pregunta_idPregunta', 'idPregunta');
    }
}
