<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Terapis;
use App\Models\TherapistReview;
use Illuminate\Support\Facades\Hash;

class TherapistController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST TERAPIS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = User::with([
                    'therapistProfile.city'
                ])

                ->withAvg(
                    'reviewsReceived',
                    'rating'
                )

                ->withCount(
                    'reviewsReceived'
                )

                ->where('role', 'terapis')
                ->where('verification_status', 'approved');


        // ================= SEARCH =================

        if ($request->search) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }


        // ================= DATA =================

        $therapists = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        // ================= STATS =================

        $totalTherapist = User::where('role', 'terapis')
            ->where('verification_status', 'approved')
            ->count();

        $totalVerified = User::where('role', 'terapis')
            ->where('verification_status', 'approved')
            ->count();

        $avgRating = round(
            User::where('role', 'terapis')
                ->withAvg('reviewsReceived', 'rating')
                ->get()
                ->avg('reviews_received_avg_rating') ?? 0,
            1
        );


        return view(
            'pages.admin.therapist.index',
            compact(
                'therapists',
                'totalTherapist',
                'totalVerified',
                'avgRating'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('pages.admin.therapist.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
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

            'password' => Hash::make('password123'),

            'role'   => 'terapis',

            'verification_status' => 'approved',

            'verified_at' => now(),

        ]);


        return redirect()
            ->route('admin.therapist.index')
            ->with(
                'success',
                'Terapis berhasil ditambahkan'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $therapist = User::where(
                'role',
                'terapis'
            )

            ->with([
                'therapistProfile.city'
            ])

            ->findOrFail($id);


        return view(
            'pages.admin.therapist.edit',
            compact('therapist')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $therapist = User::where(
                'role',
                'terapis'
            )

            ->findOrFail($id);


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


        return redirect()
            ->route('admin.therapist.index')
            ->with(
                'success',
                'Data therapist berhasil diperbarui'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $therapist = User::where(
                'role',
                'terapis'
            )

            ->findOrFail($id);


        $therapist->delete();


        return back()->with(
            'success',
            'Data therapist berhasil dihapus'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | VERIFICATION PAGE
    |--------------------------------------------------------------------------
    */

    public function verification(Request $request)
    {
        $query = User::with([
                    'therapistProfile.city'
                ])

                ->where('role', 'terapis')
                ->where('verification_status', 'pending');


        // ================= SEARCH =================

        if ($request->search) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')

                  ->orWhere('email', 'like', '%' . $search . '%')

                  ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }


        // ================= DATA =================

        $therapists = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        // ================= STATS =================

        $pendingVerification = User::where(
                'verification_status',
                'pending'
            )

            ->where('role', 'terapis')
            ->count();


        $approvedVerification = User::where(
                'verification_status',
                'approved'
            )

            ->where('role', 'terapis')
            ->count();


        $rejectedVerification = User::where(
                'verification_status',
                'rejected'
            )

            ->where('role', 'terapis')
            ->count();


        return view(
            'pages.admin.therapist.verification',
            compact(
                'therapists',
                'pendingVerification',
                'approvedVerification',
                'rejectedVerification'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | VERIFY THERAPIST
    |--------------------------------------------------------------------------
    */

    public function verify($id)
    {
        $user = User::with('terapis')

            ->where('role', 'terapis')

            ->findOrFail($id);


        $user->update([

            'verification_status' => 'approved',

            'verified_at' => now(),

            'verified_by' => auth()->id(),

            'reject_reason' => null

        ]);


        $exists = Terapis::where(
            'user_id',
            $user->id
        )->exists();


        if (!$exists) {

            Terapis::create([

                'user_id' => $user->id,

                'nik' => $user->nik,

                'gender' => $user->gender,

                'whatsapp' => $user->phone,

                'address' => $user->address,

                'bank_name' => null,

                'bank_number' => null,

                'account_holder' => null,

                'total_orders' => 0,

                'balance' => 0,

                'status' => true,

            ]);
        }


        return back()->with(
            'success',
            'Terapis berhasil diverifikasi'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REJECT THERAPIST
    |--------------------------------------------------------------------------
    */

    public function reject(Request $request, $id)
    {
        $request->validate([

            'reject_reason' => 'required|string|max:255'

        ]);


        $therapist = User::where(
                'role',
                'terapis'
            )

            ->findOrFail($id);


        $therapist->update([

            'verification_status' => 'rejected',

            'reject_reason' => $request->reject_reason

        ]);


        return back()->with(
            'success',
            'Terapis berhasil ditolak'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REVIEW PAGE
    |--------------------------------------------------------------------------
    */

    public function review(Request $request)
    {
        $query = User::with([

                'therapistProfile.city'

            ])

            ->withAvg(
                'reviewsReceived',
                'rating'
            )

            ->withCount(
                'reviewsReceived'
            )

            ->where(
                'role',
                'terapis'
            );


        // ================= SEARCH =================

        if ($request->search) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')

                  ->orWhere('email', 'like', '%' . $search . '%')

                  ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }


        // ================= FILTER RATING =================

        if ($request->rating) {

            $query->whereHas(
                'reviewsReceived',
                function ($q) use ($request) {

                    $q->where(
                        'rating',
                        $request->rating
                    );
                }
            );
        }


        // ================= DATA =================

        $therapists = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        // ================= STATS =================

        $totalReview = TherapistReview::count();

        $avgRating = round(
            TherapistReview::avg('rating') ?? 0,
            1
        );


        $bestTherapist = User::withAvg(
                'reviewsReceived',
                'rating'
            )

            ->withCount(
                'reviewsReceived'
            )

            ->where(
                'role',
                'terapis'
            )

            ->orderByDesc(
                'reviews_received_avg_rating'
            )

            ->first();


        return view(
            'pages.admin.therapist.review',
            compact(
                'therapists',
                'totalReview',
                'avgRating',
                'bestTherapist'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW DETAIL THERAPIST
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $therapist = User::with([

                'therapistProfile.city',
                'reviewsReceived.customer'

            ])

            ->withAvg(
                'reviewsReceived',
                'rating'
            )

            ->withCount(
                'reviewsReceived'
            )

            ->where(
                'role',
                'terapis'
            )

            ->findOrFail($id);


        return view(
            'pages.admin.therapist.show',
            compact('therapist')
        );
    }
}