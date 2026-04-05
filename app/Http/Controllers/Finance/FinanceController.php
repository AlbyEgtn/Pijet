<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\PaymentAccount;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        // =========================
        // TOTAL INCOME (GROSS)
        // =========================
        $totalIncome = Transaction::where('payment_status', 'verified')
            ->sum('total_price');


        // =========================
        // TOTAL EXPENSE (THERAPIST 70%)
        // =========================
        $totalExpense = Transaction::where('order_status', 'completed')
            ->sum('therapist_income');


        // =========================
        // COMPANY BALANCE (REAL)
        // =========================
        $companyAccount = PaymentAccount::whereNull('terapis_id')->first();

        $balance = $companyAccount->balance ?? 0;


        // =========================
        // CHART (ORDER & INCOME)
        // =========================

        $orders = Transaction::selectRaw("
                CAST(strftime('%m', created_at) AS INTEGER) as month,
                COUNT(*) as total
            ")
            ->groupBy('month')
            ->pluck('total','month')
            ->toArray();


        $incomePerMonth = Transaction::selectRaw("
                CAST(strftime('%m', created_at) AS INTEGER) as month,
                SUM(company_income) as total
            ")
            ->where('order_status','completed')
            ->groupBy('month')
            ->pluck('total','month')
            ->toArray();


        $ordersChart = [];
        $incomeChart = [];

        for ($i = 1; $i <= 12; $i++) {
            $ordersChart[] = $orders[$i] ?? 0;
            $incomeChart[] = $incomePerMonth[$i] ?? 0;
        }


        // =========================
        // ORDER STATUS
        // =========================

        $completed = Transaction::where('order_status','completed')->count();
        $cancelled = Transaction::where('order_status','cancelled')->count();


        // =========================
        // SERVICE POPULAR (SIMPLE)
        // =========================

        $serviceLabels = ['Full Body','Traditional','Deep Tissue','Thai','Hot Stone','Swedish'];
        $serviceData   = [40,30,20,10,5,2];


        return view('pages.finance.dashboard', compact(
            'totalIncome',
            'totalExpense',
            'balance',
            'ordersChart',
            'incomeChart',
            'completed',
            'cancelled',
            'serviceLabels',
            'serviceData'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI TRANSFER
    |--------------------------------------------------------------------------
    */

    public function transfer(Request $request)
    {
        $query = Transaction::with(['services','payment'])
            ->where('payment_method','transfer');

        $this->applySearch($query,$request);

        $transactions = $query->latest()->paginate(10)->withQueryString();

        return view('pages.finance.transaction.transfer', compact('transactions'));
    }


    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI CASH
    |--------------------------------------------------------------------------
    */

    public function cash(Request $request)
    {
        $query = Transaction::with(['services','payment'])
            ->where('payment_method','cash');

        $this->applySearch($query,$request);

        $transactions = $query->latest()->paginate(10)->withQueryString();

        return view('pages.finance.transaction.cash', compact('transactions'));
    }


    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI DIBATALKAN
    |--------------------------------------------------------------------------
    */

    public function cancelled(Request $request)
    {
        $query = Transaction::with(['services','payment'])
            ->where('order_status','cancelled');

        $this->applySearch($query,$request);

        $transactions = $query->latest()->paginate(10)->withQueryString();

        return view('pages.finance.transaction.cancelled', compact('transactions'));
    }


    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI RESCHEDULE
    |--------------------------------------------------------------------------
    */

    public function reschedule(Request $request)
    {
        $query = Transaction::with(['services','payment'])
            ->where('order_status','rescheduled');

        $this->applySearch($query,$request);

        $transactions = $query->latest()->paginate(10)->withQueryString();

        return view('pages.finance.transaction.reschedule', compact('transactions'));
    }


    /*
    |--------------------------------------------------------------------------
    | RECAP TRANSAKSI
    |--------------------------------------------------------------------------
    */

    public function recap(Request $request)
    {
        $query = \App\Models\Transaction::query();

        // ================= FILTER =================
        if ($request->status) {
            $query->where('order_status', $request->status);
        }

        if ($request->date_from && $request->date_to) {
            $query->whereBetween('created_at', [
                $request->date_from,
                $request->date_to
            ]);
        }

        // ================= DATA =================
        $transactions = $query->latest()->paginate(10);

        // ================= SUMMARY =================
        $totalIncome = $query->sum('total_price');
        $totalTherapist = $query->sum('therapist_income');
        $totalCompany = $query->sum('company_income');

        return view('pages.finance.recap.index', compact(
            'transactions',
            'totalIncome',
            'totalTherapist',
            'totalCompany'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | GAJI TERAPIS
    |--------------------------------------------------------------------------
    */

    public function salary()
    {
        return view('pages.finance.salary');
    }


    /*
    |--------------------------------------------------------------------------
    | PENGATURAN (🔥 CORE FIX)
    |--------------------------------------------------------------------------
    */

    public function setting()
    {
        // ambil rekening company aktif
        $companyAccounts = PaymentAccount::where('type','company')
            ->where('is_active', true)
            ->get();

        // 🔥 ambil saldo sekaligus (no N+1)
        $balances = Transaction::select(
                'company_account_id',
                DB::raw('SUM(total_price) as total_balance')
            )
            ->whereNotNull('company_account_id')
            ->where('payment_status','verified')
            ->groupBy('company_account_id')
            ->pluck('total_balance','company_account_id');

        // inject ke collection
        foreach ($companyAccounts as $account) {
            $account->balance = $balances[$account->id] ?? 0;
        }

        return view('pages.finance.setting', compact('companyAccounts'));
    }


    /*
    |--------------------------------------------------------------------------
    | SEARCH HELPER
    |--------------------------------------------------------------------------
    */

    private function applySearch($query, Request $request)
    {
        if(!$request->search){
            return;
        }

        $query->where(function($q) use ($request){

            $q->where('transaction_code','like','%'.$request->search.'%')
              ->orWhere('customer_name','like','%'.$request->search.'%')
              ->orWhere('customer_phone','like','%'.$request->search.'%')
              ->orWhere('customer_city','like','%'.$request->search.'%');

        });
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        $transaction = Transaction::with([
            'services',
            'payment'
        ])->findOrFail($id);

        return view(
            'pages.finance.transaction.detail',
            compact('transaction')
        );
    }
}