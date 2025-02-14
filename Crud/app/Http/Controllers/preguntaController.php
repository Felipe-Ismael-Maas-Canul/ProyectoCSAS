<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Opciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PreguntaController extends Controller
{
    /**
     * Mostrar todas las preguntas.
     */
    public function indexPregunta()
    {
        // Cargar todas las preguntas con sus opciones relacionadas
        $preguntas = Pregunta::with('opciones')->get();
        return response()->json([
            'preguntas' => $preguntas,
            'status' => 200
        ], 200);
    }

    /**
     * Crear una nueva pregunta.
     */
    public function store(Request $request)
    {
        // Verificar si el usuario es administrador
        if (!Auth::check() || Auth::user()->tipo !== 'Administrador') {
            return response()->json([
                'message' => 'Acceso denegado. Solo administradores pueden crear preguntas.',
                'status' => 403
            ], 403);
        }

        // Validación de datos
        $validator = Validator::make($request->all(), [
            'texto' => 'required|string|max:500',
            'tipo_pregunta' => 'required|in:likert,opcion_multiple,si_no,abierta',
            'Encuesta_idEncuesta' => 'required|exists:encuestas,idEncuesta',
            'Categoria_idCategoria' => 'nullable|exists:categorias,idCategoria',
            'opciones' => 'nullable|array', // Opciones pueden ser null si no se envían
            'opciones.*.texto' => 'required|string|max:255', // Validar texto de cada opción
            'opciones.*.valor' => 'nullable|integer' // Valor de la opción puede ser null
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Crear la pregunta
        $pregunta = Pregunta::create([
            'texto' => $request->texto,
            'tipo_pregunta' => $request->tipo_pregunta,
            'Encuesta_idEncuesta' => $request->Encuesta_idEncuesta,
            'Categoria_idCategoria' => $request->Categoria_idCategoria
        ]);

        // Si el tipo de pregunta es Likert o opción múltiple, agregar opciones
        if (isset($request->opciones)) {
            foreach ($request->opciones as $opcion) {
                Opciones::create([
                    'Pregunta_idPregunta' => $pregunta->idPregunta,
                    'texto' => $opcion['texto'],
                    'valor' => $opcion['valor'] ?? null // Asignar null si no se proporciona un valor
                ]);
            }
        }

        return response()->json([
            'message' => 'Pregunta creada con éxito',
            'pregunta' => $pregunta->load('opciones'), // Cargar opciones relacionadas para devolverlas en la respuesta
            'status' => 201
        ], 201);
    }
}
