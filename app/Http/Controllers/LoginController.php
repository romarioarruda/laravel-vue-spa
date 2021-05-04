<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = ['email' => $request->email];

        $user = User::where($credentials)->first();

        if (!$user) {
            return response()->json(['error' => 'Usuário não identificado.'], 404);
        }

        if (Hash::check($request->password, $user->password)) {
            if (!$token = auth('api')->login($user)) {
                return response()->json(['error' => 'Login unauthorized'], 401);
            }
    
            return $this->respondWithToken($token, $user);
        }

        return response()->json(['error' => 'E-mail ou senha inválidos.'], 401);
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'user' => $user,
            'token' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]
        ]);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
