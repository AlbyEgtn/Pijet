<?php

namespace App\Http\Controllers\Terapis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Terapis\Terapis;

class TerapisController extends Controller
{

    public function dashboard()
    {
        $user = Auth::user();
        $terapis = $user->terapis;

        return view('pages.terapis.dashboard', compact('user','terapis'));
    }

    public function profile()
    {

        $user = Auth::user();
        $terapis = $user->terapis;

        return view('terapis.profile', compact('user','terapis'));
    }


    public function detail()
    {

        $user = Auth::user();
        $terapis = $user->terapis;

        return view('terapis.profile_detail', compact('user','terapis'));
    }


    public function update(Request $request)
    {

        $terapis = Terapis::updateOrCreate(

            ['user_id' => Auth::id()],

            [
                'nik' => $request->nik,
                'gender' => $request->gender,
                'whatsapp' => $request->whatsapp,
                'address' => $request->address,
                'bank_account' => $request->bank_account
            ]
        );

        return redirect()->back()->with('success','Data berhasil diupdate');
    }

}