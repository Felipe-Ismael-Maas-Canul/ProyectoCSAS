<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Método para manejar el inicio de sesión
    public function login(Request $request)
    {
        // Validar los datos recibidos
        $credentials = $request->validate([
            'correo' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt(['correo' => $credentials['correo'], 'password' => $credentials['password']])) {
            $user = Auth::user(); // Obtener el usuario autenticado

            return response()->json([
                'success' => true,
                'message' => 'Inicio de sesión exitoso.',
                'user' => [
                    'id' => $user->idUsuario,
                    'nombres' => $user->nombres,
                    'primer_apellido' => $user->primer_apellido,
                    'tipo' => $user->tipo,
                    'correo' => $user->correo,
                    'genero' => $user->genero,
                ],
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Credenciales incorrectas.',
        ], 401);
    }

    // Método para cerrar sesión
    public function logout()
    {
        Auth::logout();

        return response()->json([
            'success' => true,
            'message' => 'Cierre de sesión exitoso.',
        ], 200);
    }
}
