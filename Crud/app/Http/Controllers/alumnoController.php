<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\error;

class alumnoController extends Controller{
    public function indexAlumno()
    {
        $alumnos = Alumno::all();

        $data = [
            'alumnos' => $alumnos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store (Request $request)
    {
        $validator = validator::make($request->all(),[
            'matricula'=>'required',
            'nombres'=>'required',
            'primer_apellido'=>'required',
            'segundo_apellido'=>'required',
            'Institucion_idInstitucion'=>'required',
            'Carreras_idCarrera'=>'required',
            'Generaciones_idGeneracion'=>'required',
            'Grupo_idGrupo'=>'required',
            'genero'=>'required',
            'edad'=>'required'
        ]);

        if ($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 200
            ];
            return response()->json($data, 400);
        }
        $alumnos = Alumno::create([
            'matricula'=> $request -> matricula,
            'nombres'=> $request -> nombres,
            'primer_apellido'=> $request -> primer_apellido,
            'segundo_apellido'=> $request -> segundo_apellido,
            'Institucion_idInstitucion'=> $request -> Institucion_idInstitucion,
            'Carreras_idCarrera'=> $request -> Carreras_idCarrera,
            'Generaciones_idGeneracion'=> $request -> Generaciones_idGeneracio,
            'Grupo_idGrupo'=> $request -> Grupo_idGrupo,
            'genero'=> $request -> genero,
            'edad'=> $request -> edad
        ]);

        if (!$alumnos){
            $data = [
                'message'=> 'error al crear al alumno',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data =[
            'message' => $alumnos,
            'status' => 2001
        ];
        return response()->json($data, 201);
    }
    public function show($matricula){

        $alumnos = Alumno::where('matricula', $matricula)->first();
    
        if (!$alumnos) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
    
        $data = [
            'alumno' => $alumnos,
            'status' => 200
        ];
    
        return response()->json($data, 200);
        }

        public function destroy($matricula)
        {
            $alumnos = Alumno::where('matricula', $matricula)->first();
        
            if (!$alumnos) {
                $data = [
                    'message' => 'Alumno no encontrado',
                    'status' => 404
                ];
                return response()->json($data, 404);
            }
        
            $alumnos->delete();
        
            $data = [
                'message' => 'alumno eliminado',
                'status' => 200
            ];
        
            return response()->json($data, 200);

        }

    public function update(Request $request, $matricula){
        $alumnos = Alumno::where('matricula', $matricula)->first();
        if (!$alumnos) {
            $data = [
                'message' => 'alumno no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $validator = validator::make($request->all(),[
            'matricula'=>'required',
            'nombres'=>'required',
            'primer_apellido'=>'required',
            'segundo_apellido'=>'required',
            'Institucion_idInstitucion'=>'required',
            'Carreras_idCarrera'=>'required',
            'Generaciones_idGeneracion'=>'required',
            'Grupo_idGrupo'=>'required',
            'genero'=>'required',
            'edad'=>'required'
        ]);
        
        if ($validator->fails()){
            $data = [
                'message' => 'Error de validacion',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $alumnos-> matricula = $request -> matricula;
        $alumnos-> nombres =  $request -> nombres;
        $alumnos-> primer_apellido = $request-> primer_apellido;
        $alumnos-> segundo_apellido = $request -> segundo_apellido;
        $alumnos-> Institucion_idInstitucion = $request -> Institucion_idInstitucion;
        $alumnos-> Carreras_idCarrera = $request -> Carreras_idCarrera;
        $alumnos-> Generaciones_idGeneracion = $request -> Generaciones_idGeneracio;
        $alumnos-> Grupo_idGrupo = $request -> Grupo_idGrupo;
        $alumnos-> genero = $request -> genero;
        $alumnos-> edad = $request -> edad;
        
        $alumnos ->save();
        
            $data = [
                'message'=> 'Estudiante actualizado',
                'usuarios' => $alumnos,
                'status' => 200
                ];
        
                return response()->json($data,200);
    }
}

