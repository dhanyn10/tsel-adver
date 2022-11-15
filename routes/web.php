<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DasborController;

Route::get('/', function () {
    return redirect()->route('register');
});
Route::get('register', [RegisterController::class, 'show'])->name('register');
Route::get('login', [LoginController::class, 'show'])->name('login');
Route::get('dasbor', [DasborController::class, 'show'])->name('dasbor');

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
