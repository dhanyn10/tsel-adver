<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

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

        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'telepon' => 'numeric|digits_between:11,13'
        ]);

        $status = null;
        if($validasi->fails()) {
            return response()->json(['status' => 'fails']);
        }

        $user = User::where('email', $email)->get();

        if(count($user) > 0) {
            $status = "exists";
        } else {
            $create = User::create([
                'nama' => $nama,
                'email' => $email,
                'telepon' => $telepon
            ]);
            $status = "created";
        }
        return response()->json(['status' => $status]);
    }
}
