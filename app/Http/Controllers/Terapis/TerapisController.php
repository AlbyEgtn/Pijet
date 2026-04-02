<?php

namespace App\Http\Controllers\Terapis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Terapis;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction;

class TerapisController extends Controller
{

    public function dashboard()
    {
        $user = auth()->user();
        $terapis = $user->terapis;

        $transactions = \App\Models\Transaction::with('services')

            ->where('payment_status', 'verified')   // sudah bayar
            ->where('order_status', 'ready')        // siap diambil
            ->whereNull('terapis_id')               // belum diambil

            ->when($user->city, function($q) use ($user){
                $q->where('customer_city', $user->city->name);
            })

            ->latest()
            ->take(5)
            ->get();

        return view('pages.terapis.dashboard', compact(
            'user',
            'terapis',
            'transactions'
        ));
    }

    public function pesanan()
    {
        $user = Auth::user();
        $terapis = $user->terapis;

        // 🔥 optional: bisa difilter kalau mau
        $transactions = Transaction::latest()->get();

        return view('pages.terapis.pesanan', compact('user','terapis','transactions'));
    }


    public function detailPesanan($id)
    {
        $user = Auth::user();
        $terapis = $user->terapis;

        $transaction = Transaction::with(['services','customer'])
            ->findOrFail($id);

        return view('pages.terapis.pesanan_detail', compact('user','terapis','transaction'));
    }


    public function ambilPesanan($id)
    {
        $user = auth()->user();

        if (!$user->terapis) {
            return back()->with('error', 'Data terapis belum tersedia');
        }

        $updated = Transaction::where('id', $id)
            ->where('payment_status', 'lunas') // 🔥 FIX
            ->whereNull('terapis_id') // 🔥 biar gak rebutan
            ->update([
                'order_status' => 'proses',
                'terapis_id' => $user->terapis->id
            ]);

        if (!$updated) {
            return back()->with('error', 'Pesanan tidak tersedia atau sudah diambil');
        }

        return redirect()->route('terapis.pesanan.saya')
            ->with('success', 'Pesanan berhasil diambil');
    }


    public function pesananSaya()
    {
        $user = auth()->user();

        if (!$user->terapis) {
            return back()->with('error', 'Data terapis tidak ditemukan');
        }

        $transactions = Transaction::where('terapis_id', $user->terapis->id)
            ->latest()
            ->get();

        return view('pages.terapis.pesanan_saya', compact('transactions'));
    }


    public function detailPesananSaya($id)
    {
        $user = auth()->user();

        if (!$user->terapis) {
            return back()->with('error', 'Data terapis tidak ditemukan');
        }

        $transaction = Transaction::where('id', $id)
            ->where('terapis_id', $user->terapis->id) // 🔒 security
            ->with(['services','customer'])
            ->firstOrFail();

        return view('pages.terapis.pesanan_saya_detail', compact('transaction'));
    }


    public function detail()
    {
        $user = Auth::user();
        $terapis = $user->terapis;

        return view('pages.terapis.profile_detail', compact('user','terapis'));
    }


    public function pedoman()
    {
        return view('pages.terapis.pedoman');
    }


    public function bantuan()
    {
        return view('pages.terapis.bantuan');
    }


    public function profile()
    {
        $user = Auth::user();

        $terapis = Terapis::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nik' => '',
                'gender' => '',
                'whatsapp' => '',
                'address' => '',
                'bank_account' => '',
                'total_orders' => 0,
                'balance' => 0,
                'status' => 1
            ]
        );

        return view('pages.terapis.profile', compact('user','terapis'));
    }


    public function update(Request $request)
    {
        Terapis::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'nik' => $request->nik,
                'gender' => $request->gender,
                'whatsapp' => $request->whatsapp,
                'address' => $request->address,
                'bank_name' => $request->bank_name,
                'bank_number' => $request->bank_number
            ]
        );

        return redirect()->back()->with('success','Data berhasil diupdate');
    }


    public function confirmPassword()
    {
        return view('pages.terapis.confirm_password');
    }


    public function informasi()
    {
        if(!session('informasi_verified')){
            return redirect()->route('terapis.informasi.confirm');
        }

        $user = auth()->user();
        $terapis = $user->terapis;

        return view('pages.terapis.informasi',compact('user','terapis'));
    }


    public function updateInformasi(Request $request)
    {
        $terapis = auth()->user()->terapis;

        $terapis->update([
            'status' => $request->status
        ]);

        return back()->with('success','Informasi berhasil diperbarui');
    }


    public function checkPassword(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        if(Hash::check($request->password, auth()->user()->password)){
            return redirect()->route('terapis.detail');
        }

        return back()->with('error','Password salah');
    }


    public function confirmInformasi()
    {
        return view('pages.terapis.confirm_informasi');
    }


    public function checkInformasiPassword(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        if(Hash::check($request->password, auth()->user()->password)){
            session(['informasi_verified' => true]);
            return redirect()->route('terapis.informasi');
        }

        return back()->with('error','Password salah');
    }


    public function passwordForm()
    {
        return view('pages.terapis.ganti_password');
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        if(!Hash::check($request->current_password, Auth::user()->password)){
            return back()->with('error','Password saat ini salah');
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success','Password berhasil diperbarui');
    }

}