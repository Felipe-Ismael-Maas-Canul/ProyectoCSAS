<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function indexUsuario()
    {
        $usuarios = Usuario::all();

        $data = [
            'usuarios' => $usuarios,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matricula' => 'required|integer|unique:usuario,matricula',
            'nombres' => 'required|string|max:45',
            'primer_apellido' => 'required|string|max:45',
            'segundo_apellido' => 'nullable|string|max:45',
            'correo' => 'required|email|unique:usuario,correo',
            'password' => 'required|string|min:8', // Validación de contraseña más segura
            'tipo' => 'required|in:Alumno,Administrador',
            'Alumno_Matricula' => 'nullable|integer',
            'Administrador_idAdministrador' => 'nullable|integer',
            'genero' => 'nullable|string|max:45',
            'edad' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 422
            ], 422);
        }

        $usuarios = Usuario::create($request->all());

        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'usuario' => $usuarios,
            'status' => 201
        ], 201);
    }

    public function show($idUsuario)
    {
        $usuarios = Usuario::find($idUsuario);

        if (!$usuarios) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'usuario' => $usuarios,
            'status' => 200
        ], 200);
    }

    public function destroy($idUsuario)
    {
        $usuarios = Usuario::find($idUsuario);

        if (!$usuarios) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        $usuarios->delete();

        return response()->json([
            'message' => 'Usuario eliminado exitosamente',
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $idUsuario)
    {
        $usuarios = Usuario::find($idUsuario);

        if (!$usuarios) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'matricula' => 'required|integer|unique:usuario,matricula,' . $idUsuario . ',idUsuario',
            'nombres' => 'required|string|max:45',
            'primer_apellido' => 'required|string|max:45',
            'segundo_apellido' => 'nullable|string|max:45',
            'correo' => 'required|email|unique:usuario,correo,' . $idUsuario . ',idUsuario',
            'password' => 'nullable|string|min:8', // Solo actualizar si se envía
            'tipo' => 'required|in:Alumno,Administrador',
            'Alumno_Matricula' => 'nullable|integer',
            'Administrador_idAdministrador' => 'nullable|integer',
            'genero' => 'nullable|string|max:45',
            'edad' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 422
            ], 422);
        }

        // Actualizar solo los campos necesarios
        $usuarios->update($request->all());

        return response()->json([
            'message' => 'Usuario actualizado exitosamente',
            'usuario' => $usuarios,
            'status' => 200
        ], 200);
    }
}
