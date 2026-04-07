<?php

namespace App\Http\Controllers\Terapis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Terapis;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction;
use App\Models\PaymentAccount;
use Illuminate\Support\Facades\DB;

class TerapisController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

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

        $transactions = Transaction::with('services')
            ->where('payment_status', 'verified')
            ->where('order_status', 'ready')
            ->whereNull('terapis_id')
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

        if (!$terapis) {
            return back()->with('error', 'Data terapis tidak ditemukan');
        }

        $transactions = Transaction::with('services')
            ->where('payment_status', 'verified')
            ->where('order_status', 'ready')
            ->whereNull('terapis_id')
            ->latest()
            ->paginate(10);

        return view('pages.terapis.pesanan', compact(
            'user',
            'terapis',
            'transactions'
        ));
    }

    public function ambilPesanan($id)
    {
        $user = auth()->user();

        if (!$user->terapis) {
            return back()->with('error', 'Data terapis belum tersedia');
        }

        $updated = Transaction::where('id', $id)
            ->where('payment_status', 'verified')
            ->where('order_status', 'ready')
            ->whereNull('terapis_id')
            ->update([
                'order_status' => 'assigned',
                'terapis_id' => $user->terapis->id
            ]);

        if (!$updated) {
            return back()->with('error', 'Pesanan tidak tersedia');
        }

        return redirect()->route('terapis.pesanan.saya')
            ->with('success', 'Pesanan berhasil diambil');
    }

    public function pesananSaya(Request $request)
    {
        $user = auth()->user();

        if (!$user->terapis) {
            return back()->with('error', 'Data terapis tidak ditemukan');
        }

        $query = Transaction::where('terapis_id', $user->terapis->id);

        if ($request->status) {
            $query->where('order_status', $request->status);
        }

        $transactions = $query->latest()->get();

        return view('pages.terapis.pesanan_saya', compact('transactions'));
    }

    public function detailPesananSaya($id)
    {
        $user = auth()->user();

        if (!$user->terapis) {
            return back()->with('error', 'Data terapis tidak ditemukan');
        }

        $transaction = Transaction::where('id', $id)
            ->where('terapis_id', $user->terapis->id)
            ->with(['services','customer'])
            ->firstOrFail();

        return view('pages.terapis.pesanan_saya_detail', compact('transaction'));
    }

    public function batalkanPesanan(Request $request, $id)
    {
        $trx = Transaction::findOrFail($id);

        $trx->update([
            'order_status' => 'cancelled',
            'cancel_reason' => $request->reason . ' - ' . $request->note
        ]);

        return back()->with('success','Pesanan dibatalkan');
    }

    public function mulaiPesanan($id)
    {
        $user = auth()->user();

        $transaction = Transaction::where('id', $id)
            ->where('terapis_id', $user->terapis->id)
            ->where('order_status', 'assigned')
            ->firstOrFail();

        $transaction->update([
            'order_status' => 'ongoing',
            'started_at' => now()
        ]);

        return back()->with('success', 'Layanan dimulai');
    }

    public function selesaiPesanan($id)
    {
        $user = auth()->user();

        $transaction = Transaction::where('id', $id)
            ->where('terapis_id', $user->terapis->id)
            ->where('order_status', 'ongoing')
            ->firstOrFail();

        $transaction->update([
            'order_status' => 'completed',
            'completed_at' => now()
        ]);

        return back()->with('success', 'Pesanan selesai');
    }

    public function profile()
    {
        $user = Auth::user();
        $terapis = $user->terapis;

        $accounts = PaymentAccount::where('terapis_id', $terapis->id)->get();

        return view('pages.terapis.profile', compact(
            'user',
            'terapis',
            'accounts'
        ));
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

        return back()->with('success','Data berhasil diupdate');
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