<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\TransactionService;

class ReportController extends Controller
{
    public function index (Request $request)
    {
        $query = Transaction::query();

        // OPTIONAL: hanya ambil yang ada masalah / laporan
        $query->whereNotNull('cancel_reason');

        if ($request->search) {
            $query->where('customer_name', 'like', "%{$request->search}%")
                ->orWhere('customer_phone', 'like', "%{$request->search}%");
        }

        $reports = $query->latest()->paginate(10);

        return view('pages.admin.report.index', compact('reports'));
    }
}
