<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Generacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneracionController extends Controller
{
    public function indexGeneraciones()
    {
        $generaciones = Generacion::all();

        return response()->json([
            'generaciones' => $generaciones,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date|unique:generaciones,fecha',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $generacion = Generacion::create([
            'fecha' => $request->fecha,
        ]);

        return response()->json([
            'message' => 'Generación creada exitosamente',
            'generacion' => $generacion,
            'status' => 201
        ], 201);
    }

    public function show($idGeneracion)
    {
        $generacion = Generacion::find($idGeneracion);

        if (!$generacion) {
            return response()->json([
                'message' => 'Generación no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'generacion' => $generacion,
            'status' => 200
        ], 200);
    }

    public function destroy($idGeneracion)
    {
        $generacion = Generacion::find($idGeneracion);

        if (!$generacion) {
            return response()->json([
                'message' => 'Generación no encontrada',
                'status' => 404
            ], 404);
        }

        $generacion->delete();

        return response()->json([
            'message' => 'Generación eliminada',
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $idGeneracion)
    {
        $generacion = Generacion::find($idGeneracion);

        if (!$generacion) {
            return response()->json([
                'message' => 'Generación no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date|unique:generaciones,fecha,' . $idGeneracion . ',idGeneracion',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $generacion->fecha = $request->fecha;
        $generacion->save();

        return response()->json([
            'message' => 'Generación actualizada',
            'generacion' => $generacion,
            'status' => 200
        ], 200);
    }
}
