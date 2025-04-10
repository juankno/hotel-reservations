<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * Iniciar sesión
     *
     * Permite a los usuarios autenticarse en la aplicación. Requiere un correo y contraseña válidos.
     *
     * @param \App\Http\Requests\LoginUserRequest $request
     * @return \App\Http\Resources\UserResource
     * @unauthenticated
     */
    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($request->device_name ?? 'auth_api')->plainTextToken;

        $user->token = $token;

        return new UserResource($user);
    }

    /**
     * Cerrar sesión
     *
     * Permite a los usuarios cerrar sesión en la aplicación. Requiere un token de autenticación válido.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ], Response::HTTP_OK);
    }


    /**
     * Obtener usuario autenticado
     *
     * Devuelve la información del usuario autenticado. Requiere un token de autenticación válido.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\UserResource
     */
    public function user(Request $request)
    {
        return new UserResource($request->user()->load('role'));
    }
}
