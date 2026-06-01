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

            if ($request->role === 'customer') {

                $rules['address'] = ['required','string'];

            } else { // TERAPIS

                $rules['ktp']  = ['required','file','mimes:jpg,png,pdf','max:2048'];
                $rules['skck'] = ['required','file','mimes:jpg,png,pdf','max:2048'];

                $rules['address'] = ['nullable','string'];
            }

            $messages = [

                'nik.required' => 'NIK wajib diisi',
                'nik.digits_between' => 'NIK harus 16 digit',

                'name.required' => 'Nama wajib diisi',

                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',

                'phone.required' => 'Nomor telepon wajib diisi',

                'gender.required' => 'Jenis kelamin wajib dipilih',

                'birth_date.required' => 'Tanggal lahir wajib diisi',

                'city_id.required' => 'Area kerja wajib dipilih',

                'password.required' => 'Password wajib diisi',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
                'password.min' => 'Password minimal 6 karakter',

                'ktp.required' => 'File KTP wajib diupload',
                'ktp.mimes' => 'KTP harus JPG, PNG, atau PDF',
                'ktp.max' => 'Ukuran KTP maksimal 2MB',

                'skck.required' => 'File SKCK wajib diupload',
                'skck.mimes' => 'SKCK harus JPG, PNG, atau PDF',
                'skck.max' => 'Ukuran SKCK maksimal 2MB',
            ];

            $validated = $request->validate($rules, $messages);

            $ktpPath = $request->hasFile('ktp')
                ? $request->file('ktp')->store('ktp','public')
                : null;

            $skckPath = $request->hasFile('skck')
                ? $request->file('skck')->store('skck','public')
                : null;

            $otp = rand(100000, 999999);

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

            try {
                Mail::to($user->email)->send(new SendOtpMail($otp));
            } catch (\Exception $mailError) {

                \Log::error('Mail error: '.$mailError->getMessage());
            }

            session([
                'verify_user_id' => $user->id
            ]);

            DB::commit();

            return redirect()->route('verify.notice');

            } catch (\Illuminate\Validation\ValidationException $e) {

                DB::rollBack();

                throw $e;

            } catch (\Exception $e) {

                DB::rollBack();

                \Log::error('Register error: '.$e->getMessage());

                return back()
                    ->withInput()
                    ->with('error', 'Terjadi kesalahan sistem, silakan coba lagi.');
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