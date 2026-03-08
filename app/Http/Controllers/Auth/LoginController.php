<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){

            $request->session()->regenerate();

            $user = Auth::user();

            switch ($user->role) {

                case 'super_admin':
                case 'admin':
                case 'finance':
                case 'terapis':
                case 'customer':
                    return redirect()->route('dashboard');

            }

        }

        return back()->with('error','Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}