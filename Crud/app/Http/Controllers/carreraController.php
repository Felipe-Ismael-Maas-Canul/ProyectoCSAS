<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\error;

class CarreraController extends Controller{
    public function indexCarrera()
    {
        $carreras = Carrera::all();

        $data = [
            'carreras' => $carreras,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idCarrera' => 'required',
            'nombre' => 'required',
            'institucion_idInstitucion' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $carrera = Carrera::create([
            'idCarrera' => $request->idCarrera,
            'nombre' => $request->nombre,
            'institucion_idInstitucion' => $request->institucion_idInstitucion
        ]);

        if (!$carrera) {
            $data = [
                'message' => 'Error al crear la carrera',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $carrera,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($idCarrera)
    {
        $carrera = Carrera::where('idCarrera', $idCarrera)->first();

        if (!$carrera) {
            $data = [
                'message' => 'Carrera no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'carrera' => $carrera,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($idCarrera)
    {
        $carrera = Carrera::where('idCarrera', $idCarrera)->first();

        if (!$carrera) {
            $data = [
                'message' => 'Carrera no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $carrera->delete();

        $data = [
            'message' => 'Carrera eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $idCarrera)
    {
        $carrera = Carrera::where('idCarrera', $idCarrera)->first();
        if (!$carrera) {
            $data = [
                'message' => 'Carrera no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'idCarrera' => 'required',
            'nombre' => 'required',
            'institucion_idInstitucion' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $carrera->idCarrera = $request->idCarrera;
        $carrera->nombre = $request->nombre;
        $carrera->institucion_idInstitucion = $request->institucion_idInstitucion;

        $carrera->save();

        $data = [
            'message' => 'Carrera actualizada',
            'carrera' => $carrera,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}

