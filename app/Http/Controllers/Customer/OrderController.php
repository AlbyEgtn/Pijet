<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Transaction;
use App\Models\Payment;
use App\Models\PaymentAccount;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\WalletTransaction;


class OrderController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | ORDER LIST
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $status = $request->status ?? 'belum_lunas';

        $orders = Transaction::with('services')
            ->where('customer_id', Auth::id())

            ->when($status === 'belum_lunas', function ($q) {
                $q->whereIn('payment_status', ['pending','uploaded']);
            })

            ->when($status === 'diproses', function ($q) {
                $q->whereIn('order_status', [
                    'ready',
                    'assigned',
                    'on_the_way',
                    'ongoing'
                ]);
            })

            ->when($status === 'selesai', function ($q) {
                $q->where('order_status', 'completed');
            })

            ->when($status === 'dibatalkan', function ($q) {
                $q->where('order_status', 'cancelled');
            })

            ->latest()
            ->get();

        return view('pages.customer.orders.index', compact('orders','status'));
    }


    /*
    |--------------------------------------------------------------------------
    | ORDER DETAIL
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $order = Transaction::with('services')->findOrFail($id);

        $accounts = PaymentAccount::where('is_active', true)
            ->where('type', 'company')
            ->get();

        return view('pages.customer.orders.show', [
            'order'    => $order,
            'accounts' => $accounts
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | PROCESS PAYMENT METHOD
    |--------------------------------------------------------------------------
    */

    public function payment(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,transfer',
            'bank'           => 'required_if:payment_method,transfer'
        ]);

        $order = Transaction::where('customer_id', Auth::id())
            ->findOrFail($id);

        $order->payment_method = $request->payment_method;
        $order->payment_status = 'pending';
        $order->order_status   = 'waiting';

        // ================= CASH =================
        if ($request->payment_method === 'cash') {
            $order->payment_status     = 'verified';
            $order->order_status       = 'ready';
            $order->payment_expired_at = null;
            $order->save();

            return response()->json([
                'success'  => true,
                'redirect' => route('customer.orders.show', $order->id)
            ]);
        }

        // ================= TRANSFER =================
        $banks = [
            'BCA'     => ['account_number' => '4272022855', 'account_holder' => 'PT Pijetin Indonesia'],
            'BRI'     => ['account_number' => '1129987710', 'account_holder' => 'PT Pijetin Indonesia'],
            'BNI'     => ['account_number' => '8892210092', 'account_holder' => 'PT Pijetin Indonesia'],
            'MANDIRI' => ['account_number' => '1338842291', 'account_holder' => 'PT Pijetin Indonesia'],
        ];

        if (!isset($banks[$request->bank])) {
            return response()->json([
                'success' => false,
                'message' => 'Bank tidak valid'
            ], 422);
        }

        if (!$order->payment_expired_at) {
            $order->payment_expired_at = now()->addHours(24);
        }

        $order->save();

        $bank = $banks[$request->bank];

        Payment::updateOrCreate(
            ['transaction_id' => $order->id],
            [
                'bank_name'      => $request->bank,
                'account_number' => $bank['account_number'],
                'account_holder' => $bank['account_holder'],
            ]
        );

        return response()->json([
            'success'  => true,
            'redirect' => route('customer.payment', $order->id)
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT PAGE
    |--------------------------------------------------------------------------
    */

    public function detailPage($id)
    {
        $order = Transaction::with(['services'])
            ->where('customer_id', Auth::id())
            ->findOrFail($id);

        // 🔥 CEK STATUS PEMBAYARAN
        $isPending = in_array($order->payment_status, ['pending','uploaded']);

        if ($isPending) {
            return redirect()->route('customer.payment', $order->id);
        }

        // 🔥 HALAMAN TRACKING
        return view('pages.customer.orders.detail', [
            'order' => $order
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | UPLOAD BUKTI BAYAR
    |--------------------------------------------------------------------------
    */

    public function uploadPaymentProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $order = Transaction::where('customer_id', auth()->id())
            ->findOrFail($id);

        if ($order->payment_method !== 'transfer') {
            return back()->with('error', 'Metode pembayaran tidak valid');
        }

        if ($order->payment_proof) {
            \Storage::disk('public')->delete($order->payment_proof);
        }

        $file     = $request->file('payment_proof');
        $filename = 'payment_' . $order->transaction_code . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path     = $file->storeAs('payment_proofs', $filename, 'public');

        $order->payment_proof       = $path;
        $order->payment_uploaded_at = now();
        $order->payment_status      = 'uploaded';
        $order->save();

        return redirect()
            ->route('customer.payment', $order->id)
            ->with('success', 'Bukti pembayaran berhasil diupload');
    }


    /*
    |--------------------------------------------------------------------------
    | KONFIRMASI PEMBAYARAN (MANUAL)
    | Customer klik tombol → sistem cek wallet_transactions
    | Jika ada record income → status otomatis diupdate ke verified
    |--------------------------------------------------------------------------
    */

    public function snapToken($id)
    {
        $order = Transaction::findOrFail($id);

        // 🔥 VALIDASI PENTING
        if(!$order->midtrans_order_id){
            return response()->json([
                'error' => 'Order ID Midtrans belum dibuat'
            ], 400);
        }

        // 🔥 SET CONFIG (INI YANG KURANG)
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        try {

            $params = [
                'transaction_details' => [
                    'order_id'     => $order->midtrans_order_id,
                    'gross_amount' => (int) $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => $order->customer_name,
                    'phone'      => $order->customer_phone,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'snap_token' => $snapToken
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);

        }
    }

    public function confirmPayment($id)
    {
        $order = Transaction::findOrFail($id);

        // 🔥 CEK SUDAH ADA WALLET ATAU BELUM
        $existing = WalletTransaction::where('reference_id', $order->id)
            ->where('reference_type', 'transaction')
            ->first();

        if ($existing) {
            return response()->json([
                'success' => true,
                'message' => 'Pembayaran sudah diverifikasi'
            ]);
        }

        DB::transaction(function () use ($order) {

            // 🔥 AMBIL ACCOUNT (misal company account)
            $account = PaymentAccount::where('type', 'company')
                ->where('is_active', 1)
                ->first();

            if (!$account) {
                throw new \Exception('Payment account tidak ditemukan');
            }

            // 🔥 INSERT WALLET
            WalletTransaction::create([
                'payment_account_id' => $account->id,
                'type' => 'income',
                'amount' => $order->total_price,
                'reference_type' => 'transaction',
                'reference_id' => $order->id,
                'description' => 'Pembayaran Order #' . $order->id,
            ]);

            // 🔥 UPDATE STATUS
            $order->update([
                'payment_status' => 'verified',
                'order_status'   => 'ready'
            ]);

        });

        return redirect()->route('customer.orders.detail', $order->id);
    }

    public function status($id)
    {
        $order = Transaction::findOrFail($id);

        return response()->json([
            'payment_status' => $order->payment_status,
            'order_status'   => $order->order_status,
        ]);
    }

    public function cancel(Request $request, $id)
    {
        $request->validate([
            'cancel_reason' => 'required|string|max:255'
        ]);

        $order = Transaction::where('customer_id', auth()->id())
            ->findOrFail($id);

        // ❗ HARD RULE
        if (!in_array($order->order_status, ['waiting','ready','assigned'])) {
            return back()->with('error', 'Pesanan tidak bisa dibatalkan');
        }

        DB::transaction(function () use ($order, $request) {

            /*
            |--------------------------------------------------
            | REFUND LOGIC (ONLY IF VERIFIED)
            |--------------------------------------------------
            */
            if ($order->payment_status === 'verified') {

                $account = PaymentAccount::where('type', 'company')
                    ->where('is_active', 1)
                    ->first();

                WalletTransaction::create([
                    'payment_account_id' => $account->id,
                    'type' => 'expense',
                    'amount' => $order->total_price,
                    'reference_type' => 'refund',
                    'reference_id' => $order->id,
                    'description' => 'Refund pembatalan Order #' . $order->transaction_code,
                ]);
            }

            /*
            |--------------------------------------------------
            | UPDATE ORDER
            |--------------------------------------------------
            */
            $order->update([
                'order_status'   => 'cancelled',
                'cancel_reason'  => $request->cancel_reason,
                'expired_at'     => now(),
                'is_company_paid'=> false
            ]);

        });

        return redirect()->route('customer.orders')
            ->with('success', 'Pesanan berhasil dibatalkan');
    }

    public function reschedule(Request $request, $id)
    {
        $request->validate([
            'new_date' => 'required|date|after:today',
            'new_time' => 'required'
        ]);

        $order = Transaction::where('customer_id', auth()->id())
            ->findOrFail($id);

        // ❗ HARD RULE
        if (!in_array($order->order_status, ['waiting','ready','assigned'])) {
            return back()->with('error', 'Pesanan tidak bisa dijadwalkan ulang');
        }

        DB::transaction(function () use ($order, $request) {

            $order->update([
                // 🔥 pindahkan ke field reschedule
                'reschedule_date' => $request->new_date,
                'reschedule_time' => $request->new_time,

                // 🔥 update jadwal utama juga
                'service_date' => $request->new_date,
                'service_time' => $request->new_time,

                'order_status' => 'rescheduled'
            ]);

        });

        return redirect()->back()
            ->with('success', 'Jadwal berhasil diubah');
    }
}