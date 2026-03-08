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
                    return redirect()->route('superadmin.dashboard');

                case 'admin':
                    return redirect()->route('admin.dashboard');

                case 'finance':
                    return redirect()->route('finance.dashboard');

                case 'terapis':
                    return redirect()->route('terapis.dashboard');

                case 'customer':
                    return redirect()->route('customer.dashboard');

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