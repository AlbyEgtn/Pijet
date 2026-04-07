<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\SendOtpMail;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::orderBy('name')->get();

        if ($request->is('register/therapist')) {
            return view('auth.register-therapist', compact('cities'));
        }

        return view('auth.register', compact('cities'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // =========================
            // VALIDATION (DYNAMIC ROLE)
            // =========================
            $rules = [

                'nik'        => ['required','digits_between:10,20'],
                'name'       => ['required','string','max:255'],
                'email'      => ['required','email','max:255','unique:users,email'],
                'phone'      => ['required','string','max:20'],

                'gender'     => ['required','in:L,P'],
                'birth_date' => ['required','date'],

                'city_id'    => ['required','exists:cities,id'],

                'password'   => ['required','confirmed','min:6'],
                'role'       => ['required','in:terapis,customer'],
            ];

            // =========================
            // CONDITIONAL RULES
            // =========================
            if ($request->role === 'customer') {

                $rules['address'] = ['required','string'];

            } else { // TERAPIS

                $rules['ktp']  = ['required','file','mimes:jpg,png,pdf','max:2048'];
                $rules['skck'] = ['required','file','mimes:jpg,png,pdf','max:2048'];

                // address optional biar ga error
                $rules['address'] = ['nullable','string'];
            }

            $validated = $request->validate($rules);

            // =====================
            // HANDLE FILE UPLOAD
            // =====================
            $ktpPath = $request->hasFile('ktp')
                ? $request->file('ktp')->store('ktp','public')
                : null;

            $skckPath = $request->hasFile('skck')
                ? $request->file('skck')->store('skck','public')
                : null;

            // =====================
            // GENERATE OTP
            // =====================
            $otp = rand(100000, 999999);

            // =====================
            // CREATE USER
            // =====================
            $user = User::create([

                'nik'        => $validated['nik'],
                'name'       => $validated['name'],
                'email'      => $validated['email'],
                'phone'      => $validated['phone'],

                'gender'     => $validated['gender'],
                'birth_date' => $validated['birth_date'],

                'city_id'    => $validated['city_id'],

                'address'    => $validated['address'] ?? '-',

                'role'       => $validated['role'],

                'verification_status' => 'pending',

                'ktp'        => $ktpPath,
                'skck'       => $skckPath,

                'password'   => Hash::make($validated['password']),

                'email_otp'  => $otp,
                'otp_expired_at' => now()->addMinutes(10),
            ]);

            // =====================
            // SEND EMAIL (SAFE MODE)
            // =====================
            try {
                Mail::to($user->email)->send(new SendOtpMail($otp));
            } catch (\Exception $mailError) {

                // log error email tapi user tetap dibuat
                \Log::error('Mail error: '.$mailError->getMessage());
            }

            session([
                'verify_user_id' => $user->id
            ]);

            DB::commit();

            return redirect()->route('verify.notice');

        } catch (\Exception $e) {

            DB::rollBack();

            \Log::error('Register error: '.$e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Registrasi gagal. Silakan cek input atau hubungi admin.');
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required','digits:6']
        ]);

        $user = User::find(session('verify_user_id'));

        if (!$user) {
            return redirect('/register')
                ->with('error','Session verifikasi tidak ditemukan');
        }

        if ($request->otp != $user->email_otp) {
            return back()->with('error','Kode OTP salah');
        }

        if (now()->gt($user->otp_expired_at)) {
            return back()->with('error','Kode OTP sudah kadaluarsa');
        }

        $user->update([
            'email_verified_at' => now(),
            'email_otp' => null,
            'otp_expired_at' => null,

            'verification_status' => $user->role === 'terapis'
                ? 'pending'
                : 'approved',
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        session()->forget('verify_user_id');

        if ($user->role === 'terapis') {
            return redirect()
                ->route('therapist.assessment')
                ->with('success','Email terverifikasi, silakan lengkapi profil terapis');
        }

        return redirect()
            ->route('login')
            ->with('success','Email berhasil diverifikasi');
    }
}