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
        $instituciones = Institucion::all();

        $data = [
            'instituciones' => $instituciones,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idInstitucion' => 'required',
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

        $institucion = Institucion::create([
            'idInstitucion' => $request->idInstitucion,
            'nombre' => $request->nombre
        ]);

        if (!$institucion) {
            $data = [
                'message' => 'Error al crear la institución',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $institucion,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($idInstitucion)
    {
        $institucion = Institucion::where('idInstitucion', $idInstitucion)->first();

        if (!$institucion) {
            $data = [
                'message' => 'Institución no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'institucion' => $institucion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($idInstitucion)
    {
        $institucion = Institucion::where('idInstitucion', $idInstitucion)->first();

        if (!$institucion) {
            $data = [
                'message' => 'Institución no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $institucion->delete();

        $data = [
            'message' => 'Institución eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $idInstitucion)
    {
        $institucion = Institucion::where('idInstitucion', $idInstitucion)->first();

        if (!$institucion) {
            $data = [
                'message' => 'Institución no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'idInstitucion' => 'required',
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

        $institucion->idInstitucion = $request->idInstitucion;
        $institucion->nombre = $request->nombre;

        $institucion->save();

        $data = [
            'message' => 'Institución actualizada',
            'institucion' => $institucion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
