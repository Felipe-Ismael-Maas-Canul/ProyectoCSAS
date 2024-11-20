<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model{

    use HasFactory;

    protected $table = 'grupo';

    protected $primaryKey= 'idGrupo';

    protected $fillable =[
            'idGrupo',
            'nombre',
            'generaciones_idGeneracion',
            'idAdministrador'
        ];

        public function alumno()
        {
            return $this->belongsTo(Alumno::class, 'Alumno_Matricula', 'matricula');
        }
    
        public function respuesta()
        {
            return $this->belongsTo(Respuestas::class, 'Respuesta_idRespuesta', 'idRespuesta');
        }
    }
