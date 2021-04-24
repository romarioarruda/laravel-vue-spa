<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $errors = $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => "O e-mail é obrigatório",
            'password.required' => "A senha é obrigatória"
        ]);

        $credentials = $request->only('email', 'password');

        if ($user = User::select('id', 'name', 'email', 'remember_token')->where($credentials)->first()) {
            return response()->json($user, 200);
        } else {
            return response()->json(['error' => 'Usuário ou senha inválidos.'], 401);
        }
        
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}
