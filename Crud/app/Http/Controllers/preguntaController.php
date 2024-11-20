<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreguntaController extends Controller
{
    public function indexPregunta()
    {
        $preguntas = Pregunta::all();

        $data = [
            'preguntas' => $preguntas,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idPregunta' => 'required',
            'texto' => 'required',
            'variable_idVariable' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $pregunta = Pregunta::create([
            'idPregunta' => $request->idPregunta,
            'texto' => $request->texto,
            'variable_idVariable' => $request->variable_idVariable
        ]);

        if (!$pregunta) {
            $data = [
                'message' => 'Error al crear la pregunta',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $pregunta,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($idPregunta)
    {
        $pregunta = Pregunta::where('idPregunta', $idPregunta)->first();

        if (!$pregunta) {
            $data = [
                'message' => 'Pregunta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'pregunta' => $pregunta,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($idPregunta)
    {
        $pregunta = Pregunta::where('idPregunta', $idPregunta)->first();

        if (!$pregunta) {
            $data = [
                'message' => 'Pregunta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $pregunta->delete();

        $data = [
            'message' => 'Pregunta eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $idPregunta)
    {
        $pregunta = Pregunta::where('idPregunta', $idPregunta)->first();

        if (!$pregunta) {
            $data = [
                'message' => 'Pregunta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'idPregunta' => 'required',
            'texto' => 'required',
            'variable_idVariable' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $pregunta->idPregunta = $request->idPregunta;
        $pregunta->texto = $request->texto;
        $pregunta->variable_idVariable = $request->variable_idVariable;

        $pregunta->save();

        $data = [
            'message' => 'Pregunta actualizada',
            'pregunta' => $pregunta,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
