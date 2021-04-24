<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\User;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->header('Authorization')) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        $token = trim(str_replace('bearer', '', $request->header('Authorization')));

        $token = base64_decode($token);

        echo('<pre>');
        print_r($token);
        echo('</pre>');
        exit('Parando execução do software.');
        
        if (!User::where('token', $token)->first()) {
            return response()->json(['error' => 'Token inválido.'], 401);
        }

        return $next($request);
    }
}
