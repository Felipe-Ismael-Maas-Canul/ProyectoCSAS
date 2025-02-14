<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AlumnoController extends Controller
{
    // Obtener todos los alumnos con su usuario relacionado
    public function indexAlumno()
    {
        $alumnos = Alumno::with('usuario')->get();

        return response()->json([
            'alumnos' => $alumnos,
            'status' => 200,
        ]);
    }

    // Registrar un nuevo alumno
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matricula' => 'required|string|max:10|unique:alumno,matricula',
            'nombres' => 'required|string|max:45',
            'primer_apellido' => 'required|string|max:45',
            'segundo_apellido' => 'nullable|string|max:45',
            'correo' => 'required|email|unique:usuario,correo',
            'password' => 'required|string|min:6',
            'Institucion_idInstitucion' => 'required|exists:institucion,idInstitucion',
            'Carreras_idCarrera' => 'required|exists:carrera,idCarrera',
            'semestre' => 'required|integer|min:1|max:8',
            'grupo' => 'required|string|max:5',
            'genero' => 'required|string|max:10',
            'edad' => 'required|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos.',
                'errors' => $validator->errors(),
                'status' => 422,
            ]);
        }

        // Crear usuario
        $usuario = Usuario::create([
            'idUsuario' => $request->matricula, // Usa la matrícula como ID
            'nombres' => $request->nombres,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'tipo' => 'Alumno',
            'genero' => $request->genero,
            'edad' => $request->edad,
        ]);

        // Crear alumno vinculado al usuario
        $alumno = Alumno::create([
            'idUsuario' => $usuario->idUsuario,
            'matricula' => $request->matricula,
            'Institucion_idInstitucion' => $request->Institucion_idInstitucion,
            'Carreras_idCarrera' => $request->Carreras_idCarrera,
            'semestre' => $request->semestre,
            'grupo' => $request->grupo,
        ]);

        return response()->json([
            'message' => 'Alumno creado exitosamente.',
            'alumno' => $alumno,
            'usuario' => $usuario,
            'status' => 201,
        ]);
    }

    // Actualizar alumno y usuario
    public function update(Request $request, $idUsuario)
    {
        $alumno = Alumno::findOrFail($idUsuario);
        $usuario = Usuario::findOrFail($idUsuario);

        $validator = Validator::make($request->all(), [
            'nombres' => 'sometimes|string|max:45',
            'primer_apellido' => 'sometimes|string|max:45',
            'segundo_apellido' => 'nullable|string|max:45',
            'correo' => 'sometimes|email|unique:usuario,correo,' . $usuario->idUsuario,
            'password' => 'sometimes|string|min:6',
            'Institucion_idInstitucion' => 'sometimes|exists:institucion,idInstitucion',
            'Carreras_idCarrera' => 'sometimes|exists:carrera,idCarrera',
            'semestre' => 'sometimes|integer|min:1|max:8',
            'grupo' => 'sometimes|string|max:5',
            'genero' => 'sometimes|string|max:10',
            'edad' => 'sometimes|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos.',
                'errors' => $validator->errors(),
                'status' => 422,
            ]);
        }

        // Actualizar usuario
        $usuario->update([
            'nombres' => $request->nombres ?? $usuario->nombres,
            'primer_apellido' => $request->primer_apellido ?? $usuario->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido ?? $usuario->segundo_apellido,
            'correo' => $request->correo ?? $usuario->correo,
            'password' => $request->filled('password') ? Hash::make($request->password) : $usuario->password,
            'genero' => $request->genero ?? $usuario->genero,
            'edad' => $request->edad ?? $usuario->edad,
        ]);

        // Actualizar alumno
        $alumno->update([
            'Institucion_idInstitucion' => $request->Institucion_idInstitucion ?? $alumno->Institucion_idInstitucion,
            'Carreras_idCarrera' => $request->Carreras_idCarrera ?? $alumno->Carreras_idCarrera,
            'semestre' => $request->semestre ?? $alumno->semestre,
            'grupo' => $request->grupo ?? $alumno->grupo,
        ]);

        return response()->json([
            'message' => 'Alumno actualizado exitosamente.',
            'alumno' => $alumno,
            'usuario' => $usuario,
            'status' => 200,
        ]);
    }
}
