<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();

        $data = [
            'usuarios' => $usuarios,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store (Request $request)
    {
        $validator = validator::make($request->all(),[
            'idUsuario' => 'required',
            'matricula' => 'required',
            'nombres' => 'required',
            'primer_apellido' => 'required',
            'segundo_apellido' => 'required',
            'correo' => 'required|email',
            'contraseña' => 'required',
            //'tipo' => 'required',
            //'Alumno_Matricula' => 'required',
            //'Administrador_idAdministrador' => 'required',
            'genero' => 'required',
            'edad' => 'required'
        ]);

        if ($validator -> fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 200
            ];
            return response()->json($data, 400);
        }
        $usuarios = Usuario::create([
            'idUsuario' => $request -> idUsuario,
            'matricula' => $request -> matricula,
            'nombres' => $request -> nombres,
            'primer_apellido' => $request-> primer_apellido,
            'segundo_apellido' => $request -> segundo_apellido,
            'correo' => $request -> correo,
            'conf_correo' => $request -> conf_correo,
            'contraseña' => $request -> contraseña,
            //'tipo' => $request -> tipo,
            //'Alumno_Matricula' => $request -> Alumno_Matricula,
            //'Administrador_idAdministrador' => $request -> Administrador_idAdministrador,
            'genero' => $request -> genero,
            'edad' => $request -> edad
        ]);

        if (!$usuarios){
            $data = [
                'message'=> 'error al crear al usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data =[
            'message' => $usuarios,
            'status' => 2001
        ];

        return response()->json($data, 201);
    }

    public function show($idUsuario){

    $usuarios = Usuario::where('idUsuario', $idUsuario)->first();

    if (!$usuarios) {
        $data = [
            'message' => 'Estudiante no encontrado',
            'status' => 404
        ];
        return response()->json($data, 404);
    }

    $data = [
        'usuario' => $usuarios,
        'status' => 200
    ];

    return response()->json($data, 200);
    }

    public function destroy($idUsuario)
    {
        $usuarios = Usuario::where('idUsuario', $idUsuario)->first();
    
        if (!$usuarios) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
    
        $usuarios->delete();
    
        $data = [
            'message' => 'Estudiante eliminado',
            'status' => 200
        ];
    
        return response()->json($data, 200);
    }

    public function update(Request $request, $idUsuario){
        $usuarios = Usuario::where('idUsuario', $idUsuario)->first();
        if (!$usuarios) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = validator::make($request->all(),[
            'idUsuario' => 'required',
            'matricula' => 'required',
            'nombres' => 'required',
            'primer_apellido' => 'required',
            'segundo_apellido' => 'required',
            'correo' => 'required|email',
            'conf_correo' => 'required|email',
            'contraseña' => 'required',
            //'tipo' => 'required',
            //'Alumno_Matricula' => 'required',
            //'Administrador_idAdministrador' => 'required',
            'genero' => 'required',
            'edad' => 'required'
        ]);

        if ($validator->fails()){
            $data = [
                'message' => 'Error de validacion',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
            $usuarios-> idUsuario = $request -> idUsuario;
            $usuarios-> matricula = $request -> matricula;
            $usuarios-> nombres =  $request -> nombres;
            $usuarios-> primer_apellido = $request-> primer_apellido;
            $usuarios-> segundo_apellido = $request -> segundo_apellido;
            $usuarios-> correo = $request -> correo;
            $usuarios-> conf_correo = $request -> conf_correo;
            $usuarios-> contraseña = $request -> contraseña;
            //$usuarios-> tipo = $request -> tipo;
            //$usuarios-> Alumno_Matricula = $request -> Alumno_Matricula;
            //$usuarios-> Administrador_idAdministrador = $request -> Administrador_idAdministrador;
            $usuarios-> genero = $request -> genero;
            $usuarios-> edad = $request -> edad;

            $usuarios ->save();

            $data = [
                'message'=> 'Estudiante actualizado',
                'usuarios' => $usuarios,
                'status' => 200
            ];

            return response()->json($data,200);
    }
}