<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function showAll()
    {
        $data = User::all();
        if(count($data) > 0) {
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => 'data not exist'
            ], 404);
        }
    }
    public function showById(Request $request)
    {
        $id = $request->id;
        $data = User::where('id', $id)->get();

        $code = 0;
        $ms = null;
        if(count($data) > 0) {
            return response()->json($data, $code);
        } else {

        return response()->json([
            'message' => 'data not found'
        ], 404);
        }
    }

    public function create(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama'  => 'required',
            'email' => 'required|email',
            'telepon' => 'numeric|digits_between:11,13'
        ]);

        if($validasi->fails()) {
            return response()->json(['message' => 'wrong input'], 405);
        }
        
        $nama = $request->nama;
        $email = $request->email;
        $telepon = $request->telepon;

        $code = 0;
        $ms = null;
        $cekdata = User::where('email', $email)->get();
        if(count($cekdata) == 0)
        {
            $create = User::create([
                'nama' => $nama,
                'email' => $email,
                'telepon' => $telepon
            ]);

            if($create) {
                $code = 200;
                $ms = "data created";
            } else {
                $code = 405;
                $ms = "failed creating data";
            }
        } else {
            $code = 405;
            $ms = "data already exists";
        }

        return response()->json(['message' => $ms], $code);
    }
}
