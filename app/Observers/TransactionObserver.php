<?php

namespace App\Observers;

use App\Helpers\FinanceHelper;
use App\Models\Transaction;

class TransactionObserver
{
    // ===============================
    // 🔥 CREATE
    // ===============================
    public function creating(Transaction $order)
    {
        if ($order->payment_method === 'cash') {
            $order->payment_status = 'verified';
            $order->order_status   = 'ready';
        }
    }


    // ===============================
    // 🔥 UPDATED
    // ===============================
    public function updated(Transaction $order)
    {
        // 🔥 AUTO CASH SAFETY
        if (
            $order->payment_method === 'cash' &&
            $order->payment_status !== 'verified'
        ) {
            $order->updateQuietly([
                'payment_status' => 'verified',
                'order_status'   => 'ready',
            ]);
        }

        // ===============================
        // 🔥 PAYMENT VERIFIED
        // ===============================
        if(
            $order->payment_status === 'verified' &&
            $order->getOriginal('payment_status') !== 'verified'
        ){
            FinanceHelper::handlePaymentVerified($order);
        }

        // ===============================
        // 🔥 ORDER COMPLETED
        // ===============================
        if(
            $order->order_status === 'completed' &&
            $order->getOriginal('order_status') !== 'completed'
        ){
            FinanceHelper::handleOrderCompleted($order);
        }

        \Log::info('OBSERVER TRIGGERED', [
            'order_id' => $order->id,
            'payment_method' => $order->payment_method,
            'payment_status' => $order->payment_status,
            'order_status' => $order->order_status
        ]);
    }
}