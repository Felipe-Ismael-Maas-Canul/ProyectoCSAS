<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controlador Usuario
use App\Http\Controllers\usuarioController;

Route::get('/Usuarios', [usuarioController::class, 'indexUsuario']);

Route::get('/Usuarios/{idUsuario}', [usuarioController::class, 'show']);

Route::post('/Usuarios', [usuarioController::class, 'store']);

Route::put('/Usuarios/{idUsuario}', [usuarioController::class, 'update']);

Route::delete('/Usuarios/{idUsuario}', [usuarioController::class, 'destroy']);


//Controlador Alumno
use App\Http\Controllers\alumnoController;

Route::get('/Alumnos', [alumnoController::class, 'indexAlumno']);

Route::get('/Alumnos/{matricula}', [alumnoController::class, 'show']);

Route::post('/Alumnos', [alumnoController::class, 'store']);

Route::put('/Alumnos/{matricula}', [alumnoController::class, 'update']);

Route::delete('/Alumnos/{matricula}', [alumnoController::class, 'destroy']);;


// Controlador Administrador
use App\Http\Controllers\administradorController;

Route::get('/Administrador', [administradorController::class, 'indexAdministrador']);

Route::get('/Administrador/{idAdministrador}', [administradorController::class, 'show']);

Route::post('/Administrador', [administradorController::class, 'store']);

Route::put('/Administrador/{idAdministrador}', [administradorController::class, 'update']);

Route::delete('/Administrador/{idAdministrador}', [administradorController::class, 'destroy']);


// Controlador Carrera
use App\Http\Controllers\carreraController;

Route::get('/Carrera', [carreraController::class, 'indexCarrera']);

Route::get('/Carrera/{idCarrera}', [carreraController::class, 'show']);

Route::post('/Carrera', [carreraController::class, 'store']);

Route::put('/Carrera/{idCarrera}', [carreraController::class, 'update']);

Route::delete('/Carrera/{idCarrera}', [carreraController::class, 'destroy']);


// Controlador Categoria
use App\Http\Controllers\categoriaController;

Route::get('/Categoria', [categoriaController::class, 'indexCategoria']);

Route::get('/Categoria/{idCategoria}', [categoriaController::class, 'show']);

Route::post('/Categoria', [categoriaController::class, 'store']);

Route::put('/Categoria/{idCategoria}', [categoriaController::class, 'update']);

Route::delete('/Categoria/{idCategoria}', [categoriaController::class, 'destroy']);


// Controlador Encuestas
use App\Http\Controllers\encuestasController;

Route::get('/Encuestas', [encuestasController::class, 'indexEncuestas']);

Route::get('/Encuestas/{idEncuestas}', [encuestasController::class, 'show']);

Route::post('/Encuestas', [encuestasController::class, 'store']);

Route::put('/Encuestas/{idEncuestas}', [encuestasController::class, 'update']);

Route::delete('/Encuestas/{idEncuestas}', [encuestasController::class, 'destroy']);


// Controlador Generacion
use App\Http\Controllers\generacionController;

Route::get('/Generaciones', [generacionController::class, 'indexGeneraciones']);

Route::get('/Generaciones/{idGeneracion}', [generacionController::class, 'show']);

Route::post('/Generaciones', [generacionController::class, 'store']);

Route::put('/Generaciones/{idGeneracion}', [generacionController::class, 'update']);

Route::delete('/Generaciones/{idGeneracion}', [generacionController::class, 'destroy']);


// Controlador Grupo
use App\Http\Controllers\grupoController;

Route::get('/Grupos', [grupoController::class, 'indexGrupos']);

Route::get('/Grupos/{idGrupo}', [grupoController::class, 'show']);

Route::post('/Grupos', [grupoController::class, 'store']);

Route::put('/Grupos/{idGrupo}', [grupoController::class, 'update']);

Route::delete('/Grupos/{idGrupo}', [grupoController::class, 'destroy']);


// Controlador Institucion
use App\Http\Controllers\institucionController;

Route::get('/Instituciones', [institucionController::class, 'indexInstituciones']);

Route::get('/Instituciones/{idInstitucion}', [institucionController::class, 'show']);

Route::post('/Instituciones', [institucionController::class, 'store']);

Route::put('/Instituciones/{idInstitucion}', [institucionController::class, 'update']);

Route::delete('/Instituciones/{idInstitucion}', [institucionController::class, 'destroy']);


// Controlador Opciones
use App\Http\Controllers\opcionesController;

Route::get('/Opciones', [opcionesController::class, 'indexOpciones']);

Route::get('/Opciones/{idOpciones}', [opcionesController::class, 'show']);

Route::post('/Opciones', [opcionesController::class, 'store']);

Route::put('/Opciones/{idOpciones}', [opcionesController::class, 'update']);

Route::delete('/Opciones/{idOpciones}', [opcionesController::class, 'destroy']);


// Controlador Pregunta
use App\Http\Controllers\preguntaController;

Route::get('/Pregunta', [preguntaController::class, 'indexPregunta']);

Route::get('/Pregunta/{idPregunta}', [preguntaController::class, 'show']);

Route::post('/Pregunta', [preguntaController::class, 'store']);

Route::put('/Pregunta/{idPregunta}', [preguntaController::class, 'update']);

Route::delete('/Pregunta/{idPregunta}', [preguntaController::class, 'destroy']);


// Controlador Respuestas
use App\Http\Controllers\respuestasController;

Route::get('/Respuestas', [respuestasController::class, 'indexRespuestas']);

Route::get('/Respuestas/{idRespuestas}', [respuestasController::class, 'show']);

Route::post('/Respuestas', [respuestasController::class, 'store']);

Route::put('/Respuestas/{idRespuestas}', [respuestasController::class, 'update']);

Route::delete('/Respuestas/{idRespuestas}', [respuestasController::class, 'destroy']);


// Controlador Variable
use App\Http\Controllers\variableController;

Route::get('/Variable', [variableController::class, 'indexVariable']);

Route::get('/Variable/{idVariable}', [variableController::class, 'show']);

Route::post('/Variable', [variableController::class, 'store']);

Route::put('/Variable/{idVariable}', [variableController::class, 'update']);

Route::delete('/Variable/{idVariable}', [variableController::class, 'destroy']);
