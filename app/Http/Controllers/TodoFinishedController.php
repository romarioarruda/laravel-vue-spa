<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoFinished;

class TodoFinishedController extends Controller
{
    public function listTodoPerUser(int $userId)
    {
        $todoByUser = TodoFinished::where('user_id', $userId)->get();

        return $todoByUser ?? [];
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
        
        $todoing = TodoFinished::create($parameters);

        $todoing->save();

        return response()->json(['todofinished' => 'created'], 201);
    }

    public function removeTodo(int $id)
    {
        TodoFinished::where('id', $id)->delete();

        return response()->json([], 204);
    }
}
