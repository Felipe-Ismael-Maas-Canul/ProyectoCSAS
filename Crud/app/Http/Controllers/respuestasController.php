<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Respuestas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RespuestasController extends Controller
{
    public function indexRespuestas()
    {
        $respuestas = Respuestas::all();

        $data = [
            'respuestas' => $respuestas,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idRespuestas' => 'required',
            'opciones_idOpciones' => 'required',
            'opciones_pregunta_idPregunta' => 'required',
            'opciones_pregunta_variable_idVariable' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $respuesta = Respuestas::create([
            'idRespuestas' => $request->idRespuestas,
            'opciones_idOpciones' => $request->opciones_idOpciones,
            'opciones_pregunta_idPregunta' => $request->opciones_pregunta_idPregunta,
            'opciones_pregunta_variable_idVariable' => $request->opciones_pregunta_variable_idVariable
        ]);

        if (!$respuesta) {
            $data = [
                'message' => 'Error al crear la respuesta',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $respuesta,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($idRespuestas)
    {
        $respuesta = Respuestas::where('idRespuestas', $idRespuestas)->first();

        if (!$respuesta) {
            $data = [
                'message' => 'Respuesta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'respuesta' => $respuesta,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($idRespuestas)
    {
        $respuesta = Respuestas::where('idRespuestas', $idRespuestas)->first();

        if (!$respuesta) {
            $data = [
                'message' => 'Respuesta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $respuesta->delete();

        $data = [
            'message' => 'Respuesta eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $idRespuestas)
    {
        $respuesta = Respuestas::where('idRespuestas', $idRespuestas)->first();

        if (!$respuesta) {
            $data = [
                'message' => 'Respuesta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'idRespuestas' => 'required',
            'opciones_idOpciones' => 'required',
            'opciones_pregunta_idPregunta' => 'required',
            'opciones_pregunta_variable_idVariable' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $respuesta->idRespuestas = $request->idRespuestas;
        $respuesta->opciones_idOpciones = $request->opciones_idOpciones;
        $respuesta->opciones_pregunta_idPregunta = $request->opciones_pregunta_idPregunta;
        $respuesta->opciones_pregunta_variable_idVariable = $request->opciones_pregunta_variable_idVariable;

        $respuesta->save();

        $data = [
            'message' => 'Respuesta actualizada',
            'respuesta' => $respuesta,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
