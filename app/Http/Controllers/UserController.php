<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function showAll()
    {
        $count = User::count();
        if($count > 0) {
            $redisData = json_decode(Redis::get('allUser'));
            if($redisData == 0) {
                $data = User::all();
                // auto expired dalam 1 menit
                Redis::set('allUser', json_encode($data), 'EX', 60);
                return response()->json($data, 200);
            } else {
                return response()->json($redisData, 200);
            }
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

        if(count($data) > 0) {
            return response()->json($data, 200);
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

    public function update(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama'  => 'required',
            'email' => 'required|email',
            'telepon' => 'numeric|digits_between:11,13'
        ]);

        if($validasi->fails()) {
            return response()->json(['message' => 'wrong input'], 405);
        }
        
        $id = $request->id;
        $nama = $request->nama;
        $email = $request->email;
        $telepon = $request->telepon;

        $code = 0;
        $ms = null;
        $cekdata = User::where('id', $id)->get();
        if(count($cekdata) > 0)
        {
            $cekemail = User::where('email', $email)->get();
            if (count($cekemail) > 0) {
                $code = 405;
                $ms = "email already used";
            } else {
                User::where('id', $id)->update([
                    'nama' => $nama,
                    'email' => $email,
                    'telepon' => $telepon
                ]);
                $code = 200;
                $ms = "data updated";
            }
        } else {
            $code = 404;
            $ms = "data not found";
        }

        return response()->json(['message' => $ms], $code);
    }


    public function delete(Request $request)
    {
        $id = $request->id;
        $cekdata = User::where('id', $id)->get();
        if(count($cekdata) > 0)
        {
            User::where('id', $id)->delete();
            $code = 200;
            $ms = "data deleted";
        } else {
            $code = 404;
            $ms = "id not found";
        }

        return response()->json(['message' => $ms], $code);
    }
}
