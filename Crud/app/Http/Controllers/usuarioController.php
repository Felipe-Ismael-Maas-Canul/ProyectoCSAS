<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Alumno;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Obtener todos los usuarios.
     */
    public function indexUsuario()
    {
        $usuarios = Usuario::all();

        return response()->json([
            'usuarios' => $usuarios,
            'status' => 200
        ], 200);
    }

    /**
     * Crear un nuevo usuario y asociarlo con Alumno o Administrador.
     */
    public function store(Request $request)
    {
        $rules = [
            'tipo' => 'required|in:Alumno,Administrador',
            'nombres' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo' => 'required|email|unique:usuario,correo',
            'password' => 'required|string|min:6',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'edad' => 'required|integer|min:1|max:100',
        ];

        // Validación específica según el tipo de usuario
        if ($request->input('tipo') === 'Alumno') {
            $rules['matricula'] = 'required|string|min:4|max:10|unique:usuario,matricula';
            $rules['Institucion_idInstitucion'] = 'required|integer|exists:institucion,idInstitucion';
            $rules['Carreras_idCarrera'] = 'required|integer|exists:carrera,idCarrera';
            $rules['grupo'] = 'required|string|max:10';
            $rules['semestre'] = 'required|integer|min:1|max:8';
        } elseif ($request->input('tipo') === 'Administrador') {
            $rules['id_admin'] = 'required|string|min:4|max:10|unique:usuario,id_admin';
            $rules['Institucion_idInstitucion'] = 'required|integer|exists:institucion,idInstitucion';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Crear usuario en la tabla usuario
        $user = Usuario::create([
            'id_admin' => $request->input('tipo') === 'Administrador' ? $request->input('id_admin') : null,
            'matricula' => $request->input('tipo') === 'Alumno' ? $request->input('matricula') : null,
            'nombres' => $request->input('nombres'),
            'primer_apellido' => $request->input('primer_apellido'),
            'segundo_apellido' => $request->input('segundo_apellido'),
            'correo' => $request->input('correo'),
            'password' => $request->input('password'), // Quitamos el Hash::make porque el mutador lo hará
            'tipo' => $request->input('tipo'),
            'genero' => $request->input('genero'),
            'edad' => $request->input('edad'),
        ]);

        // Si el usuario es un Alumno, crear registro en la tabla alumno
        if ($request->input('tipo') === 'Alumno') {
            Alumno::create([
                'idUsuario' => $user->idUsuario, // Relación con usuario
                'matricula' => $request->input('matricula'),
                'Institucion_idInstitucion' => $request->input('Institucion_idInstitucion'),
                'Carreras_idCarrera' => $request->input('Carreras_idCarrera'),
                'semestre' => $request->input('semestre'),
                'grupo' => $request->input('grupo'),
            ]);
        }

        // Si el usuario es un Administrador, crear registro en la tabla administrador
        if ($request->input('tipo') === 'Administrador') {
            Administrador::create([
                'idAdministrador' => $user->idUsuario,
                'id_admin' => $request->input('id_admin'),
                'nombres' => $request->input('nombres'),
                'Institucion_idInstitucion' => $request->input('Institucion_idInstitucion'),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado correctamente.',
            'data' => $user
        ], 201);
    }

    /**
     * Mostrar un usuario por ID.
     */
    public function show($idUsuario)
    {
        $usuario = Usuario::find($idUsuario);

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'usuario' => $usuario,
            'status' => 200
        ], 200);
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy($idUsuario)
    {
        $usuario = Usuario::find($idUsuario);

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        $usuario->delete();

        return response()->json([
            'message' => 'Usuario eliminado',
            'status' => 200
        ], 200);
    }

    /**
     * Actualizar un usuario.
     */
    public function update(Request $request, $idUsuario)
    {
        $usuario = Usuario::find($idUsuario);

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombres' => 'sometimes|required|string|max:255',
            'primer_apellido' => 'sometimes|required|string|max:255',
            'segundo_apellido' => 'sometimes|required|string|max:255',
            'correo' => 'sometimes|required|email|unique:usuario,correo,' . $idUsuario . ',idUsuario',
            'password' => 'sometimes|required|string|min:6',
            'genero' => 'sometimes|required|string',
            'edad' => 'sometimes|required|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $usuario->update($request->only([
            'nombres', 'primer_apellido', 'segundo_apellido', 'correo', 'genero', 'edad'
        ]));

        if ($request->filled('password')) {
            $usuario->password = $request->input('password'); // El mutador encriptará automáticamente
            $usuario->save();
        }

        return response()->json([
            'message' => 'Usuario actualizado',
            'usuario' => $usuario,
            'status' => 200
        ], 200);
    }
}
