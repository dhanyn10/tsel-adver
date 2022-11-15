<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('users', [UserController::class, 'showAll']);
Route::get('users/{id}', [UserController::class, 'showById']);
Route::post('users', [UserController::class, 'create']);
