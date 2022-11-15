<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $nama = $request->nama;
        $email = $request->email;
        $telepon = $request->telepon;
        $user = User::where('email', $email)->get();

        if(count($user) > 0) {
            $response = array(
                'msg'   => 0
            );
        } else {
            $create = User::create([
                'nama' => $nama,
                'email' => $email,
                'telepon' => $telepon
            ]);

            $response = array(
                'msg'   => 1
            );
        }
        return response()->json($response);
    }

    public function showLogin()
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
