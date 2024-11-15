<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\usuarioController;


Route::get('/Usuarios', [usuarioController::class, 'index']);

Route::get('/Usuarios/{idUsuario}', [usuarioController::class, 'show']);

Route::post('/Usuarios', [usuarioController::class, 'store']);


Route::put('/Usuarios/{idUsuario}', [usuarioController::class, 'update']);

Route::delete('/Usuarios/{idUsuario}', [usuarioController::class, 'destroy']);