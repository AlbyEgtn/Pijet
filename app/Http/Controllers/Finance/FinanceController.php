<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class FinanceController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        return view('pages.finance.dashboard');
    }

    public function overview()
    {
        return view('pages.finance.dashboard-overview');
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

        $transactions = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.finance.transaction.transfer',
            compact('transactions')
        );

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

        $transactions = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.finance.transaction.cash',
            compact('transactions')
        );

    }



    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI DIBATALKAN
    |--------------------------------------------------------------------------
    */

    public function cancelled(Request $request)
    {

        $query = Transaction::with(['services','payment'])
                    ->where('status','dibatalkan');

        $this->applySearch($query,$request);

        $transactions = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.finance.transaction.cancelled',
            compact('transactions')
        );

    }



    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI RESCHEDULE
    |--------------------------------------------------------------------------
    */

    public function reschedule(Request $request)
    {

        $query = Transaction::with(['services','payment'])
                    ->where('status','reschedule');

        $this->applySearch($query,$request);

        $transactions = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'pages.finance.transaction.reschedule',
            compact('transactions')
        );

    }



    /*
    |--------------------------------------------------------------------------
    | RECAP TRANSAKSI
    |--------------------------------------------------------------------------
    */

    public function recap()
    {
        return view('pages.finance.recap');
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
    | PENGATURAN
    |--------------------------------------------------------------------------
    */

    public function setting()
    {
        return view('pages.finance.setting');
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