<?php

namespace App\Helpers;

use App\Models\PaymentAccount;
use App\Models\Transaction;

class FinanceHelper
{
    // ===============================
    // 🔥 PAYMENT VERIFIED
    // ===============================
    public static function handlePaymentVerified(Transaction $order)
    {
        if($order->is_balance_recorded) return;

        // ❌ CASH tidak masuk company
        if($order->payment_method === 'cash'){
            return;
        }

        $account = PaymentAccount::find($order->company_account_id);

        if($account){
            $account->increment('balance', $order->total_price);
        }

        $order->updateQuietly([
            'is_balance_recorded' => true,
            'payment_verified_at' => now()
        ]);
    }


    // ===============================
    // 🔥 ORDER COMPLETED
    // ===============================
    public static function handleOrderCompleted(Transaction $order)
    {
        if($order->is_profit_shared) return;

        $company = PaymentAccount::find($order->company_account_id);
        $terapis = PaymentAccount::where('terapis_id', $order->terapis_id)->first();

        if(!$terapis) return;

        $therapistShare = $order->total_price * 0.7;
        $companyFee     = $order->total_price * 0.3;

        // =========================================
        // 🔥 CASE 1: CASH (DEBT SYSTEM)
        // =========================================
        if($order->payment_method === 'cash'){

            // 💰 uang langsung ke terapis
            $terapis->increment('balance', $therapistShare);

            // 🧾 company jadi piutang
            $order->updateQuietly([
                'is_profit_shared' => true,
                'company_income'   => $companyFee,
                'therapist_income' => $therapistShare,
                'is_company_paid'  => false
            ]);

            return;
        }

        // =========================================
        // 🔥 CASE 2: TRANSFER (NORMAL FLOW)
        // =========================================
        if(!$company) return;

        $company->decrement('balance', $therapistShare);
        $terapis->increment('balance', $therapistShare);

        $order->updateQuietly([
            'is_profit_shared' => true,
            'company_income'   => $companyFee,
            'therapist_income' => $therapistShare,
            'is_company_paid'  => true
        ]);
    }


    // ===============================
    // 🔥 BAYAR HUTANG (QRIS)
    // ===============================
    public static function payCompanyFee(Transaction $order)
    {
        if($order->is_company_paid) return;

        $company = PaymentAccount::find($order->company_account_id);

        if(!$company) return;

        $company->increment('balance', $order->company_income);

        $order->update([
            'is_company_paid' => true,
            'company_paid_at' => now()
        ]);
    }
}