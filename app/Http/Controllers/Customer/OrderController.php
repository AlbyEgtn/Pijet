<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class OrderController extends Controller
{

    public function index()
    {

        $orders = Transaction::with('services')
            ->where('customer_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.customer.orders.index',[
            'orders' => $orders
        ]);

    }

}