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

        $terapis = \App\Models\Terapis::firstOrCreate(
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

        $transactions = \App\Models\Transaction::with('services')
            ->where('payment_status', 'verified')
            ->where('order_status', 'ready')
            ->whereNull('terapis_id')
            ->when(
                $user->city && $terapis->status == 1, // ✅ ONLINE ONLY
                function ($q) use ($user) {
                    $q->where('customer_city', $user->city->name);
                },
                function ($q) {
                    $q->whereRaw('1 = 0'); // ❌ OFFLINE / NO CITY → kosong
                }
            )
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

        // 🔒 STRICT RULE
        if (!$user->city) {
            return view('pages.terapis.pesanan', [
                'user' => $user,
                'terapis' => $terapis,
                'transactions' => collect()
            ])->with('error', 'Kota belum diset');
        }

        // 🔒 OFFLINE BLOCK
        if ($terapis->status != 1) {
            return view('pages.terapis.pesanan', [
                'user' => $user,
                'terapis' => $terapis,
                'transactions' => collect()
            ])->with('error', 'Status OFFLINE, tidak dapat melihat pesanan');
        }

        // 🔥 QUERY UTAMA (AVAILABLE ORDERS)
        $transactions = Transaction::with('services')
            ->where('payment_status', 'verified')     // hanya yang sudah bayar
            ->where('order_status', 'ready')          // siap diambil
            ->whereNull('terapis_id')                 // belum ada terapis
            ->where('customer_city', $user->city->name) // filter kota
            ->latest()
            ->paginate(10); // 🔥 lebih proper dari get()

        return view('pages.terapis.pesanan', compact(
            'user',
            'terapis',
            'transactions'
        ));
    }


    public function detailPesanan($id)
    {
        $user = Auth::user();
        $terapis = $user->terapis;

        if (!$terapis) {
            return back()->with('error', 'Data terapis tidak ditemukan');
        }

        $transaction = Transaction::with(['services','customer'])
            ->findOrFail($id);

        return view('pages.terapis.pesanan_detail', compact(
            'user',
            'terapis',
            'transaction'
        ));
    }


    public function ambilPesanan($id)
    {
        $user = auth()->user();

        if (!$user->terapis) {
            return back()->with('error', 'Data terapis belum tersedia');
        }

        // 🔒 WAJIB ONLINE
        if ($user->terapis->status != 1) {
            return back()->with('error', 'Status OFFLINE, tidak bisa mengambil pesanan');
        }

        // 🔒 WAJIB ADA KOTA
        if (!$user->city) {
            return back()->with('error', 'Kota belum diset');
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
            return back()->with('error', 'Pesanan tidak tersedia atau sudah diambil');
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

        // 🔒 OFFLINE → tidak boleh akses
        if ($user->terapis->status != 1) {
            return view('pages.terapis.pesanan_saya', [
                'transactions' => collect()
            ])->with('error', 'Status OFFLINE, tidak dapat mengakses pesanan');
        }

        // 🔒 CITY WAJIB
        if (!$user->city) {
            return view('pages.terapis.pesanan_saya', [
                'transactions' => collect()
            ])->with('error', 'Kota belum diset');
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

        // ❗ STRICT MODE
        if (!$user->city) {
            return back()->with('error', 'Kota belum diset');
        }

        $transaction = Transaction::where('id', $id)
            ->where('terapis_id', $user->terapis->id)
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
        $terapis = $user->terapis;

        // ✅ hanya berdasarkan relasi
        $terapisAccounts = PaymentAccount::where('terapis_id', $terapis->id)->get();

        // ❌ HAPUS companyAccounts (karena tidak ada field type)
        $companyAccounts = collect(); // biar blade tidak error

        return view('pages.terapis.profile', compact(
            'user',
            'terapis',
            'terapisAccounts',
            'companyAccounts'
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

    public function mulaiPesanan($id)
    {
        $user = auth()->user();

        $transaction = Transaction::where('id', $id)
            ->where('terapis_id', $user->terapis->id)
            ->where('order_status', 'assigned')
            ->firstOrFail();

        $transaction->update([
            'order_status' => 'ongoing',
            'started_at' => now() // 🔥 TAMBAH INI
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
            'completed_at' => now() // 🔥 TAMBAH INI
        ]);

        return back()->with('success', 'Pesanan selesai');
    }

    public function batalPesanan($id)
    {
        $user = auth()->user();

        $transaction = Transaction::where('id', $id)
            ->where('terapis_id', $user->terapis->id)
            ->whereIn('order_status', ['assigned','on_the_way'])
            ->firstOrFail();

        $transaction->update([
            'order_status' => 'cancelled'
            // ❌ JANGAN HAPUS TERAPIS
        ]);

        return back()->with('success', 'Pesanan dibatalkan');
    }

    public function paymentAccounts()
    {
        $user = auth()->user();
        $terapis = $user->terapis;

        if (!$terapis) {
            return back()->with('error', 'Data terapis tidak ditemukan');
        }

        $accounts = $terapis->paymentAccounts()->latest()->get();

        return view('pages.terapis.payment_accounts', compact('terapis','accounts'));
    }

    public function storePaymentAccount(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:100',
            'account_holder' => 'required|string|max:100',
            'account_number' => 'required|digits_between:8,20',
        ]);

        $terapis = auth()->user()->terapis;

        DB::transaction(function () use ($request, $terapis) {

            $isFirst = $terapis->paymentAccounts()->count() == 0;

            $terapis->paymentAccounts()->create([
                'type' => 'terapis', // 🔥 WAJIB
                'terapis_id' => $terapis->id, // 🔥 WAJIB
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'account_holder' => $request->account_holder,
                'is_active' => $isFirst ? true : false,
            ]);
        });

        return back()->with('success','Rekening berhasil ditambahkan');
    }

    public function setActivePaymentAccount($id)
    {
        $user = auth()->user();
        $terapis = $user->terapis;

        $account = $terapis->paymentAccounts()->where('id', $id)->firstOrFail();

        DB::transaction(function () use ($terapis, $account) {
            // non-aktifkan semua
            $terapis->paymentAccounts()->update(['is_active' => false]);
            // aktifkan yang dipilih
            $account->update(['is_active' => true]);
        });

        return back()->with('success', 'Rekening aktif diperbarui');
    }

    public function deletePaymentAccount($id)
    {
        $user = auth()->user();
        $terapis = $user->terapis;

        $account = $terapis->paymentAccounts()->where('id', $id)->firstOrFail();

        // jika yang dihapus aktif → pilih salah satu lain jadi aktif (jika ada)
        DB::transaction(function () use ($terapis, $account) {
            $wasActive = $account->is_active;
            $account->delete();

            if ($wasActive) {
                $next = $terapis->paymentAccounts()->first();
                if ($next) {
                    $next->update(['is_active' => true]);
                }
            }
        });

        return back()->with('success', 'Rekening dihapus');
    }

}