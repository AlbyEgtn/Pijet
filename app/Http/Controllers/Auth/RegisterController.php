<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }


    public function store(Request $request)
    {

        $validated = $request->validate([

            'nik'        => ['required','digits_between:10,20'],
            'name'       => ['required','string','max:255'],
            'email'      => ['required','email','unique:users,email'],
            'phone'      => ['required'],
            'password'   => ['required','confirmed','min:6'],
            'role'       => ['required','in:customer,terapis'],
            'ktp'        => ['nullable','file','mimes:jpg,png,pdf'],
            'skck'       => ['nullable','file','mimes:jpg,png,pdf']

        ]);


        $ktpPath  = null;
        $skckPath = null;


        if ($request->hasFile('ktp')) {

            $ktpPath = $request->file('ktp')
                ->store('ktp','public');

        }


        if ($request->hasFile('skck')) {

            $skckPath = $request->file('skck')
                ->store('skck','public');

        }


        $otp = rand(100000,999999);


        $user = User::create([

            'nik'        => $validated['nik'],
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'],
            'role'       => $validated['role'],
            'ktp'        => $ktpPath,
            'skck'       => $skckPath,
            'password'   => Hash::make($validated['password']),
            'email_otp'  => $otp,
            'otp_expired_at' => now()->addMinutes(10)

        ]);


        Mail::to($user->email)
            ->send(new SendOtpMail($otp));


        session([
            'verify_user_id' => $user->id
        ]);


        return redirect()
            ->route('verify.notice');
    }



    public function verifyOtp(Request $request)
    {

        $request->validate([
            'otp' => ['required']
        ]);


        $user = User::find(session('verify_user_id'));


        if(!$user){

            return redirect('/register');

        }


        if($request->otp != $user->email_otp){

            return back()->with('error','Kode verifikasi salah');

        }


        if(now()->gt($user->otp_expired_at)){

            return back()->with('error','Kode OTP sudah kadaluarsa');

        }


        $user->update([

            'email_verified_at' => now(),
            'email_otp' => null

        ]);


        session()->forget('verify_user_id');


        return redirect('/login')
            ->with('success','Email berhasil diverifikasi');
    }
}