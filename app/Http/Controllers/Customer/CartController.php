<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Cart;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\PaymentAccount;
use App\Models\TransactionService;

class CartController extends Controller
{

    /* ================= CART PAGE ================= */

    public function index()
    {
        $carts = Cart::with('service')
            ->where('user_id', Auth::id())
            ->get();

        $total = $carts->sum(function ($cart) {
            return $cart->service->price * $cart->qty;
        });

        $additionalServices = Service::where('is_additional', 1)
            ->where('is_active', 1)
            ->get();

        // 🔥 TAMBAHAN: ambil data rekening (tanpa transaction_id)
        $payments = PaymentAccount::where('is_active', 1)->get();
        
        return view('pages.customer.cart.index', [
            'carts' => $carts,
            'total' => $total,
            'additionalServices' => $additionalServices,
            'payments' => $payments // 🔥 kirim ke view
        ]);
    }


    /* ================= ADD TO CART ================= */

    public function add($id)
    {
        $service = Service::findOrFail($id);

        $cart = Cart::where('user_id', Auth::id())
            ->where('service_id', $service->id)
            ->first();

        if ($cart) {
            $cart->increment('qty');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'service_id' => $service->id,
                'qty' => 1
            ]);
        }

        return $this->cartResponse();
    }


    /* ================= INCREASE ================= */

    public function increase($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->increment('qty');

        return $this->cartResponse();
    }


    /* ================= DECREASE ================= */

    public function decrease($id)
    {
        $cart = Cart::findOrFail($id);

        if ($cart->qty <= 1) {
            $cart->delete();
        } else {
            $cart->decrement('qty');
        }

        return $this->cartResponse();
    }


    /* ================= REMOVE ================= */

    public function remove($id)
    {
        Cart::where('user_id', Auth::id())
            ->where('id', $id)
            ->delete();

        return $this->cartResponse();
    }


    /* ================= CART RESPONSE ================= */

    private function cartResponse()
    {
        $carts = Cart::with('service')
            ->where('user_id', Auth::id())
            ->get();

        $total = $carts->sum(function ($cart) {
            return $cart->service->price * $cart->qty;
        });

        return response()->json([
            'success' => true,
            'total' => number_format($total),
            'qty' => $carts->sum('qty'),
            'count' => $carts->count()
        ]);
    }


    /* ================= CHECKOUT ================= */

    public function checkout(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'payment_method' => 'required|in:cash,transfer',
            'service_date'   => 'required|date',
            'service_time'   => 'required',
        ]);

        $carts = Cart::with('service')
            ->where('user_id', $user->id)
            ->get();

        if ($carts->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang kosong'
            ], 422);
        }

        $total = $carts->sum(function ($cart) {
            return $cart->service->price * $cart->qty;
        });

        $code = 'TRX-' . strtoupper(Str::random(10));

        DB::beginTransaction();

        try {

            /* ================= CREATE TRANSACTION ================= */

            $transaction = Transaction::create([

                'transaction_code' => $code,

                'customer_id' => $user->id,

                'customer_name'    => $user->name,
                'customer_phone'   => $user->phone,
                'customer_address' => $request->address ?? $user->address,
                'customer_city'    => optional($user->city)->name ?? '-',

                'orderer_name' => $user->name,

                'service_date' => $request->service_date,
                'service_time' => $request->service_time,

                'total_price' => $total,

                'payment_method' => $request->payment_method,

                // 🔥 STATUS
                'payment_status' => 'pending',
                'order_status'   => 'waiting',

                // 🔥 TIMER LANGSUNG JALAN
                'payment_expired_at' => now()->addHours(24),
            ]);


            /* ================= SNAPSHOT SERVICES ================= */

            foreach ($carts as $cart) {

                $service = $cart->service;

                TransactionService::create([

                    'transaction_id' => $transaction->id,

                    'service_name'   => $service->name,
                    'duration'       => $service->duration,
                    'service_price'  => $service->price,

                    'therapist_id'   => null,

                    'additional_service' => null,
                    'additional_price'   => 0,

                    'total_duration' => $service->duration * $cart->qty
                ]);
            }


            /* ================= CLEAR CART ================= */

            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'redirect' => route('customer.orders.show', $transaction->id)
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /* ================= UPLOAD BUKTI ================= */

    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|max:2048'
        ]);

        $order = Transaction::where('customer_id', auth()->id())
            ->findOrFail($id);

        if ($order->payment_method !== 'transfer') {
            return back()->with('error','Metode tidak valid');
        }

        if ($order->payment_status === 'expired') {
            return back()->with('error','Pembayaran sudah expired');
        }

        $file = $request->file('payment_proof');

        $path = $file->store('payment_proofs','public');

        $order->update([
            'payment_proof' => $path,
            'payment_uploaded_at' => now(),
            'payment_status' => 'uploaded'
        ]);

        return back()->with('success','Bukti berhasil diupload');
    }

}