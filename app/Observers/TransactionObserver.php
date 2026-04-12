<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    public function creating(Transaction $order)
    {
        if ($order->payment_method === 'cash') {
            $order->payment_status = 'verified';
            $order->order_status   = 'ready';
        }
    }
}