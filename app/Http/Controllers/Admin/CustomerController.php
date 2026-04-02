<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('transactions')
            ->select(
                'customer_name',
                'customer_phone',
                DB::raw('COUNT(*) as total_transactions'),
                DB::raw('MAX(service_date) as last_order')
            )
            ->groupBy('customer_name', 'customer_phone');

        if ($request->search) {
            $query->where('customer_name', 'like', "%{$request->search}%")
                ->orWhere('customer_phone', 'like', "%{$request->search}%");
        }

        $customers = $query->paginate(10);

        return view('pages.admin.customer.index', compact('customers'));
    }

    public function show($phone)
    {
        $transactions = Transaction::with('services')
            ->where('customer_phone', $phone)
            ->latest()
            ->get();

        $customer = $transactions->first();

        return view('pages.admin.customer.detail', compact('transactions', 'customer'));
    }
}
