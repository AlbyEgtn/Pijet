<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function index()
    {
        $totalCustomers = User::where('role', 'customer')->count();

        $totalTherapists = User::where('role', 'terapis')->count();

        $totalCompletedOrders = Transaction::where('order_status', 'completed')->count();

        $totalCancelledOrders = Transaction::where('order_status', 'cancelled')->count();

        $ordersPerMonth = Transaction::selectRaw("
                CAST(strftime('%m', created_at) AS INTEGER) as month,
                COUNT(*) as total
            ")
            ->where('order_status', 'completed')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();


        $chartData = [];

        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $ordersPerMonth[$i] ?? 0;
        }

        $latestOrders = Transaction::latest()
            ->limit(5)
            ->get();

        $latestTherapists = User::where('role', 'terapis')
            ->latest()
            ->limit(5)
            ->get();

        $popularServices = DB::table('services')
            ->select('name')
            ->limit(3)
            ->get();

        return view('pages.admin.dashboard', [

            'totalCustomers'        => $totalCustomers,
            'totalTherapists'       => $totalTherapists,
            'totalCompletedOrders'  => $totalCompletedOrders,
            'totalCancelledOrders'  => $totalCancelledOrders,

            'chartData'             => $chartData,

            'latestOrders'          => $latestOrders,

            'latestTherapists'      => $latestTherapists,

            'popularServices'       => $popularServices

        ]);

    }
}
