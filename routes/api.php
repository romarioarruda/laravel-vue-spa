<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;


Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::post('/refresh', [UserController::class, 'refresh'])->middleware('auth');

Route::get('/todo/list', [TodoController::class, 'listTodo'])->middleware('auth');
Route::get('/todo/user/{user_id}', [TodoController::class, 'listTodoPerUser'])->middleware('auth');
