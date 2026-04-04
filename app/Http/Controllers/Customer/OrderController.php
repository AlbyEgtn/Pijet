<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transaction;
use App\Models\Payment;
use App\Models\PaymentAccount;

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

            // 🔥 BELUM BAYAR
            ->when($status === 'belum_lunas', function ($q) {
                $q->whereIn('payment_status', ['pending','uploaded']);
            })

            // 🔥 DIPROSES (semua yang belum selesai)
            ->when($status === 'diproses', function ($q) {
                $q->whereIn('order_status', [
                    'ready',
                    'assigned',
                    'on_the_way',
                    'ongoing'
                ]);
            })

            // 🔥 SELESAI
            ->when($status === 'selesai', function ($q) {
                $q->where('order_status', 'completed');
            })

            // 🔥 DIBATALKAN
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

        $accounts = PaymentAccount::where('is_active', true)->get();

        return view('pages.customer.orders.show', [
            'order' => $order,
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
            'bank' => 'required_if:payment_method,transfer'
        ]);

        $order = Transaction::where('customer_id', Auth::id())
            ->findOrFail($id);

        $order->payment_method = $request->payment_method;

        // 🔥 STATUS BARU
        $order->payment_status = 'pending';
        $order->order_status   = 'waiting';

        // ================= CASH =================
        if ($request->payment_method === 'cash') {

            // langsung dianggap verified
            $order->payment_status = 'verified';
            $order->order_status   = 'ready';
            $order->payment_expired_at = null;

            $order->save();

            return response()->json([
                'success' => true,
                'redirect' => route('customer.orders.show', $order->id)
            ]);
        }

        // ================= TRANSFER =================
        $banks = [
            'BCA' => ['account_number' => '4272022855','account_holder' => 'PT Pijetin Indonesia'],
            'BRI' => ['account_number' => '1129987710','account_holder' => 'PT Pijetin Indonesia'],
            'BNI' => ['account_number' => '8892210092','account_holder' => 'PT Pijetin Indonesia'],
            'MANDIRI' => ['account_number' => '1338842291','account_holder' => 'PT Pijetin Indonesia']
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
                'bank_name' => $request->bank,
                'account_number' => $bank['account_number'],
                'account_holder' => $bank['account_holder']
            ]
        );

        return response()->json([
            'success' => true,
            'redirect' => route('customer.payment', $order->id)
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT PAGE
    |--------------------------------------------------------------------------
    */

    public function paymentPage($id)
    {
        $order = Transaction::with(['services'])
            ->where('customer_id', Auth::id())
            ->findOrFail($id);

        if (!$order->payment_expired_at) {
            $order->payment_expired_at = now()->addHours(24);
            $order->save();
        }

        $accounts = \App\Models\PaymentAccount::where('is_active', true)->get();

        return view('pages.customer.orders.payment', [
            'order' => $order,
            'accounts' => $accounts
        ]);
    }

    public function uploadPaymentProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $order = Transaction::where('customer_id', auth()->id())
            ->findOrFail($id);

        if ($order->payment_method !== 'transfer') {
            return back()->with('error','Metode pembayaran tidak valid');
        }

        if ($order->payment_proof) {
            \Storage::disk('public')->delete($order->payment_proof);
        }

        $file = $request->file('payment_proof');

        $filename = 'payment_'.$order->transaction_code.'_'.time().'.'.$file->getClientOriginalExtension();

        $path = $file->storeAs('payment_proofs', $filename, 'public');

        // 🔥 UPDATE STATUS BARU
        $order->payment_proof = $path;
        $order->payment_uploaded_at = now();
        $order->payment_status = 'uploaded';

        $order->save();

        return redirect()
            ->route('customer.payment',$order->id)
            ->with('success','Bukti pembayaran berhasil diupload');
    }
}

