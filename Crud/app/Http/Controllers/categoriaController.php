<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller{
    public function indexCategoria()
    {
        $categorias = Categoria::all();

        $data = [
            'categorias' => $categorias,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idCategoria' => 'required',
            'nombre' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $categoria = Categoria::create([
            'idCategoria' => $request->idCategoria,
            'nombre' => $request->nombre
        ]);

        if (!$categoria) {
            $data = [
                'message' => 'Error al crear la categoría',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $categoria,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($idCategoria)
    {
        $categoria = Categoria::where('idCategoria', $idCategoria)->first();

        if (!$categoria) {
            $data = [
                'message' => 'Categoría no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'categoria' => $categoria,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($idCategoria)
    {
        $categoria = Categoria::where('idCategoria', $idCategoria)->first();

        if (!$categoria) {
            $data = [
                'message' => 'Categoría no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $categoria->delete();

        $data = [
            'message' => 'Categoría eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $idCategoria)
    {
        $categoria = Categoria::where('idCategoria', $idCategoria)->first();

        if (!$categoria) {
            $data = [
                'message' => 'Categoría no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'idCategoria' => 'required',
            'nombre' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $categoria->idCategoria = $request->idCategoria;
        $categoria->nombre = $request->nombre;

        $categoria->save();

        $data = [
            'message' => 'Categoría actualizada',
            'categoria' => $categoria,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
