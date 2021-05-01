<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ToDoIngController;


Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::middleware(['auth'])->group(function () {
    Route::post('/refresh', [UserController::class, 'refresh']);

    Route::get('/todo/list', [TodoController::class, 'listTodo']);
    Route::get('/todo/user/{user_id}', [TodoController::class, 'listTodoPerUser']);

    Route::delete('/todo/{id}', [TodoController::class, 'removeTodo']);

    Route::post('/todoing/save', [ToDoIngController::class, 'save']);
});
