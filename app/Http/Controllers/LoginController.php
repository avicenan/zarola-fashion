<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\JWTManager;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index() 
    {   
        if(session('user')) {
            return redirect()->back();
        }

        return view('auth.login');
    }

    public function generateShortToken($user)
    {
        $token = JWTAuth::fromUser($user);
        Session::put('user', $user);

        // Shorten the token to 10 characters
        $shortToken = substr($token, 0, 10);

        return $shortToken;
    }

    public function authenticate (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $validator->validated();
    
        if (!$token = Auth::attempt($credentials)) {
            return redirect()->back()->with('loginError', 'Email atau Password yang anda masukkan salah!');
        }

        $shortToken = $this->generateShortToken(Auth::user());
    
        return redirect()->back();
    }
    
    public function logout(Request $request)
    {   

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if(session('user')) {
            return response()->json(['error' => 'Unable to logout'], 400);
        }

        return redirect()->back();
    }
    
    
}
