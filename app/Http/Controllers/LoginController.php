<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->get();

        $code = 0;
        $nama = null;
        if(count($user) > 0) {
            $nama = $user->pluck('nama')->first();
            $code = 1;
        }
        return response()->json([
            'code' => $code,
            'nama' => $nama
        ]);
    }
}
