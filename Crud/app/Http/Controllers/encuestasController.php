<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Encuestas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EncuestasController extends Controller{
    public function indexEncuestas()
    {
        $encuestas = Encuestas::all();

        $data = [
            'encuestas' => $encuestas,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idEncuestas' => 'required',
            'fecha' => 'required|date',
            'Alumno_Matricula' => 'required',
            'Respuesta_idRespuesta' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $encuesta = Encuestas::create([
            'idEncuestas' => $request->idEncuestas,
            'fecha' => $request->fecha,
            'Alumno_Matricula' => $request->Alumno_Matricula,
            'Respuesta_idRespuesta' => $request->Respuesta_idRespuesta
        ]);

        if (!$encuesta) {
            $data = [
                'message' => 'Error al crear la encuesta',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $encuesta,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($idEncuestas)
    {
        $encuesta = Encuestas::where('idEncuestas', $idEncuestas)->first();

        if (!$encuesta) {
            $data = [
                'message' => 'Encuesta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'encuesta' => $encuesta,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($idEncuestas)
    {
        $encuesta = Encuestas::where('idEncuestas', $idEncuestas)->first();

        if (!$encuesta) {
            $data = [
                'message' => 'Encuesta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $encuesta->delete();

        $data = [
            'message' => 'Encuesta eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $idEncuestas)
    {
        $encuesta = Encuestas::where('idEncuestas', $idEncuestas)->first();

        if (!$encuesta) {
            $data = [
                'message' => 'Encuesta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'idEncuestas' => 'required',
            'fecha' => 'required|date',
            'Alumno_Matricula' => 'required',
            'Respuesta_idRespuesta' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $encuesta->idEncuestas = $request->idEncuestas;
        $encuesta->fecha = $request->fecha;
        $encuesta->Alumno_Matricula = $request->Alumno_Matricula;
        $encuesta->Respuesta_idRespuesta = $request->Respuesta_idRespuesta;

        $encuesta->save();

        $data = [
            'message' => 'Encuesta actualizada',
            'encuesta' => $encuesta,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}

