<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('pages.customer.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'       => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender'     => 'nullable|in:L,P',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ktp'  => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // UPDATE DATA
        $user->update([
            'name'       => $request->name,
            'phone'      => $request->phone,
            'address'    => $request->address,
            'birth_date' => $request->birth_date,
            'gender'     => $request->gender,
        ]);

        // UPLOAD FOTO
        if ($request->hasFile('foto')) {

            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            $user->foto = $request->file('foto')
                ->store('profile', 'public');
        }

        // UPLOAD KTP
        if ($request->hasFile('ktp')) {

            if ($user->ktp) {
                Storage::disk('public')->delete($user->ktp);
            }

            $user->ktp = $request->file('ktp')
                ->store('ktp', 'public');
        }

        $user->save();

        return back()->with('success','Profil berhasil diperbarui');
    }
}