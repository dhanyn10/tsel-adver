<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        return $request;
    }
}
