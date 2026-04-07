<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TherapistProfile;
use Illuminate\Support\Facades\Auth;

class TherapistAssessmentController extends Controller
{
    public function index()
    {
        return view('auth.therapist_assessment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'experience_years' => 'required|integer',
            'skills' => 'required|string',
            'certifications' => 'required|string',
            'handle_special_condition' => 'required|boolean',

            'work_days' => 'required|string',
            'work_hours' => 'required|string',
            'is_mobile' => 'required|boolean',
            'coverage_area' => 'required|string',
        ]);

        TherapistProfile::create([
            'user_id' => Auth::id(),

            'experience_years' => $request->experience_years,
            'skills' => $request->skills,
            'certifications' => $request->certifications,
            'handle_special_condition' => $request->handle_special_condition,

            'work_days' => $request->work_days,
            'work_hours' => $request->work_hours,
            'is_mobile' => $request->is_mobile,
            'coverage_area' => $request->coverage_area,
        ]);

        return redirect('/login')->with('success','Berhasil registrasi, tunggu informasi selanjutnya dari email anda');
    }
}