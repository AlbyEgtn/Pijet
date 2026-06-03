<?php

namespace App\Helpers;

use App\Models\PaymentAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FinanceHelper
{
    public static function getCompanyWallet()
    {
        $wallet = PaymentAccount::where('bank_name', 'SYSTEM')->first();

        if (!$wallet) {
            throw new \Exception('SYSTEM WALLET NOT FOUND');
        }

        return $wallet;
    }

    public static function addBalance($wallet, $amount, $order, $description)
    {
        $wallet->increment('balance', $amount);

        DB::table('wallet_transactions')->insert([
            'payment_account_id' => $wallet->id,
            'type'               => 'income',
            'amount'             => $amount,
            'reference_type'     => 'transaction',
            'reference_id'       => $order->id,
            'description'        => $description,
            'created_at'         => now(),
            'updated_at'         => now()
        ]);
    }

    public static function handlePaymentVerified(Transaction $order)
    {
        Log::info('PAYMENT VERIFIED START', [
            'order_id' => $order->id
        ]);

        if ($order->payment_method === 'cash') {
            return;
        }

        $existing = DB::table('wallet_transactions')
            ->where('reference_id', $order->id)
            ->where('reference_type', 'transaction')
            ->where('description', 'Pembayaran Midtrans')
            ->first();

        if ($existing) {
            Log::warning('PAYMENT ALREADY RECORDED', ['order_id' => $order->id]);
            return;
        }

        $wallet = self::getCompanyWallet();

        DB::transaction(function () use ($wallet, $order) {

            self::addBalance(
                $wallet,
                $order->total_price,
                $order,
                'Pembayaran Midtrans'
            );

            $order->updateQuietly([
                'payment_verified_at' => now()
            ]);
        });
    }

    public static function handleOrderCompleted(Transaction $order)
    {
        Log::info('ORDER COMPLETED START', [
            'order_id' => $order->id
        ]);

        if ($order->company_income !== null && $order->therapist_income !== null) {
            Log::warning('ALREADY SPLIT', ['order_id' => $order->id]);
            return;
        }

        DB::transaction(function () use ($order) {

            $terapisWallet = PaymentAccount::where('terapis_id', $order->terapis_id)
                ->where('is_active', 1)
                ->first();

            if (!$terapisWallet) {
                throw new \Exception('Wallet terapis tidak ditemukan');
            }

            $companyWallet = self::getCompanyWallet();

            $total = $order->total_price;

            $companyFee     = $order->company_income ?? ($total * 0.2);
            $terapisIncome  = $total - $companyFee;

            self::addBalance(
                $terapisWallet,
                $terapisIncome,
                $order,
                'Pendapatan Terapis'
            );

            if ($order->payment_method === 'cash') {

                DB::table('wallet_transactions')->insert([
                    'payment_account_id' => $companyWallet->id,
                    'type'               => 'income',
                    'amount'             => $companyFee,
                    'reference_type'     => 'transaction',
                    'reference_id'       => $order->id,
                    'description'        => 'Fee Company (Belum Dibayar)',
                    'created_at'         => now(),
                    'updated_at'         => now()
                ]);

            } else {

                self::addBalance(
                    $companyWallet,
                    $companyFee,
                    $order,
                    'Fee Company (Dari Saldo)'
                );
            }

            $order->updateQuietly([
                'company_income'    => $companyFee,
                'therapist_income' => $terapisIncome
            ]);
        });
    }

    public static function payCompanyFee(Transaction $order)
    {
        \Log::info('PAY COMPANY FEE START', [
            'order_id' => $order->id
        ]);

        if ($order->is_company_paid) {

            \Log::info('ALREADY PAID');

            return;
        }

        DB::transaction(function () use ($order) {

            $companyWallet = self::getCompanyWallet();

            $amount = $order->company_income;

            \Log::info('AMOUNT', [
                'amount' => $amount
            ]);

            self::addBalance(
                $companyWallet,
                $amount,
                $order,
                'Pembayaran Hutang Terapis'
            );

            $updated = $order->update([
                'is_company_paid' => 1,
                'company_paid_at' => now()
            ]);

            \Log::info('UPDATE RESULT', [
                'updated' => $updated
            ]);

            $order->refresh();

            \Log::info('AFTER UPDATE', [
                'paid' => $order->is_company_paid
            ]);

        });
    }

    public static function syncBalance($walletId)
    {
        $total = DB::table('wallet_transactions')
            ->where('payment_account_id', $walletId)
            ->sum('amount');

        PaymentAccount::where('id', $walletId)
            ->update(['balance' => $total]);
    }
}