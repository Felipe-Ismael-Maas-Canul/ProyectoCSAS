<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller{
    public function indexGrupos()
    {
        $grupos = Grupo::all();

        $data = [
            'grupos' => $grupos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idGrupo' => 'required',
            'nombre' => 'required',
            'generaciones_idGeneracion' => 'required',
            'idAdministrador' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $grupo = Grupo::create([
            'idGrupo' => $request->idGrupo,
            'nombre' => $request->nombre,
            'generaciones_idGeneracion' => $request->generaciones_idGeneracion,
            'idAdministrador' => $request->idAdministrador
        ]);

        if (!$grupo) {
            $data = [
                'message' => 'Error al crear el grupo',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $grupo,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($idGrupo)
    {
        $grupo = Grupo::where('idGrupo', $idGrupo)->first();

        if (!$grupo) {
            $data = [
                'message' => 'Grupo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'grupo' => $grupo,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($idGrupo)
    {
        $grupo = Grupo::where('idGrupo', $idGrupo)->first();

        if (!$grupo) {
            $data = [
                'message' => 'Grupo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $grupo->delete();

        $data = [
            'message' => 'Grupo eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $idGrupo)
    {
        $grupo = Grupo::where('idGrupo', $idGrupo)->first();

        if (!$grupo) {
            $data = [
                'message' => 'Grupo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'idGrupo' => 'required',
            'nombre' => 'required',
            'generaciones_idGeneracion' => 'required',
            'idAdministrador' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $grupo->idGrupo = $request->idGrupo;
        $grupo->nombre = $request->nombre;
        $grupo->generaciones_idGeneracion = $request->generaciones_idGeneracion;
        $grupo->idAdministrador = $request->idAdministrador;

        $grupo->save();

        $data = [
            'message' => 'Grupo actualizado',
            'grupo' => $grupo,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}

