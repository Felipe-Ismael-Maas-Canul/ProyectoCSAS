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

        $data = [
            'generaciones' => $generaciones,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idGeneracion' => 'required',
            'nombre' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $generacion = Generacion::create([
            'idGeneracion' => $request->idGeneracion,
            'nombre' => $request->nombre
        ]);

        if (!$generacion) {
            $data = [
                'message' => 'Error al crear la generación',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $generacion,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($idGeneracion)
    {
        $generacion = Generacion::where('idGeneracion', $idGeneracion)->first();

        if (!$generacion) {
            $data = [
                'message' => 'Generación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'generacion' => $generacion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($idGeneracion)
    {
        $generacion = Generacion::where('idGeneracion', $idGeneracion)->first();

        if (!$generacion) {
            $data = [
                'message' => 'Generación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $generacion->delete();

        $data = [
            'message' => 'Generación eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $idGeneracion)
    {
        $generacion = Generacion::where('idGeneracion', $idGeneracion)->first();

        if (!$generacion) {
            $data = [
                'message' => 'Generación no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'idGeneracion' => 'required',
            'nombre' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $generacion->idGeneracion = $request->idGeneracion;
        $generacion->nombre = $request->nombre;

        $generacion->save();

        $data = [
            'message' => 'Generación actualizada',
            'generacion' => $generacion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
