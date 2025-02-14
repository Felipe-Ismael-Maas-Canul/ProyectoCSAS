<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VariableController extends Controller
{
    public function indexVariable()
    {
        $variables = Variable::all();

        $data = [
            'variables' => $variables,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idVariable' => 'required',
            'nombre' => 'required',
            'categoria_idCategoria' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $variable = Variable::create([
            'idVariable' => $request->idVariable,
            'nombre' => $request->nombre,
            'categoria_idCategoria' => $request->categoria_idCategoria
        ]);

        if (!$variable) {
            $data = [
                'message' => 'Error al crear la variable',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $variable,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($idVariable)
    {
        $variable = Variable::where('idVariable', $idVariable)->first();

        if (!$variable) {
            $data = [
                'message' => 'Variable no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'variable' => $variable,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($idVariable)
    {
        $variable = Variable::where('idVariable', $idVariable)->first();

        if (!$variable) {
            $data = [
                'message' => 'Variable no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $variable->delete();

        $data = [
            'message' => 'Variable eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $idVariable)
    {
        $variable = Variable::where('idVariable', $idVariable)->first();

        if (!$variable) {
            $data = [
                'message' => 'Variable no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'idVariable' => 'required',
            'nombre' => 'required',
            'categoria_idCategoria' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $variable->idVariable = $request->idVariable;
        $variable->nombre = $request->nombre;
        $variable->categoria_idCategoria = $request->categoria_idCategoria;

        $variable->save();

        $data = [
            'message' => 'Variable actualizada',
            'variable' => $variable,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
