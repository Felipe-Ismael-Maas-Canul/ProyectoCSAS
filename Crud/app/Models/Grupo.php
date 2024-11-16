<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model{

    use HasFactory;

    protected $table = 'grupo';

    protected $fillable =[
            'idGrupo',
            'nombre',
            'generaciones_idGeneracion',
            'idAdministrador'

    ];
    
}
