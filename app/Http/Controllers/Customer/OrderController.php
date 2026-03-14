<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

        $order = Transaction::with('services')
            ->where('customer_id', auth()->id())
            ->findOrFail($id);

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

        $order = Transaction::where('customer_id', auth()->id())
            ->findOrFail($id);


        $order->update([
            'payment_method' => $request->payment_method
        ]);


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
        | TRANSFER PAYMENT
        |--------------------------------------------------------------------------
        */

        if ($request->payment_method == 'transfer') {

            $bank = $banks[$request->bank] ?? null;

            Payment::updateOrCreate(

                ['transaction_id' => $order->id],

                [
                    'bank_name' => $request->bank,
                    'account_number' => $bank['account_number'] ?? null,
                    'account_holder' => $bank['account_holder'] ?? null
                ]

            );

        }


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

        $order = Transaction::with('services', 'payment')
            ->where('customer_id', auth()->id())
            ->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | AUTO CREATE PAYMENT IF NULL
        |--------------------------------------------------------------------------
        */

        if (!$order->payment) {

            Payment::create([

                'transaction_id' => $order->id,

                'bank_name' => 'BCA',

                'account_number' => '4272022855',

                'account_holder' => 'PT Pijetin Indonesia'

            ]);

            $order->load('payment');

        }


        return view('pages.customer.orders.payment', [

            'order' => $order

        ]);

    }

}