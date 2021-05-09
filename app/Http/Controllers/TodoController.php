<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Todo;

class TodoController extends Controller
{

    public function listTodoPerUser(int $userId)
    {
        $expiration = 60; // minute
        $key = 'todo_'.$userId;

        return Cache::remember($key, $expiration, function () use ($userId) {
            return Todo::where('user_id', $userId)->get();
        });
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'titulo' => 'required',
            'user_id'
        ]);

        $parameters = $request->only('id', 'titulo', 'user_id');
        
        $parameters['created_at'] = date('Y-m-d H:i:s');
        
        $todoing = Todo::create($parameters);

        $todoing->save();

        return response()->json(['todo' => 'created'], 201);
    }

    public function removeTodo(int $id)
    {
        Todo::where('id', $id)->delete();

        return response()->json([], 204);
    }
}
