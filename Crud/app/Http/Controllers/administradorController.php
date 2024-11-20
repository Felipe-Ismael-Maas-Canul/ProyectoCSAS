<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\error;

class AdministradorController extends Controller
{
    public function indexAdministrador()
    {
        $administradores = Administrador::all();

        $data = [
            'administradores' => $administradores,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idAdministrador' => 'required',
            'nombre' => 'required',
            'Grupo_idGrupo' => 'required',
            'Alumno_Matricula' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $administrador = Administrador::create([
            'idAdministrador' => $request->idAdministrador,
            'nombre' => $request->nombre,
            'Grupo_idGrupo' => $request->Grupo_idGrupo,
            'Alumno_Matricula' => $request->Alumno_Matricula
        ]);

        if (!$administrador) {
            $data = [
                'message' => 'Error al crear el administrador',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $administrador,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($idAdministrador)
    {
        $administrador = Administrador::where('idAdministrador', $idAdministrador)->first();

        if (!$administrador) {
            $data = [
                'message' => 'Administrador no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'administrador' => $administrador,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($idAdministrador)
    {
        $administrador = Administrador::where('idAdministrador', $idAdministrador)->first();

        if (!$administrador) {
            $data = [
                'message' => 'Administrador no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $administrador->delete();

        $data = [
            'message' => 'Administrador eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $idAdministrador)
    {
        $administrador = Administrador::where('idAdministrador', $idAdministrador)->first();
        if (!$administrador) {
            $data = [
                'message' => 'Administrador no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'idAdministrador' => 'required',
            'nombre' => 'required',
            'Grupo_idGrupo' => 'required',
            'Alumno_Matricula' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $administrador->idAdministrador = $request->idAdministrador;
        $administrador->nombre = $request->nombre;
        $administrador->Grupo_idGrupo = $request->Grupo_idGrupo;
        $administrador->Alumno_Matricula = $request->Alumno_Matricula;

        $administrador->save();

        $data = [
            'message' => 'Administrador actualizado',
            'administrador' => $administrador,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
