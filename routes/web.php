<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('register');
});
Route::get('register', [UserController::class, 'showRegister'])->name('register');
Route::get('login', [UserController::class, 'showLogin'])->name('login');

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
