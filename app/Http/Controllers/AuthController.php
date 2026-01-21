<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegister(){
        return view('register');
    }
    public function register(Request $request){
        $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:users",
            "password"=>"required|min:6|confirmed",
        ]);
        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password)
        ]);
        return redirect()->route('login')->with('success', 'Account created successfully!');
    }
    public function showLogin(){
        return view('login');
    }
    public function login(Request $request){
        $credentials=$request->only("email","password");
        if(!Auth::attempt($credentials)){
            return back()->withErrors(['email'=>'Invalid Credentials'])->withInput();
        }
        $request->session()->regenerate();
        return redirect()->route('index');
    }   

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    
}


