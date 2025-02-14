<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    /**
     * Iniciar sesión
     */
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $credentials = $request->validate([
            'correo' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Buscar el usuario por correo
        $user = Usuario::where('correo', $credentials['correo'])->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado.',
            ], 404);
        }

        // Verificar la contraseña
        $passwordCheck = Hash::check($credentials['password'], $user->password);

        if (!$passwordCheck) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciales incorrectas.',
                'debug' => [
                    'stored_password' => $user->password,
                    'provided_password' => $credentials['password'],
                    'password_check' => $passwordCheck
                ]
            ], 401);
        }

        // Generar el token usando Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Inicio de sesión exitoso.',
            'access_token' => $token,
            'token_type' => 'Bearer',
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



    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        if (!$request->user()) {
            return response()->json([
                'success' => false,
                'message' => 'No hay usuario autenticado.',
            ], 401);
        }

        // Revocar todos los tokens del usuario autenticado
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cierre de sesión exitoso.',
        ], 200);
    }

    /**
     * Método para probar la verificación de la contraseña
     */
    public function testPassword(Request $request)
    {
        $user = Usuario::where('correo', $request->correo)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado.',
            ], 404);
        }

        $isValidPassword = Hash::check($request->password, $user->password);

        return response()->json([
            'user' => $user,
            'password_check' => $isValidPassword,
            'stored_password' => $user->password,
        ]);
    }
}
