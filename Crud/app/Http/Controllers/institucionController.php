<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstitucionController extends Controller
{
    public function indexInstituciones()
    {
        return response()->json([
            'instituciones' => Institucion::all(),
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100|unique:institucion,nombre',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos.',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $institucion = Institucion::create([
            'nombre' => $request->nombre
        ]);

        return response()->json([
            'message' => 'Institución creada exitosamente.',
            'institucion' => $institucion,
            'status' => 201
        ], 201);
    }

    public function show($idInstitucion)
    {
        $institucion = Institucion::find($idInstitucion);

        if (!$institucion) {
            return response()->json([
                'message' => 'Institución no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'institucion' => $institucion,
            'status' => 200
        ], 200);
    }

    public function destroy($idInstitucion)
    {
        $institucion = Institucion::find($idInstitucion);

        if (!$institucion) {
            return response()->json([
                'message' => 'Institución no encontrada',
                'status' => 404
            ], 404);
        }

        $institucion->delete();

        return response()->json([
            'message' => 'Institución eliminada correctamente',
            'status' => 200
        ], 200);
    }

    public function update(Request $request, $idInstitucion)
    {
        $institucion = Institucion::find($idInstitucion);

        if (!$institucion) {
            return response()->json([
                'message' => 'Institución no encontrada',
                'status' => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100|unique:institucion,nombre,'.$idInstitucion.',idInstitucion',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $institucion->nombre = $request->nombre;
        $institucion->save();

        return response()->json([
            'message' => 'Institución actualizada correctamente',
            'institucion' => $institucion,
            'status' => 200
        ], 200);
    }
}
