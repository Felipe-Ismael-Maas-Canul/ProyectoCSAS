<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Respuestas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RespuestasController extends Controller
{
    /**
     * Muestra todas las respuestas.
     */
    public function indexRespuestas()
    {
        $respuestas = Respuestas::all();

        return response()->json([
            'respuestas' => $respuestas,
            'status' => 200
        ], 200);
    }

    /**
     * Crea una nueva respuesta.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'opciones_idOpciones' => 'required|integer|exists:opciones,idOpciones',
            'opciones_pregunta_idPregunta' => 'required|integer|exists:preguntas,idPregunta',
            'opciones_pregunta_variable_idVariable' => 'required|integer|exists:variables,idVariable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $respuesta = Respuestas::create([
            'opciones_idOpciones' => $request->opciones_idOpciones,
            'opciones_pregunta_idPregunta' => $request->opciones_pregunta_idPregunta,
            'opciones_pregunta_variable_idVariable' => $request->opciones_pregunta_variable_idVariable
        ]);

        return response()->json([
            'message' => 'Respuesta creada con éxito',
            'respuesta' => $respuesta,
            'status' => 201
        ], 201);
    }

    /**
     * Muestra una respuesta específica.
     */
    public function show($idRespuestas)
    {
        $respuesta = Respuestas::findOrFail($idRespuestas);

        return response()->json([
            'respuesta' => $respuesta,
            'status' => 200
        ], 200);
    }

    /**
     * Elimina una respuesta.
     */
    public function destroy($idRespuestas)
    {
        $respuesta = Respuestas::findOrFail($idRespuestas);
        $respuesta->delete();

        return response()->json([
            'message' => 'Respuesta eliminada',
            'status' => 200
        ], 200);
    }

    /**
     * Actualiza una respuesta.
     */
    public function update(Request $request, $idRespuestas)
    {
        $respuesta = Respuestas::findOrFail($idRespuestas);

        $validator = Validator::make($request->all(), [
            'opciones_idOpciones' => 'required|integer|exists:opciones,idOpciones',
            'opciones_pregunta_idPregunta' => 'required|integer|exists:preguntas,idPregunta',
            'opciones_pregunta_variable_idVariable' => 'required|integer|exists:variables,idVariable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $respuesta->update([
            'opciones_idOpciones' => $request->opciones_idOpciones,
            'opciones_pregunta_idPregunta' => $request->opciones_pregunta_idPregunta,
            'opciones_pregunta_variable_idVariable' => $request->opciones_pregunta_variable_idVariable
        ]);

        return response()->json([
            'message' => 'Respuesta actualizada',
            'respuesta' => $respuesta,
            'status' => 200
        ], 200);
    }
}
