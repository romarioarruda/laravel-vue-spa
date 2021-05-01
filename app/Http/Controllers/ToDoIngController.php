<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDoIng;

class ToDoIngController extends Controller
{
    public function save(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'titulo' => 'required',
            'user_id'
        ]);

        $parameters = $request->only('id', 'titulo', 'user_id');
        
        $parameters['created_at'] = date('Y-m-d H:i:s');
        
        $todoing = ToDoIng::create($parameters);

        $todoing->save();

        return response()->json(['todoing' => 'created'], 201);
    }

    public function listTodoPerUser(int $userId)
    {
        $todoByUser = ToDoIng::where('user_id', $userId)->get();

        return $todoByUser ?? [];
    }
}
