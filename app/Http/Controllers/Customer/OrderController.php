<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transaction;
use App\Models\Payment;

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
            ->where('status', $status)
            ->latest()
            ->get();

        return view('pages.customer.orders.index', [
            'orders' => $orders
        ]);

    }



    /*
    |--------------------------------------------------------------------------
    | ORDER DETAIL
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {

        $order = Transaction::with('services','payment')
            ->where('customer_id', Auth::id())
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | JIKA SUDAH MASUK PROSES DAN TRANSFER
        | LANGSUNG KE HALAMAN PAYMENT
        |--------------------------------------------------------------------------
        */

        if ($order->status === 'proses' && $order->payment_method === 'transfer') {

            return redirect()->route('customer.payment', $order->id);

        }

        return view('pages.customer.orders.show', [
            'order' => $order
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



        /*
        |--------------------------------------------------------------------------
        | UPDATE ORDER
        |--------------------------------------------------------------------------
        */

        $order->payment_method = $request->payment_method;
        $order->status = 'proses';



        /*
        |--------------------------------------------------------------------------
        | CASH PAYMENT
        |--------------------------------------------------------------------------
        */

        if ($request->payment_method === 'cash') {

            $order->payment_expired_at = null;
            $order->save();

            Payment::where('transaction_id', $order->id)->delete();

            return response()->json([
                'success' => true,
                'redirect' => route('customer.payment', $order->id)
            ]);

        }



        /*
        |--------------------------------------------------------------------------
        | BANK LIST
        |--------------------------------------------------------------------------
        */

        $banks = [

            'BCA' => [
                'account_number' => '4272022855',
                'account_holder' => 'PT Pijetin Indonesia'
            ],

            'BRI' => [
                'account_number' => '1129987710',
                'account_holder' => 'PT Pijetin Indonesia'
            ],

            'BNI' => [
                'account_number' => '8892210092',
                'account_holder' => 'PT Pijetin Indonesia'
            ],

            'MANDIRI' => [
                'account_number' => '1338842291',
                'account_holder' => 'PT Pijetin Indonesia'
            ]

        ];



        /*
        |--------------------------------------------------------------------------
        | VALIDATE BANK
        |--------------------------------------------------------------------------
        */

        if (!isset($banks[$request->bank])) {

            return response()->json([
                'success' => false,
                'message' => 'Bank tidak valid'
            ], 422);

        }



        /*
        |--------------------------------------------------------------------------
        | SET PAYMENT EXPIRED (ONLY FIRST TIME)
        |--------------------------------------------------------------------------
        */

        if (!$order->payment_expired_at) {

            $order->payment_expired_at = now()->addHours(24);

        }

        $order->save();



        /*
        |--------------------------------------------------------------------------
        | CREATE / UPDATE PAYMENT
        |--------------------------------------------------------------------------
        */

        $bank = $banks[$request->bank];

        Payment::updateOrCreate(

            [
                'transaction_id' => $order->id
            ],

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

        $order = Transaction::with(['services', 'payment'])
            ->where('customer_id', Auth::id())
            ->findOrFail($id);

        return view('pages.customer.orders.payment', [
            'order' => $order
        ]);

    }

    public function uploadPaymentProof(Request $request, $id)
    {

        /*
        |--------------------------------------------------------------------------
        | VALIDASI FILE
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL TRANSAKSI
        |--------------------------------------------------------------------------
        */

        $order = Transaction::where('customer_id', auth()->id())
            ->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | CEK METODE PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        if ($order->payment_method !== 'transfer') {

            return redirect()
                ->back()
                ->with('error','Metode pembayaran tidak valid');

        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS FILE LAMA (JIKA ADA)
        |--------------------------------------------------------------------------
        */

        if ($order->payment_proof) {

            \Storage::disk('public')->delete($order->payment_proof);

        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN FILE BARU
        |--------------------------------------------------------------------------
        */

        $file = $request->file('payment_proof');

        $filename =
            'payment_' .
            $order->transaction_code .
            '_' .
            time() .
            '.' .
            $file->getClientOriginalExtension();


        $path = $file->storeAs(
            'payment_proofs',
            $filename,
            'public'
        );


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $order->payment_proof = $path;

        $order->payment_uploaded_at = now();

        $order->save();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('customer.payment',$order->id)
            ->with('success','Bukti pembayaran berhasil diupload');

    }
}