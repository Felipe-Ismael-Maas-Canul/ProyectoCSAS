<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Opciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OpcionesController extends Controller
{
    /**
     * Muestra todas las opciones.
     */
    public function indexOpciones()
    {
        $opciones = Opciones::all();

        return response()->json([
            'opciones' => $opciones,
            'status' => 200
        ], 200);
    }

    /**
     * Crea una nueva opción.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'texto' => 'required|string',
            'valor' => 'required|numeric',
            'pregunta_idPregunta' => 'required|integer|exists:preguntas,idPregunta'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $opcion = Opciones::create([
            'texto' => $request->texto,
            'valor' => $request->valor,
            'pregunta_idPregunta' => $request->pregunta_idPregunta
        ]);

        return response()->json([
            'message' => 'Opción creada con éxito',
            'opcion' => $opcion,
            'status' => 201
        ], 201);
    }

    /**
     * Muestra una opción específica.
     */
    public function show($idOpciones)
    {
        $opcion = Opciones::findOrFail($idOpciones);

        return response()->json([
            'opcion' => $opcion,
            'status' => 200
        ], 200);
    }

    /**
     * Elimina una opción.
     */
    public function destroy($idOpciones)
    {
        $opcion = Opciones::findOrFail($idOpciones);
        $opcion->delete();

        return response()->json([
            'message' => 'Opción eliminada',
            'status' => 200
        ], 200);
    }

    /**
     * Actualiza una opción.
     */
    public function update(Request $request, $idOpciones)
    {
        $opcion = Opciones::findOrFail($idOpciones);

        $validator = Validator::make($request->all(), [
            'texto' => 'required|string',
            'valor' => 'required|numeric',
            'pregunta_idPregunta' => 'required|integer|exists:preguntas,idPregunta'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $opcion->update([
            'texto' => $request->texto,
            'valor' => $request->valor,
            'pregunta_idPregunta' => $request->pregunta_idPregunta
        ]);

        return response()->json([
            'message' => 'Opción actualizada',
            'opcion' => $opcion,
            'status' => 200
        ], 200);
    }
}
