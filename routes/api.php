<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ToDoIngController;
use App\Http\Controllers\TodoFinishedController;


Route::post('/saveUser', [UserController::class, 'saveUser']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::middleware(['auth'])->group(function () {
    Route::post('/refresh', [UserController::class, 'refresh']);

    Route::get('/todo/user/{user_id}', [TodoController::class, 'listTodoPerUser']);
    Route::post('/todo/save', [TodoController::class, 'save']);
    Route::delete('/todo/{id}', [TodoController::class, 'removeTodo']);

    Route::get('/todoing/user/{user_id}', [ToDoIngController::class, 'listTodoPerUser']);
    Route::post('/todoing/save', [ToDoIngController::class, 'save']);
    Route::delete('/todoing/{id}', [ToDoIngController::class, 'removeTodo']);

    Route::get('/todofinished/user/{user_id}', [TodoFinishedController::class, 'listTodoPerUser']);
    Route::post('/todofinished/save', [TodoFinishedController::class, 'save']);
    Route::delete('/todofinished/{id}', [TodoFinishedController::class, 'removeTodo']);
});
