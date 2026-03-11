<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Service;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {

        $carts = Cart::with('service')
            ->where('user_id', Auth::id())
            ->get();

        // Hitung total
        $total = $carts->sum(function ($cart) {
            return $cart->service->price * $cart->qty;
        });

        return view('pages.customer.cart.index', compact('carts','total'));

    }


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


    public function increase($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->qty += 1;
        $cart->save();

        return $this->cartResponse();
    }

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


    public function remove($id)
    {

        $cart = Cart::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $cart->delete();

        return back();

    }

    private function cartResponse()
    {
        $carts = Cart::with('service')->where('user_id',auth()->id())->get();

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
}