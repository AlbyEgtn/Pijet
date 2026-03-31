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
    /**
     * Show form register
     */
    public function index(Request $request)
    {
        $cities = City::orderBy('name')->get();

        if ($request->is('register/therapist')) {
            return view('auth.register-therapist', compact('cities'));
        }

        return view('auth.register', compact('cities'));
    }

    /**
     * Store user baru
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // =========================
            // VALIDASI BERDASARKAN ROLE
            // =========================
            if ($request->role === 'terapis') {

                $validated = $request->validate([

                    // IDENTITAS
                    'nik'        => ['required','digits_between:10,20'],
                    'name'       => ['required','string','max:255'],
                    'email'      => ['required','email','max:255','unique:users,email'],
                    'phone'      => ['required','string','max:20'],

                    // KHUSUS TERAPIS
                    'gender'     => ['required','in:L,P'],
                    'birth_date' => ['required','date'],
                    'work_area'  => ['required','string','max:255'],

                    // AUTH
                    'password'   => ['required','confirmed','min:6'],
                    'role'       => ['required','in:terapis'],

                    // FILE
                    'ktp'        => ['required','file','mimes:jpg,png,pdf','max:2048'],
                    'skck'       => ['required','file','mimes:jpg,png,pdf','max:2048'],
                ]);

            } else {

                // CUSTOMER
                $validated = $request->validate([

                    'nik'        => ['required','digits_between:10,20'],
                    'name'       => ['required','string','max:255'],
                    'email'      => ['required','email','max:255','unique:users,email'],
                    'phone'      => ['required','string','max:20'],

                    'gender'     => ['required','in:L,P'],
                    'birth_date' => ['required','date'],

                    // KHUSUS CUSTOMER
                    'city'       => ['required','string','max:255'],
                    'address'    => ['required','string'],

                    'password'   => ['required','confirmed','min:6'],
                    'role'       => ['required','in:customer'],
                ]);
            }

            // =====================
            // HANDLE FILE UPLOAD
            // =====================
            $ktpPath = null;
            $skckPath = null;

            if ($request->hasFile('ktp')) {
                $ktpPath = $request->file('ktp')->store('ktp','public');
            }

            if ($request->hasFile('skck')) {
                $skckPath = $request->file('skck')->store('skck','public');
            }

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

                // =====================
                // ROLE BASED FIELD
                // =====================
                'city'       => $validated['city'] ?? $validated['work_area'],
                'address'    => $validated['address'] ?? '-',

                'work_area'  => $validated['work_area'] ?? null,

                'role'       => $validated['role'],

                'verification_status' => 'pending',

                'ktp'        => $ktpPath,
                'skck'       => $skckPath,

                'password'   => Hash::make($validated['password']),

                'email_otp'  => $otp,
                'otp_expired_at' => now()->addMinutes(10),
            ]);

            // =====================
            // SEND OTP EMAIL
            // =====================
            Mail::to($user->email)
                ->send(new SendOtpMail($otp));

            session([
                'verify_user_id' => $user->id
            ]);

            DB::commit();

            return redirect()->route('verify.notice');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Registrasi gagal: '.$e->getMessage());
        }
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required','digits:6']
        ]);

        $user = User::find(session('verify_user_id'));

        // =====================
        // VALIDASI USER
        // =====================
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

        // =====================
        // UPDATE VERIFIKASI
        // =====================
        $user->update([
            'email_verified_at' => now(),
            'email_otp' => null,
            'otp_expired_at' => null,

            // 🔥 LOGIC BARU
            'verification_status' => $user->role === 'terapis'
                ? 'pending'
                : 'approved',
        ]);

        // =====================
        // 🔥 AUTO LOGIN (KUNCI FIX ERROR)
        // =====================
        Auth::login($user);

        // OPTIONAL: regenerate session (security best practice)
        $request->session()->regenerate();

        session()->forget('verify_user_id');

        // =====================
        // REDIRECT BERDASARKAN ROLE
        // =====================
        if ($user->role === 'terapis') {
            return redirect()
                ->route('therapist.assessment')
                ->with('success','Email terverifikasi, silakan lengkapi profil terapis');
        }

        return redirect()
            ->route('login') // atau dashboard kalau mau langsung login user
            ->with('success','Email berhasil diverifikasi');
    }
}