<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Usuario;
use App\Models\Carrera;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    /**
     * Obtener todos los administradores con su usuario relacionado.
     */
    public function indexAdministrador()
    {
        $administradores = Administrador::with('usuario')->get();

        return response()->json([
            'administradores' => $administradores,
            'status' => 200
        ], 200);
    }

    /**
     * Registrar un nuevo administrador y su usuario.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idAdministrador' => 'required|integer|unique:usuario,idUsuario|unique:administrador,idAdministrador',
            'id_admin' => 'required|string|min:4|max:10|unique:administrador,id_admin',
            'nombres' => 'required|string|max:45',
            'correo' => 'required|email|unique:usuario,correo',
            'password' => 'required|string|min:6',
            'Institucion_idInstitucion' => 'required|exists:institucion,idInstitucion',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos.',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        // Crear usuario
        $usuario = Usuario::create([
            'idUsuario' => $request->idAdministrador,
            'nombres' => $request->nombres,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'tipo' => 'Administrador'
        ]);

        // Crear administrador vinculado al usuario
        $administrador = Administrador::create([
            'idAdministrador' => $request->idAdministrador,
            'id_admin' => $request->id_admin, // Campo único del administrador
            'nombres' => $request->nombres,
            'Institucion_idInstitucion' => $request->Institucion_idInstitucion
        ]);

        return response()->json([
            'message' => 'Administrador creado exitosamente.',
            'administrador' => $administrador,
            'usuario' => $usuario,
            'status' => 201
        ], 201);
    }

    /**
     * Obtener un administrador por su ID con su usuario.
     */
    public function show($idAdministrador)
    {
        $administrador = Administrador::with('usuario')->where('idAdministrador', $idAdministrador)->firstOrFail();

        return response()->json([
            'administrador' => $administrador,
            'status' => 200
        ], 200);
    }

    /**
     * Eliminar un administrador (sin eliminar el usuario).
     */
    public function destroy($idAdministrador)
    {
        $administrador = Administrador::where('idAdministrador', $idAdministrador)->firstOrFail();
        $administrador->delete();

        return response()->json([
            'message' => 'Administrador eliminado exitosamente.',
            'status' => 200
        ], 200);
    }

    /**
     * Actualizar un administrador y su usuario.
     */
    public function update(Request $request, $idAdministrador)
    {
        $administrador = Administrador::where('idAdministrador', $idAdministrador)->firstOrFail();
        $usuario = Usuario::where('idUsuario', $idAdministrador)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'nombres' => 'sometimes|string|max:45',
            'correo' => 'sometimes|email|unique:usuario,correo,' . $usuario->idUsuario . ',idUsuario',
            'password' => 'sometimes|string|min:6',
            'id_admin' => 'sometimes|string|min:4|max:10|unique:administrador,id_admin,' . $administrador->idAdministrador . ',idAdministrador',
            'Institucion_idInstitucion' => 'sometimes|exists:institucion,idInstitucion',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos.',
                'errors' => $validator->errors(),
                'status' => 422
            ], 422);
        }

        // Actualizar usuario relacionado
        $usuario->update([
            'nombres' => $request->nombres ?? $usuario->nombres,
            'correo' => $request->correo ?? $usuario->correo,
            'password' => $request->filled('password') ? Hash::make($request->password) : $usuario->password
        ]);

        // Actualizar administrador
        $administrador->update([
            'id_admin' => $request->id_admin ?? $administrador->id_admin,
            'Institucion_idInstitucion' => $request->Institucion_idInstitucion ?? $administrador->Institucion_idInstitucion
        ]);

        return response()->json([
            'message' => 'Administrador actualizado exitosamente.',
            'administrador' => $administrador,
            'usuario' => $usuario,
            'status' => 200
        ], 200);
    }

    /**
     * Obtener las carreras asociadas a un administrador.
     */
    public function obtenerCarreras($idAdministrador)
    {
        $administrador = Administrador::with('carreras')->findOrFail($idAdministrador);

        return response()->json([
            'administrador' => $administrador,
            'carreras' => $administrador->carreras,
            'status' => 200
        ], 200);
    }

    /**
     * Obtener los grupos asociados a un administrador.
     */
    public function obtenerGrupos($idAdministrador)
    {
        $administrador = Administrador::with('grupos')->findOrFail($idAdministrador);

        return response()->json([
            'administrador' => $administrador,
            'grupos' => $administrador->grupos,
            'status' => 200
        ], 200);
    }

    /**
     * Asignar carreras a un administrador.
     */
    public function asociarCarreras(Request $request, $idAdministrador)
    {
        $validator = Validator::make($request->all(), [
            'carreras' => 'required|array',
            'carreras.*' => 'exists:carrera,idCarrera',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos.',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $administrador = Administrador::findOrFail($idAdministrador);
        $administrador->carreras()->sync($request->carreras);

        return response()->json([
            'message' => 'Carreras asociadas correctamente.',
            'carreras' => $administrador->carreras,
            'status' => 200
        ], 200);
    }

    /**
     * Asignar grupos a un administrador.
     */
    public function asociarGrupos(Request $request, $idAdministrador)
    {
        $validator = Validator::make($request->all(), [
            'grupos' => 'required|array',
            'grupos.*' => 'exists:grupo,idGrupo',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos.',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $administrador = Administrador::findOrFail($idAdministrador);
        $administrador->grupos()->sync($request->grupos);

        return response()->json([
            'message' => 'Grupos asociados correctamente.',
            'grupos' => $administrador->grupos,
            'status' => 200
        ], 200);
    }
}
