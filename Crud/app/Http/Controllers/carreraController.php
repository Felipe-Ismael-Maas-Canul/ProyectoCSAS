<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarreraController extends Controller
{
    public function indexCarrera()
    {
        $carreras = Carrera::with('institucion')->get();

        return response()->json([
            'carreras' => $carreras,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        // Validar el request para múltiples carreras
        $validator = Validator::make($request->all(), [
            'institucion_idInstitucion' => 'required|exists:institucion,idInstitucion',
            'carreras' => 'required|array|min:1',
            'carreras.*.nombre' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Insertar cada carrera en la base de datos
        $carrerasCreadas = [];
        foreach ($request->carreras as $carreraData) {
            $carrera = Carrera::create([
                'nombre' => $carreraData['nombre'],
                'institucion_idInstitucion' => $request->institucion_idInstitucion
            ]);
            $carrerasCreadas[] = $carrera;
        }

        return response()->json([
            'message' => 'Carreras creadas exitosamente',
            'carreras' => $carrerasCreadas,
            'status' => 201
        ], 201);
    }

    public function show($idCarrera)
    {
        $carrera = Carrera::with('institucion')->find($idCarrera);

        if (!$carrera) {
            return response()->json([
                'message' => 'Carrera no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'carrera' => $carrera,
            'status' => 200
        ], 200);
    }

    public function destroy($idCarrera)
    {
        $carrera = Carrera::find($idCarrera);

        if (!$carrera) {
            return response()->json([
                'message' => 'Carrera no encontrada',
                'status' => 404
            ], 404);
        }

        $carrera->delete();

        return response()->json([
            'message' => 'Carrera eliminada',
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $idCarrera)
    {
        $carrera = Carrera::find($idCarrera);
        if (!$carrera) {
            return response()->json([
                'message' => 'Carrera no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'institucion_idInstitucion' => 'required|exists:institucion,idInstitucion'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $carrera->update([
            'nombre' => $request->nombre,
            'institucion_idInstitucion' => $request->institucion_idInstitucion
        ]);

        return response()->json([
            'message' => 'Carrera actualizada',
            'carrera' => $carrera,
            'status' => 200
        ], 200);
    }
}
