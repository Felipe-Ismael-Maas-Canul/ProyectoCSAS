<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller
{
    // Obtener todos los grupos
    public function indexGrupos()
    {
        $grupos = Grupo::all();

        return response()->json([
            'grupos' => $grupos,
            'status' => 200
        ], 200);
    }

    // Crear un nuevo grupo
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|regex:/^[A-Z]$/i', // Solo una letra
            'semestre' => 'required|integer|min:1|max:8',   // Semestre entre 1 y 8
            'generaciones_idGeneracion' => 'nullable|exists:generaciones,idGeneracion', // Validar relación con generaciones
            'idAdministrador' => 'nullable|exists:administrador,idAdministrador'       // Validar relación con administrador
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $grupo = Grupo::create([
            'nombre' => $request->nombre,
            'semestre' => $request->semestre,
            'generaciones_idGeneracion' => $request->generaciones_idGeneracion,
            'idAdministrador' => $request->idAdministrador,
        ]);

        if (!$grupo) {
            return response()->json([
                'message' => 'Error al crear el grupo',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'Grupo creado exitosamente',
            'grupo' => $grupo,
            'status' => 201
        ], 201);
    }

    // Mostrar un grupo específico
    public function show($idGrupo)
    {
        $grupo = Grupo::find($idGrupo);

        if (!$grupo) {
            return response()->json([
                'message' => 'Grupo no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'grupo' => $grupo,
            'status' => 200
        ], 200);
    }

    // Actualizar un grupo existente
    public function update(Request $request, $idGrupo)
    {
        $grupo = Grupo::find($idGrupo);

        if (!$grupo) {
            return response()->json([
                'message' => 'Grupo no encontrado',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|regex:/^[A-Z]$/i', // Solo una letra
            'semestre' => 'required|integer|min:1|max:8',   // Semestre entre 1 y 8
            'generaciones_idGeneracion' => 'nullable|exists:generaciones,idGeneracion', // Validar relación con generaciones
            'idAdministrador' => 'nullable|exists:administrador,idAdministrador',      // Validar relación con administrador
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $grupo->update([
            'nombre' => $request->nombre,
            'semestre' => $request->semestre,
            'generaciones_idGeneracion' => $request->generaciones_idGeneracion,
            'idAdministrador' => $request->idAdministrador,
        ]);

        return response()->json([
            'message' => 'Grupo actualizado exitosamente',
            'grupo' => $grupo,
            'status' => 200
        ], 200);
    }

    // Eliminar un grupo
    public function destroy($idGrupo)
    {
        $grupo = Grupo::find($idGrupo);

        if (!$grupo) {
            return response()->json([
                'message' => 'Grupo no encontrado',
                'status' => 404
            ], 404);
        }

        $grupo->delete();

        return response()->json([
            'message' => 'Grupo eliminado exitosamente',
            'status' => 200
        ], 200);
    }
}
