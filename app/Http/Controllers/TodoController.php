<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function listTodo()
    {
        return Todo::all();
    }

    public function listTodoPerUser(Request $request)
    {
        $userData = $request->only('user_id');

        return Todo::where($userData)->get();
    }
}
