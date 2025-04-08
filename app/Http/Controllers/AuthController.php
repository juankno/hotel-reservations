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
     *
     * Login user
     *
     * This endpoint allows users to log in to the application. It requires a valid email and password.
     *
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
     * Logout user
     *
     * This endpoint allows users to log out of the application. It requires a valid authentication token.
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
     * Get authenticated user
     *
     * This endpoint returns the authenticated user's information. It requires a valid authentication token.
     *
     */
    public function user(Request $request)
    {
        return new UserResource($request->user());
    }
}
