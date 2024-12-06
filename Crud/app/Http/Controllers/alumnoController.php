<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlumnoController extends Controller
{
    /**
     * Obtener todos los alumnos.
     */
    public function indexAlumno()
    {
        $alumnos = Alumno::with('usuario')->get(); // Incluir datos del usuario relacionado

        return response()->json([
            'alumnos' => $alumnos,
            'status' => 200,
        ], 200);
    }

    /**
     * Registrar un nuevo alumno.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario_id' => 'required|exists:usuario,idUsuario', // Relacionar con usuario
            'nombres' => 'required|string|max:45',
            'primer_apellido' => 'required|string|max:45',
            'segundo_apellido' => 'nullable|string|max:45',
            'Institucion_idInstitucion' => 'required|integer',
            'Carreras_idCarrera' => 'required|integer',
            'Generaciones_idGeneracion' => 'required|integer',
            'Grupo_idGrupo' => 'required|integer',
            'genero' => 'required|string|max:10',
            'edad' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos.',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $alumno = Alumno::create($request->all());

        return response()->json([
            'message' => 'Alumno creado exitosamente.',
            'alumno' => $alumno,
            'status' => 201,
        ], 201);
    }

    /**
     * Obtener un alumno por su matrícula.
     */
    public function show($matricula)
    {
        $alumno = Alumno::with('usuario')->where('matricula', $matricula)->first();

        if (!$alumno) {
            return response()->json([
                'message' => 'Alumno no encontrado.',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'alumno' => $alumno,
            'status' => 200,
        ], 200);
    }

    /**
     * Eliminar un alumno.
     */
    public function destroy($matricula)
    {
        $alumno = Alumno::where('matricula', $matricula)->first();

        if (!$alumno) {
            return response()->json([
                'message' => 'Alumno no encontrado.',
                'status' => 404,
            ], 404);
        }

        $alumno->delete();

        return response()->json([
            'message' => 'Alumno eliminado exitosamente.',
            'status' => 200,
        ], 200);
    }

    /**
     * Actualizar un alumno.
     */
    public function update(Request $request, $matricula)
    {
        $alumno = Alumno::where('matricula', $matricula)->first();

        if (!$alumno) {
            return response()->json([
                'message' => 'Alumno no encontrado.',
                'status' => 404,
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:45',
            'primer_apellido' => 'required|string|max:45',
            'segundo_apellido' => 'nullable|string|max:45',
            'Institucion_idInstitucion' => 'required|integer',
            'Carreras_idCarrera' => 'required|integer',
            'Generaciones_idGeneracion' => 'required|integer',
            'Grupo_idGrupo' => 'required|integer',
            'genero' => 'required|string|max:10',
            'edad' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos.',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $alumno->update($request->all());

        return response()->json([
            'message' => 'Alumno actualizado exitosamente.',
            'alumno' => $alumno,
            'status' => 200,
        ], 200);
    }
}
