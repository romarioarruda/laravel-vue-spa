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

    public function listTodoPerUser(int $userId)
    {
        $todoByUser = Todo::where('user_id', $userId)->get();

        return $todoByUser ?? [];
    }
}
