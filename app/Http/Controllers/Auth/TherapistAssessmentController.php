<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TherapistProfile;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

class TherapistAssessmentController extends Controller
{
    public function index()
    {
        $cities = City::orderBy('name')->get();

        return view('auth.therapist_assessment', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([

            // ======================
            // KEMAMPUAN
            // ======================

            'experience_years' => [
                'required',
                'integer',
                'min:0',
                'max:60'
            ],

            'skills' => [
                'required',
                'string',
                'regex:/^[A-Za-z\s,.\-]+$/'
            ],

            'certifications' => [
                'required',
                'string',
                'regex:/^[A-Za-z\s,.\-]+$/'
            ],

            'handle_special_condition' => [
                'required',
                'boolean'
            ],

            // ======================
            // KETERSEDIAAN
            // ======================

            'work_days' => [
                'required',
                'array',
                'min:1'
            ],

            'work_days.*' => [
                'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'
            ],

            'work_shifts' => [
                'required',
                'array',
                'min:1'
            ],

            'work_shifts.*' => [
                'in:shift_1,shift_2,shift_3'
            ],

            // ======================
            // KOTA
            // ======================

            'city_id' => [
                'required',
                'exists:cities,id'
            ],
        ], [

            // CUSTOM MESSAGE
            'experience_years.integer' =>
                'Pengalaman harus berupa angka.',

            'skills.regex' =>
                'Teknik pijat hanya boleh huruf.',

            'certifications.regex' =>
                'Sertifikasi hanya boleh huruf.',

            'end_work_hour.after' =>
                'Jam selesai harus lebih besar dari jam mulai.',

            'experience_years.required' =>
                'Pengalaman wajib diisi.',

            'experience_years.min' =>
                'Pengalaman tidak valid.',

            'skills.required' =>
                'Teknik pijat wajib diisi.',

            'certifications.required' =>
                'Sertifikasi wajib diisi.',

            'handle_special_condition.required' =>
                'Pilih kemampuan kondisi khusus.',

            'work_days.required' =>
                'Pilih minimal 1 hari kerja.',

            'work_shifts.required' =>
                'Pilih minimal 1 shift kerja.',

            'city_id.required' =>
                'Kota jangkauan wajib dipilih.',
        ]);

        

        TherapistProfile::create([

            'user_id' => Auth::id(),

            // kemampuan
            'experience_years' => $request->experience_years,
            'skills' => $request->skills,
            'certifications' => $request->certifications,
            'handle_special_condition' => $request->handle_special_condition,

            // ketersediaan
            'work_days' => $request->work_days,
            'work_shifts' => $request->work_shifts,

            // kota
            'city_id' => $request->city_id,
        ]);

        return redirect('/login')->with(
            'success',
            'Berhasil registrasi, tunggu informasi selanjutnya melalui email anda'
        );
    }
}