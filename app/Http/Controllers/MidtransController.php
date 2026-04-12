<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use App\Helpers\FinanceHelper;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $payload = json_decode($request->getContent(), true);

        Log::info('MIDTRANS CALLBACK', [
            'payload' => $payload
        ]);

        $orderId = $payload['order_id'] ?? null;
        $status  = $payload['transaction_status'] ?? null;

        if (!$orderId) {
            return response()->json(['message' => 'no order id'], 400);
        }

        DB::transaction(function () use ($orderId, $status) {

            // ===============================
            // 🔥 HANDLE HUTANG (IMPORTANT)
            // ===============================
            if (str_starts_with($orderId, 'HUTANG-')) {

                if (!preg_match('/HUTANG-(\d+)-/', $orderId, $match)) {
                    Log::error('INVALID HUTANG FORMAT', ['order_id' => $orderId]);
                    return;
                }

                $transactionId = (int) $match[1];

                $order = Transaction::lockForUpdate()->find($transactionId);

                if (!$order) {
                    Log::error('HUTANG ORDER NOT FOUND', ['id' => $transactionId]);
                    return;
                }

                if (in_array($status, ['settlement', 'capture'])) {

                    Log::info('HUTANG PAYMENT SUCCESS', [
                        'order_id' => $order->id
                    ]);

                    FinanceHelper::payCompanyFee($order->fresh());
                }

                return;
            }

            // ===============================
            // 🔥 HANDLE ORDER NORMAL
            // ===============================
            $order = Transaction::lockForUpdate()
                ->where('midtrans_order_id', $orderId)
                ->first();

            if (!$order) {
                Log::error('ORDER NOT FOUND', ['order_id' => $orderId]);
                return;
            }

            if (in_array($status, ['settlement', 'capture'])) {

                if ($order->payment_status !== 'verified') {

                    $order->update([
                        'payment_status'      => 'verified',
                        'order_status'        => 'ready',
                        'payment_verified_at' => now()
                    ]);

                    FinanceHelper::handlePaymentVerified($order->fresh());
                }
            }

            elseif ($status === 'pending') {

                $order->update([
                    'payment_status' => 'pending'
                ]);
            }

            elseif (in_array($status, ['expire', 'cancel', 'deny'])) {

                $order->update([
                    'payment_status' => 'failed',
                    'order_status'   => 'cancelled'
                ]);
            }
        });

        return response()->json(['message' => 'ok']);
    }
}