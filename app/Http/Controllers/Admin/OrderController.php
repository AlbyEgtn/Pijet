<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class OrderController extends Controller
{

    public function status()
    {
        $transactions = Transaction::latest()->paginate(10);

        return view('pages.admin.orders.status', compact('transactions'));
    }


    public function waiting()
    {
        $transactions = Transaction::where('payment_status','uploaded')
            ->latest()
            ->paginate(10);

        return view('pages.admin.orders.waiting', compact('transactions'));
    }

    public function finished()
    {
        $transactions = Transaction::where('payment_status','verified')
            ->latest()
            ->paginate(10);

        return view('pages.admin.orders.finished', compact('transactions'));
    }

    public function reschedule()
    {
        $transactions = Transaction::where('order_status','rescheduled')
            ->latest()
            ->paginate(10);

        return view('pages.admin.orders.reschedule', compact('transactions'));
    }

    /**
     * Detail transaksi
     */
    public function detail($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('pages.admin.orders.detail', [
            'transaction' => $transaction
        ]);
    }


    /**
     * Form edit transaksi
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('pages.admin.orders.edit', [
            'transaction' => $transaction
        ]);
    }


    /**
     * Update transaksi
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $request->validate([
            'status' => 'required',
            'execution_date' => 'nullable|date'
        ]);

        $transaction->update([
            'status' => $request->status,
            'execution_date' => $request->execution_date
        ]);

        return redirect()
            ->route('pages.admin.orders.status')
            ->with('success','Order berhasil diperbarui');
    }

    /**
     * Hapus transaksi
     */
    public function delete($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();

        return redirect()
            ->back()
            ->with('success','Order berhasil dihapus');
    }

    /**
     * Konfirmasi pesanan
     */
    public function approve($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'payment_status' => 'verified',
            'order_status'   => 'ready'
        ]);

        return back()->with('success','Pesanan dikonfirmasi');
    }


    /**
     * Tolak pesanan
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'cancel_reason' => 'required|string|max:255'
        ]);

        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'payment_status' => 'failed',
            'order_status'   => 'cancelled',
            'cancel_reason'  => $request->cancel_reason
        ]);

        return back()->with('success','Pesanan ditolak');
    }
}