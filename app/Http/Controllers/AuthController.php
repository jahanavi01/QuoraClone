<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:users",
            "password"=>"required|min:6",
        ]);
        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password)
        ]);
        return response()->json([
            "message"=>"user registered successfully"
        ]);
    }
    public function login(Request $request){
        $credentials=$request->only("email","password");
        if(!$token=Auth::guard('api')->attempt($credentials)){
            return response()->json([
                'error'=>'invalid credentials'
            ],401);
        }
        return response()->json([
            'token'=>$token
        ]);
    }
    
}


