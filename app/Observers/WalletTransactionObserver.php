<?php

namespace App\Observers;

use App\Models\WalletTransaction;
use App\Models\Transaction;

class WalletTransactionObserver
{
    public function created(WalletTransaction $wallet)
    {
        \Log::info('OBSERVER JALAN');
        
        // 🔥 hanya trigger untuk income dari transaction
        if (
            $wallet->type !== 'income' ||
            $wallet->reference_type !== 'transaction'
        ) {
            return;
        }

        $order = Transaction::find($wallet->reference_id);

        if (!$order) return;

        // ❗ hindari overwrite
        if ($order->payment_status === 'verified') {
            return;
        }

        // 🔥 AUTO UPDATE
        $order->update([
            'payment_status' => 'verified',
            'order_status'   => 'ready'
        ]);
    }
}