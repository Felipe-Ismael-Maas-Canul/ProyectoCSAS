<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Muestra todas las categorías.
     */
    public function indexCategoria()
    {
        $categorias = Categoria::all();

        return response()->json([
            'categorias' => $categorias,
            'status' => 200
        ], 200);
    }

    /**
     * Crea una nueva categoría.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $categoria = Categoria::create($request->only('nombre', 'descripcion'));

        return response()->json([
            'message' => 'Categoría creada con éxito',
            'categoria' => $categoria,
            'status' => 201
        ], 201);
    }

    /**
     * Muestra una categoría específica.
     */
    public function show($idCategoria)
    {
        $categoria = Categoria::findOrFail($idCategoria);

        return response()->json([
            'categoria' => $categoria,
            'status' => 200
        ], 200);
    }

    /**
     * Elimina una categoría.
     */
    public function destroy($idCategoria)
    {
        $categoria = Categoria::findOrFail($idCategoria);
        $categoria->delete();

        return response()->json([
            'message' => 'Categoría eliminada',
            'status' => 200
        ], 200);
    }

    /**
     * Actualiza una categoría.
     */
    public function update(Request $request, $idCategoria)
    {
        $categoria = Categoria::findOrFail($idCategoria);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $categoria->update($request->only('nombre', 'descripcion'));

        return response()->json([
            'message' => 'Categoría actualizada',
            'categoria' => $categoria,
            'status' => 200
        ], 200);
    }
}
