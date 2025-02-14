<?php

namespace App\Http\Controllers;

use App\Models\Encuestas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EncuestasController extends Controller
{
    /**
     * Muestra todas las encuestas.
     */
    public function indexEncuestas()
    {
        $encuestas = Encuestas::with('categorias')->get(); // Cargar relación con categorías

        return response()->json([
            'encuestas' => $encuestas,
            'status' => 200
        ], 200);
    }

    /**
     * Almacena una nueva encuesta.
    */
    public function store(Request $request)
    {
        // Verificar si el usuario es administrador
        if (!Auth::check() || Auth::user()->tipo !== 'Administrador') {
            return response()->json([
                'message' => 'Acceso denegado. Solo administradores pueden crear encuestas.',
                'status' => 403
            ], 403);
        }

        // Validación de datos
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'matriculaAlumno' => 'nullable|array', // Lista de alumnos opcional
            'matriculaAlumno.*' => 'exists:alumno,matricula', // Validar que existan en la tabla alumnos
            'carrera' => 'required|string',
            'generaciones_idGeneracion' => 'required|integer|exists:generaciones,idGeneracion',
            'categorias' => 'nullable|array', // Lista de categorías
            'categorias.*' => 'exists:categorias,idCategoria' // Validar que las categorías existan
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Crear encuesta
        $encuesta = Encuestas::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'carrera' => $request->carrera,
            'generaciones_idGeneracion' => $request->generaciones_idGeneracion,
        ]);

        // Asignar categorías si se enviaron
        if (!empty($request->categorias)) {
            $encuesta->categorias()->sync($request->categorias);
        }

        // Asignar alumnos si se enviaron
        if (!empty($request->matriculaAlumno)) {
            $alumnos = DB::table('alumno')
                ->select('matricula', 'grupo', 'Carreras_idCarrera') // Sin generaciones_idGeneracion
                ->whereIn('matricula', $request->matriculaAlumno)
                ->get();

            foreach ($alumnos as $alumno) {
                DB::table('encuesta_alumno')->insert([
                    'idEncuesta' => $encuesta->idEncuesta,
                    'matriculaAlumno' => $alumno->matricula,
                    'grupo' => $alumno->grupo,
                    'Carreras_idCarrera' => $alumno->Carreras_idCarrera,
                    'generaciones_idGeneracion' => $request->generaciones_idGeneracion, // Usamos el dato del request
                    'fecha_respuesta' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        return response()->json([
            'message' => 'Encuesta creada con éxito',
            'encuesta' => $encuesta->load('categorias', 'alumnos'), // Cargar relaciones con categorías y alumnos
            'status' => 201
        ], 201);
    }


    /**
     * Muestra una encuesta específica.
     */
    public function show($idEncuesta)
    {
        $encuesta = Encuestas::with('categorias')->findOrFail($idEncuesta); // Cargar relación con categorías

        return response()->json([
            'encuesta' => $encuesta,
            'status' => 200
        ], 200);
    }

    /**
     * Elimina una encuesta.
     */
    public function destroy($idEncuesta)
    {
        $encuesta = Encuestas::findOrFail($idEncuesta);
        $encuesta->delete();

        return response()->json([
            'message' => 'Encuesta eliminada',
            'status' => 200
        ], 200);
    }

    /**
     * Actualiza una encuesta.
     */
    public function update(Request $request, $idEncuesta)
    {
        $encuesta = Encuestas::findOrFail($idEncuesta);

        $validator = Validator::make($request->all(), [
            'titulo' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'sometimes|required|date',
            'fecha_fin' => 'sometimes|required|date|after_or_equal:fecha_inicio',
            'categorias' => 'nullable|array',
            'categorias.*' => 'exists:categorias,idCategoria',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $encuesta->update($request->only(['titulo', 'descripcion', 'fecha_inicio', 'fecha_fin']));

        // Actualizar las categorías asociadas
        if ($request->has('categorias')) {
            $encuesta->categorias()->sync($request->categorias);
        }

        return response()->json([
            'message' => 'Encuesta actualizada',
            'encuesta' => $encuesta->load('categorias'), // Cargar relación con categorías
            'status' => 200
        ], 200);
    }
}
