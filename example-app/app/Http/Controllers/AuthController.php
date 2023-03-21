<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response(['error' => 'User already exists'],status:409);
        }
        $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return $user;
    }
    public function login(Request $request)
    {
        # code...
        if(!Auth::attempt(['email' => $request->email,'password' => $request->password])){
            return response([
                'message' => 'Invalide data',
            ],status:401);
        }

        $user=Auth::user();
        $token=$user->createToken('token')->plainTextToken;
        $cookie=cookie('jwt' , $token , 60*24); //it's one day;
        return response([
            'message'=>'Success',
            'token'=> $token
        ])->withCookie($cookie);

    }
    public function logout(Request $request)
    {
        $cookie=Cookie::forget('jwt');
        return response([
            'message'=>'Success'
        ])->withCookie($cookie);
    }
    public function user()
    {
        return Auth::user();
    }
}
