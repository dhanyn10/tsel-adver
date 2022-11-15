<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function show()
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
}
