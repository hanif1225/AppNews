<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PassportAuthController extends Controller
{

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'no_hp' => 'required|unique:users',
            'username' => 'required|unique:users|min:4',
        ],
        [
            'email.unique' => " email sudah ada yang menggunakan",
            'username.unique' => " username sudah ada yang menggunakan",
            'no_hp.unique' => " No HP sudah ada yang menggunakan",
        ]
    );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'username' => $request->username,
            'level' => 'user',
        ]);
       
        $token = $user->createToken('LaravelAuthApp')->accessToken;
 
        return response()->json(['token' => $token], 200);
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {
        $isi = $request->datas;
        if(is_numeric($isi))
        {
            $data = [
                'no_hp' => $isi,
                'password' => $request->password
            ];  
        }
        else
        {
            $data = [
                'email' => $isi,
                'password' => $request->password
            ];
        }
        
        if(is_numeric($isi))
        {
            $data2  = User::where('no_hp',$isi)->first();
        }
        else
        {
            $data2  = User::where('email',$isi)->first();
        }
        

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json([
                'token' => $token,
                'data2'    =>$data2
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }   

}
