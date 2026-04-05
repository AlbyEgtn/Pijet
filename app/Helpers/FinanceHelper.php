<?php

namespace App\Helpers;

use App\Models\PaymentAccount;
use App\Models\Transaction;

class FinanceHelper
{
    public static function handlePaymentVerified(Transaction $order)
    {
        if($order->is_balance_recorded) return;

        $account = PaymentAccount::find($order->company_account_id);

        if($account){
            $account->increment('balance', $order->total_price);
        }

        $order->updateQuietly([
            'is_balance_recorded' => true,
            'payment_verified_at' => now()
        ]);
    }

    public static function handleOrderCompleted(Transaction $order)
    {
        if($order->is_profit_shared) return;

        $company = PaymentAccount::find($order->company_account_id);
        $terapis = PaymentAccount::where('terapis_id', $order->terapis_id)->first();

        if(!$company || !$terapis) return;

        $therapistShare = $order->total_price * 0.7;

        // 🔥 transfer dari company ke terapis
        $company->decrement('balance', $therapistShare);
        $terapis->increment('balance', $therapistShare);

        $order->updateQuietly([
            'is_profit_shared' => true,
            'company_income' => $order->total_price * 0.3,
            'therapist_income' => $therapistShare
        ]);
    }
}