<?php

namespace App\Observers;
use App\Helpers\FinanceHelper;
use App\Models\Transaction;

class TransactionObserver
{
    public function updated(Transaction $order)
    {
        // 🔥 PAYMENT VERIFIED
        if(
            $order->payment_status === 'verified' &&
            $order->getOriginal('payment_status') !== 'verified'
        ){
            FinanceHelper::handlePaymentVerified($order);
        }

        // 🔥 ORDER COMPLETED
        if(
            $order->order_status === 'completed' &&
            $order->getOriginal('order_status') !== 'completed'
        ){
            FinanceHelper::handleOrderCompleted($order);
        }

        \Log::info('OBSERVER TRIGGERED');

    }

}
