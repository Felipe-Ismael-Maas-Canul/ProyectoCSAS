<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Opciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OpcionesController extends Controller
{
    public function indexOpciones()
    {
        $opciones = Opciones::all();

        $data = [
            'opciones' => $opciones,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idOpciones' => 'required',
            'texto' => 'required',
            'valor' => 'required|numeric',
            'pregunta_idPregunta' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $opciones = Opciones::create([
            'idOpciones' => $request->idOpciones,
            'texto' => $request->texto,
            'valor' => $request->valor,
            'pregunta_idPregunta' => $request->pregunta_idPregunta
        ]);

        if (!$opciones) {
            $data = [
                'message' => 'Error al crear la opción',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $opciones,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($idOpciones)
    {
        $opcion = Opciones::where('idOpciones', $idOpciones)->first();

        if (!$opcion) {
            $data = [
                'message' => 'Opción no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'opcion' => $opcion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($idOpciones)
    {
        $opcion = Opciones::where('idOpciones', $idOpciones)->first();

        if (!$opcion) {
            $data = [
                'message' => 'Opción no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $opcion->delete();

        $data = [
            'message' => 'Opción eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $idOpciones)
    {
        $opcion = Opciones::where('idOpciones', $idOpciones)->first();

        if (!$opcion) {
            $data = [
                'message' => 'Opción no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'idOpciones' => 'required',
            'texto' => 'required',
            'valor' => 'required|numeric',
            'pregunta_idPregunta' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $opcion->idOpciones = $request->idOpciones;
        $opcion->texto = $request->texto;
        $opcion->valor = $request->valor;
        $opcion->pregunta_idPregunta = $request->pregunta_idPregunta;

        $opcion->save();

        $data = [
            'message' => 'Opción actualizada',
            'opcion' => $opcion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
