<?php

namespace App\Helpers;

use App\Models\PaymentAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FinanceHelper
{
    // ===============================
    // 🔥 GET COMPANY WALLET
    // ===============================
    public static function getCompanyWallet()
    {
        $wallet = PaymentAccount::where('bank_name', 'SYSTEM')->first();

        if (!$wallet) {
            throw new \Exception('SYSTEM WALLET NOT FOUND');
        }

        return $wallet;
    }

    // ===============================
    // 🔥 SAFE ADD BALANCE + LEDGER
    // ===============================
    public static function addBalance($wallet, $amount, $order, $description)
    {
        // 💰 UPDATE BALANCE
        $wallet->increment('balance', $amount);

        // 🧾 INSERT LEDGER
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

    // ===============================
    // 🔥 PAYMENT VERIFIED (TRANSFER ONLY)
    // ===============================
    public static function handlePaymentVerified(Transaction $order)
    {
        Log::info('PAYMENT VERIFIED START', [
            'order_id' => $order->id
        ]);

        // ❌ SKIP CASH
        if ($order->payment_method === 'cash') {
            return;
        }

        // ❌ ANTI DOUBLE PAYMENT
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

            // 💰 MASUKKAN UANG CUSTOMER
            self::addBalance(
                $wallet,
                $order->total_price,
                $order,
                'Pembayaran Midtrans'
            );

            // 🔥 UPDATE ORDER
            $order->updateQuietly([
                'payment_verified_at' => now()
            ]);
        });
    }

    // ===============================
    // 🔥 ORDER COMPLETED (PROFIT SHARING)
    // ===============================
    public static function handleOrderCompleted(Transaction $order)
    {
        Log::info('ORDER COMPLETED START', [
            'order_id' => $order->id
        ]);

        // ❌ ANTI DOUBLE SPLIT
        if ($order->company_income !== null && $order->therapist_income !== null) {
            Log::warning('ALREADY SPLIT', ['order_id' => $order->id]);
            return;
        }

        DB::transaction(function () use ($order) {

            // 🔥 WALLET TERAPIS
            $terapisWallet = PaymentAccount::where('terapis_id', $order->terapis_id)
                ->where('is_active', 1)
                ->first();

            if (!$terapisWallet) {
                throw new \Exception('Wallet terapis tidak ditemukan');
            }

            // 🔥 WALLET COMPANY
            $companyWallet = self::getCompanyWallet();

            // ===============================
            // 💰 HITUNG BAGI HASIL
            // ===============================
            $total = $order->total_price;

            $companyFee     = $order->company_income ?? ($total * 0.2);
            $terapisIncome  = $total - $companyFee;

            // ===============================
            // 💰 TERAPIS SELALU DAPAT
            // ===============================
            self::addBalance(
                $terapisWallet,
                $terapisIncome,
                $order,
                'Pendapatan Terapis'
            );

            // ===============================
            // 💰 COMPANY LOGIC
            // ===============================
            if ($order->payment_method === 'cash') {

                // CASH → belum masuk → hanya catat hutang
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

                // TRANSFER → uang sudah ada → tambah balance
                self::addBalance(
                    $companyWallet,
                    $companyFee,
                    $order,
                    'Fee Company (Dari Saldo)'
                );
            }

            // ===============================
            // 🔥 UPDATE ORDER
            // ===============================
            $order->updateQuietly([
                'company_income'    => $companyFee,
                'therapist_income' => $terapisIncome
            ]);
        });
    }

    // ===============================
    // 🔥 BAYAR HUTANG COMPANY (CASH)
    // ===============================
    public static function payCompanyFee(Transaction $order)
    {
        Log::info('PAY COMPANY FEE', [
            'order_id' => $order->id
        ]);

        // ❌ ANTI DOUBLE
        if ($order->is_company_paid) {
            return;
        }

        DB::transaction(function () use ($order) {

            $companyWallet = self::getCompanyWallet();

            $amount = $order->company_income;

            if (!$amount || $amount <= 0) {
                throw new \Exception('Invalid company income');
            }

            // 💰 TAMBAH SALDO
            self::addBalance(
                $companyWallet,
                $amount,
                $order,
                'Pembayaran Hutang Terapis'
            );

            // 🔥 UPDATE FLAG
            $order->updateQuietly([
                'is_company_paid' => true,
                'company_paid_at' => now()
            ]);
        });
    }

    // ===============================
    // 🔥 RECONCILIATION (FIX DATA)
    // ===============================
    public static function syncBalance($walletId)
    {
        $total = DB::table('wallet_transactions')
            ->where('payment_account_id', $walletId)
            ->sum('amount');

        PaymentAccount::where('id', $walletId)
            ->update(['balance' => $total]);
    }
}