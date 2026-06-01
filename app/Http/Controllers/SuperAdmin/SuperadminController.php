<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Transaction;

class SuperadminController extends Controller
{
    

    public function dashboard()
    {
        // SUMMARY
        $totalUser = User::count();
        $totalTransaction = Transaction::count();
        $totalRevenue = Transaction::where('order_status','completed')->sum('total_price');

        // GRAFIK (6 bulan terakhir - revenue dari transaksi completed)
        $months = [];
        $revenues = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);

            $months[] = $date->format('M');

            $revenues[] = Transaction::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('order_status', 'completed')
                ->sum('total_price');
        }

        // RECENT
        $recentTransactions = Transaction::latest()->take(5)->get();

        return view('pages.superadmin.dashboard', compact(
            'totalUser',
            'totalTransaction',
            'totalRevenue',
            'months',
            'revenues',
            'recentTransactions'
        ));
    }
    }
