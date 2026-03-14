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

        $additionalServices = Service::where('is_additional',1)
            ->where('is_active',1)
            ->get();

        return view('pages.customer.cart.index',[
            'carts' => $carts,
            'total' => $total,
            'additionalServices' => $additionalServices
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

        $cartCount = Cart::where('user_id', Auth::id())->sum('qty');

        if(request()->ajax()){

            return response()->json([
                'success' => true,
                'count' => $cartCount
            ]);

        }

        return back();

    }



    /* ================= INCREASE QTY ================= */

    public function increase($id)
    {

        $cart = Cart::findOrFail($id);

        $cart->qty += 1;
        $cart->save();

        return $this->cartResponse();

    }



    /* ================= DECREASE QTY ================= */

    public function decrease($id)
    {

        $cart = Cart::findOrFail($id);

        $cart->qty -= 1;

        if($cart->qty <= 0){

            $cart->delete();

        }else{

            $cart->save();

        }

        return $this->cartResponse();

    }



    /* ================= REMOVE ITEM ================= */

    public function remove($id)
    {

        $cart = Cart::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $cart->delete();

        return back();

    }



    /* ================= RESPONSE CART ================= */

    private function cartResponse()
    {

        $carts = Cart::with('service')
            ->where('user_id', auth()->id())
            ->get();

        $total = $carts->sum(function($cart){

            return $cart->qty * $cart->service->price;

        });

        return response()->json([

            'success' => true,
            'total' => number_format($total),
            'count' => $carts->count(),
            'qty' => $carts->sum('qty')

        ]);

    }



    /* ================= CHECKOUT ================= */

    public function checkout(Request $request)
    {

        $request->validate([

            'service_date' => ['required','date'],
            'service_time' => ['required'],
            'payment_method' => ['required','in:cash,transfer'],

            'phone'   => ['required'],
            'city'    => ['required','string'],
            'address' => ['required','string']

        ]);


        $user = auth()->user();


        /* ================= UPDATE DATA USER ================= */

        $user->update([

            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address

        ]);


        $carts = Cart::with('service')
            ->where('user_id', $user->id)
            ->get();


        if($carts->isEmpty()){

            return response()->json([
                'success' => false,
                'message' => 'Keranjang kosong'
            ]);

        }


        DB::beginTransaction();

        try{

            /* ================= HITUNG TOTAL ================= */

            $total = $carts->sum(function ($cart){

                return $cart->service->price * $cart->qty;

            });


            /* ================= BUAT TRANSACTION ================= */

            $transaction = Transaction::create([

                'transaction_code' => 'TRX-'.Str::upper(Str::random(8)),

                'customer_id' => $user->id,

                'customer_name' => $user->name,

                'customer_phone' => $request->phone,

                'customer_address' => $request->address,

                'customer_city' => $request->city,

                'orderer_name' => $user->name,

                'service_date' => $request->service_date,

                'service_time' => $request->service_time,

                'payment_method' => $request->payment_method,

                'status' => 'belum_lunas',

                'total_price' => $total

            ]);


            /* ================= SIMPAN SERVICES ================= */

            foreach($carts as $cart){

                TransactionService::create([

                    'transaction_id' => $transaction->id,

                    'service_name' => $cart->service->name,

                    'duration' => $cart->service->duration,

                    'service_price' => $cart->service->price,

                    'therapist_id' => null,

                    'additional_service' => null,

                    'additional_price' => null,

                    'total_duration' => $cart->service->duration * $cart->qty

                ]);

            }


            /* ================= HAPUS CART ================= */

            Cart::where('user_id',$user->id)->delete();


            DB::commit();


            return response()->json([

                'success' => true,

                'redirect' => route('customer.orders')

            ]);

        }
        catch(\Exception $e){

            DB::rollBack();

            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ]);

        }

    }

}