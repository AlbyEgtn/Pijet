<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Terapis;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;

class TherapistController extends Controller
{
    /**
     * ===============================
     * LIST DATA TERAPIS
     * ===============================
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'terapis')
                    ->where('verification_status', 'approved'); // ✅ FIX

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $therapists = $query->latest()->paginate(10)->withQueryString();

        return view('pages.admin.therapist.index', compact('therapists'));
    }

    /**
     * ===============================
     * FORM CREATE
     * ===============================
     */
    public function create()
    {
        return view('pages.admin.therapist.create');
    }


    /**
     * ===============================
     * STORE DATA
     * ===============================
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'gender' => 'required',
            'phone'  => 'required|max:20',
            'email'  => 'required|email|unique:users,email',
        ]);

        User::create([
            'name'   => $request->name,
            'gender' => $request->gender,
            'phone'  => $request->phone,
            'email'  => $request->email,
            'password' => Hash::make('password123'), // default password
            'role'   => 'terapis',
            'is_verified' => false
        ]);

        return redirect()->route('admin.therapist.index')
                         ->with('success', 'Terapis berhasil ditambahkan');
    }


    /**
     * ===============================
     * EDIT
     * ===============================
     */
    public function edit($id)
    {
        $therapist = User::where('role', 'terapis')->findOrFail($id);

        return view('pages.admin.therapist.edit', compact('therapist'));
    }


    /**
     * ===============================
     * UPDATE
     * ===============================
     */
    public function update(Request $request, $id)
    {
        $therapist = User::where('role', 'terapis')->findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'gender' => 'required',
            'phone'  => 'required|max:20',
            'email'  => 'required|email|unique:users,email,' . $id,
        ]);

        $therapist->update([
            'name'   => $request->name,
            'gender' => $request->gender,
            'phone'  => $request->phone,
            'email'  => $request->email,
        ]);

        return redirect()->route('admin.therapist.index')
                         ->with('success', 'Data berhasil diperbarui');
    }


    /**
     * ===============================
     * DELETE
     * ===============================
     */
    public function destroy($id)
    {
        $therapist = User::where('role', 'terapis')->findOrFail($id);

        $therapist->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }


    /**
     * ===============================
     * HALAMAN VERIFIKASI
     * ===============================
     */
    public function verification(Request $request)
    {
        $query = User::where('role', 'terapis')
                    ->where('verification_status', 'pending'); // ✅ FIX

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $therapists = $query->latest()->paginate(10)->withQueryString();

        return view('pages.admin.therapist.verification', compact('therapists'));
    }


    /**
     * ===============================
     * APPROVE TERAPIS
     * ===============================
     */
    public function verify($id)
    {
        $user = User::with('therapistProfile')->where('role', 'terapis')->findOrFail($id);

        // 1. Update status
        $user->update([
            'verification_status' => 'approved',
            'verified_at' => now(),
            'verified_by' => auth()->id(),
            'reject_reason' => null
        ]);

        // 2. Cegah duplicate (IMPORTANT 🔥)
        $exists = Terapis::where('user_id', $user->id)->exists();

        if (!$exists) {

            $profile = $user->therapistProfile;

            Terapis::create([
                'user_id' => $user->id,
                'nik' => $user->nik,
                'gender' => $user->gender,
                'whatsapp' => $user->phone,
                'address' => $user->address,
                'bank_account' => null, // nanti bisa diisi

                'total_orders' => 0,
                'balance' => 0,
                'status' => true, // aktif setelah approve
            ]);
        }

        return back()->with('success', 'Terapis berhasil diverifikasi & dimasukkan ke sistem');
    }


    /**
     * ===============================
     * REJECT TERAPIS
     * ===============================
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:255'
        ]);

        $therapist = User::where('role', 'terapis')->findOrFail($id);

        $therapist->update([
            'verification_status' => 'rejected',
            'reject_reason' => $request->reject_reason
        ]);

        return back()->with('success', 'Terapis ditolak');
    }


    /**
     * ===============================
     * REVIEW TERAPIS
     * ===============================
     */
    public function review()
    {
        $reviews = Review::with(['user']) // user = pemberi review
                         ->latest()
                         ->paginate(10);

        return view('pages.admin.therapist.review', compact('reviews'));
    }

    public function show($id)
    {
        $therapist = User::with('therapistProfile')->findOrFail($id);

        return view('pages.admin.therapist.show', compact('therapist'));
    }
}