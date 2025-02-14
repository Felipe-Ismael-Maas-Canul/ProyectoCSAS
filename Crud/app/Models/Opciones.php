<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opciones extends Model
{
    use HasFactory;

    protected $table = 'opciones';
    protected $primaryKey = 'idOpcion';

    protected $fillable = [
        'Pregunta_idPregunta',
        'texto',
        'valor' // Este campo puede ser null
    ];

    // Relación: Una opción pertenece a una pregunta
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'Pregunta_idPregunta', 'idPregunta');
    }
}
