<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\SendOtpMail;

class ForgotPasswordController extends Controller
{

    public function index()
    {
        return view('auth.forgot-password');
    }


    public function sendOtp(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        $otp = random_int(100000, 999999);

        $user->reset_otp = $otp;
        $user->reset_otp_expired_at = now()->addMinutes(10);
        $user->save();


        Mail::to($user->email)->send(
            new SendOtpMail($otp)
        );

        session([
            'reset_email' => $user->email
        ]);

        return redirect('/forgot-password/verify');
    }


    public function verifyPage()
    {
        return view('auth.forgot-otp');
    }


    public function verifyOtp(Request $request)
    {

        $request->validate([
            'otp' => 'required'
        ]);

        $email = session('reset_email');

        $user = User::where('email', $email)
            ->where('reset_otp', $request->otp)
            ->where('reset_otp_expired_at', '>', now())
            ->first();

        if (!$user) {

            return back()->withErrors([
                'otp' => 'Kode OTP tidak valid atau sudah kadaluarsa'
            ]);

        }

        session([
            'reset_verified' => true
        ]);

        return redirect('/forgot-password/reset');

    }


    public function resetPage()
    {
        return view('auth.reset-password');
    }


    public function resetPassword(Request $request)
    {

        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        if (!session('reset_verified')) {
            return redirect('/login');
        }

        $email = session('reset_email');

        $user = User::where('email', $email)->first();

        $user->password = Hash::make($request->password);
        $user->reset_otp = null;
        $user->reset_otp_expired_at = null;
        $user->save();

        session()->forget([
            'reset_email',
            'reset_verified'
        ]);

        return redirect('/login')
            ->with('success','Password berhasil diperbarui');

    }

}