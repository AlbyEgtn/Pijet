<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Therapist;
use App\Models\Review;
use Illuminate\Support\Str;

class TherapistController extends Controller
{
    /**
     * List data + search
     */
    public function index(Request $request)
    {
        $query = Therapist::query();

        // 🔍 Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('code', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $therapists = $query->latest()
                            ->paginate(10)
                            ->withQueryString(); // ✅ preserve search

        return view('pages.therapist.index', compact('therapists'));
    }

    /**
     * Form create
     */
    public function create()
    {
        return view('pages.therapist.create'); // ✅ konsisten
    }

    /**
     * Store data
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'gender' => 'required',
            'phone'  => 'required|max:20',
            'email'  => 'required|email|unique:therapists,email'
        ]);

        Therapist::create([
            'code'   => 'TRS-' . strtoupper(Str::random(6)), // ✅ lebih aman
            'name'   => $request->name,
            'gender' => $request->gender,
            'phone'  => $request->phone,
            'email'  => $request->email,
            'is_verified' => false // default
        ]);

        return redirect()->route('admin.therapist.index') // ✅ FIX
                         ->with('success', 'Terapis berhasil ditambahkan');
    }

    /**
     * Edit
     */
    public function edit($id)
    {
        $therapist = Therapist::findOrFail($id);

        return view('pages.therapist.edit', compact('therapist'));
    }

    /**
     * Update
     */
    public function update(Request $request, $id)
    {
        $therapist = Therapist::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'gender' => 'required',
            'phone'  => 'required|max:20',
            'email'  => 'required|email|unique:therapists,email,' . $id
        ]);

        $therapist->update([
            'name'   => $request->name,
            'gender' => $request->gender,
            'phone'  => $request->phone,
            'email'  => $request->email,
        ]);

        return redirect()->route('admin.therapist.index') // ✅ FIX
                         ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Delete
     */
    public function destroy($id)
    {
        $therapist = Therapist::findOrFail($id);

        // ⚠️ Optional: soft delete recommended
        $therapist->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    /**
     * Halaman verifikasi
     */
    public function verification(Request $request)
    {
        $query = Therapist::query();

        // 🔍 Optional filter status
        if ($request->status == 'pending') {
            $query->where('is_verified', false);
        } elseif ($request->status == 'verified') {
            $query->where('is_verified', true);
        }

        $therapists = $query->latest()
                            ->paginate(10)
                            ->withQueryString();

        return view('pages.therapist.verification', compact('therapists')); // ✅ FIX PATH
    }

    /**
     * Approve
     */
    public function verify($id)
    {
        $therapist = Therapist::findOrFail($id);

        $therapist->update([
            'is_verified' => true
        ]);

        return back()->with('success', 'Terapis berhasil diverifikasi');
    }

    /**
     * Reject (NON-DESTRUCTIVE)
     */
    public function reject(Request $request, $id)
    {
        $therapist = Therapist::findOrFail($id);

        $request->validate([
            'reject_reason' => 'nullable|string|max:255'
        ]);

        // ✅ jangan delete → update status
        $therapist->update([
            'is_verified' => false,
            'reject_reason' => $request->reject_reason
        ]);

        return back()->with('success', 'Terapis ditolak');
    }

    /**
     * Halaman review
     */
    public function review()
    {
        $reviews = Review::with(['therapist','user'])
                        ->latest()
                        ->paginate(10);

        return view('pages.therapist.review', compact('reviews')); // ✅ FIX PATH
    }
}