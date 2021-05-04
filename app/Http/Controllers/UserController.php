<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{

    public function saveUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $userExists = User::where('email', $request->email)->first();

        if ($userExists) {
            return response()->json(['error' => 'Usuário já existe no sistema'], 401);
        }

        $credentials = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $newUSer = User::create($credentials);
        $newUSer->save();

        return response()->json(['success' => 'Novo usuário cadastrado com sucesso!'], 200);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
