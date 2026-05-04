<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Helpers\FinanceHelper;
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
        $grossIncome = Transaction::where('payment_status', 'verified')
            ->sum('total_price');
        
        $companyIncome = Transaction::where('payment_status', 'verified')
            ->sum('company_income');

        $totalExpense = Transaction::where('order_status', 'completed')
            ->sum('therapist_income');

        $grossIncome = Transaction::where('payment_status', 'verified')
            ->sum('total_price');

        $balance = $companyIncome;

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
            ->where('payment_status','verified')
            ->groupBy('month')
            ->pluck('total','month')
            ->toArray();


        $ordersChart = [];
        $incomeChart = [];

        for ($i = 1; $i <= 12; $i++) {
            $ordersChart[] = $orders[$i] ?? 0;
            $incomeChart[] = $incomePerMonth[$i] ?? 0;
        }

        $completed = Transaction::where('order_status','completed')->count();
        $cancelled = Transaction::where('order_status','cancelled')->count();


        $serviceLabels = ['Full Body','Traditional','Deep Tissue','Thai','Hot Stone','Swedish'];
        $serviceData   = [40,30,20,10,5,2];


        return view('pages.finance.dashboard', [
            'companyIncome' => $companyIncome,
            'totalExpense'  => $totalExpense,
            'grossIncome'   => $grossIncome,
            'balance'       => $balance,
            'ordersChart'   => $ordersChart,
            'incomeChart'   => $incomeChart,
            'completed'     => $completed,
            'cancelled'     => $cancelled,
            'serviceLabels' => $serviceLabels,
            'serviceData'   => $serviceData,
        ]);
    }

    public function transfer(Request $request)
    {
        $query = Transaction::with(['services','payment'])
            ->where('payment_method','transfer');

        $this->applySearch($query,$request);

        $transactions = $query->latest()->paginate(10)->withQueryString();

        return view('pages.finance.transaction.transfer', compact('transactions'));
    }

    public function cash(Request $request)
    {
        $query = Transaction::with(['services','payment'])
            ->where('payment_method','cash');

        $this->applySearch($query,$request);

        $transactions = $query->latest()->paginate(10)->withQueryString();

        return view('pages.finance.transaction.cash', compact('transactions'));
    }

    public function cancelled(Request $request)
    {
        $query = Transaction::with(['services','payment'])
            ->where('order_status','cancelled');

        $this->applySearch($query,$request);

        $transactions = $query->latest()->paginate(10)->withQueryString();

        return view('pages.finance.transaction.cancelled', compact('transactions'));
    }

    public function reschedule(Request $request)
    {
        $query = Transaction::with(['services','payment'])
            ->where('order_status','rescheduled');

        $this->applySearch($query,$request);

        $transactions = $query->latest()->paginate(10)->withQueryString();

        return view('pages.finance.transaction.reschedule', compact('transactions'));
    }

    public function recap(Request $request)
    {
        $query = \App\Models\Transaction::query();

        if ($request->status) {
            $query->where('order_status', $request->status);
        }

        if ($request->date_from && $request->date_to) {
            $query->whereBetween('created_at', [
                $request->date_from,
                $request->date_to
            ]);
        }

        $transactions = $query->latest()->paginate(10);

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

    public function salary()
    {
        return view('pages.finance.salary');
    }

    public function setting()
    {
        $companyAccounts = PaymentAccount::where('type','company')
            ->where('is_active', true)
            ->get();

        $balances = Transaction::select(
                'company_account_id',
                DB::raw('SUM(company_income) as total_balance') 
            )
            ->whereNotNull('company_account_id')
            ->where('payment_status','verified')
            ->groupBy('company_account_id')
            ->pluck('total_balance','company_account_id');

        foreach ($companyAccounts as $account) {
            $account->balance = $balances[$account->id] ?? 0;
        }

        $totalCompany = $companyAccounts->sum(fn($a) => $a->balance);

        return view('pages.finance.setting', compact(
            'companyAccounts',
            'totalCompany'
        ));
    }

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


    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'bank_id' => 'required|exists:payment_accounts,id'
        ]);

        try {

            FinanceHelper::withdrawToBank(
                $request->amount,
                $request->bank_id
            );

            return back()->with('success', 'Withdraw berhasil');

        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }
}