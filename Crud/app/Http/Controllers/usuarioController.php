<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\error;

class usuarioController extends Controller{
    public function indexUsuario()
    {
        $usuarios = Usuario::all();

        $data = [
            'usuarios' => $usuarios,
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    public function store(Request $request)
    {
        $rules = [
            'nombres' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuario,correo',
            'password' => 'required|string|min:6',
            'tipo' => 'required|in:Alumno,Administrador',
            'genero' => 'required|string',
            'edad' => 'required|integer|min:1|max:100',
        ];

        if ($request->input('tipo') === 'Alumno') {
            $rules['Alumno_Matricula'] = 'required|string|unique:usuario,Alumno_Matricula';
        } elseif ($request->input('tipo') === 'Administrador') {
            $rules['Administrador_idAdministrador'] = 'required|string|unique:usuario,Administrador_idAdministrador';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }


        // Crear el usuario
        $user = new Usuario();
        $user->nombres = $request->input('nombres');
        $user->primer_apellido = $request->input('primer_apellido');
        $user->segundo_apellido = $request->input('segundo_apellido');
        $user->correo = $request->input('correo');
        $user->password = $request->input('password'); // Encripta la contraseña
        $user->tipo = $request->input('tipo');
        $user->genero = $request->input('genero');
        $user->edad = $request->input('edad');

        if ($request->input('tipo') === 'Alumno') {
            $user->matricula = $request->input('matricula');
            $user->Alumno_Matricula = $request->input('Alumno_Matricula');
        } elseif ($request->input('tipo') === 'Administrador') {
            $user->Administrador_idAdministrador = $request->input('Administrador_idAdministrador');
            $user->matricula = null; // O un valor predeterminado como una cadena vacía
            $user->Alumno_Matricula = null;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado correctamente.',
            'data' => $user
        ], 201);
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
            'password' => 'required',
            'tipo' => 'required',
            'Alumno_Matricula' => 'required',
            'Administrador_idAdministrador' => 'required',
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
            $usuarios-> password = $request -> password;
            $usuarios-> tipo = $request -> tipo;
            $usuarios-> Alumno_Matricula = $request -> Alumno_Matricula;
            $usuarios-> Administrador_idAdministrador = $request -> Administrador_idAdministrador;
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
