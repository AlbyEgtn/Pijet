<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Transaction;

class CheckTherapistDebt
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || !$user->terapis) {
            return $next($request);
        }

        $debtOrder = Transaction::where(
                'terapis_id',
                $user->terapis->id
            )
            ->where('payment_method', 'cash')
            ->where('order_status', 'completed')
            ->where('company_income', '>', 0)
            ->where('is_company_paid', false)
            ->latest()
            ->first();

        if (!$debtOrder) {
            return $next($request);
        }

        $path = $request->path();

        // Izinkan semua route pembayaran hutang
        if (
            str_starts_with($path, 'terapis/hutang')
        ) {
            return $next($request);
        }

        return redirect()
            ->route(
                'terapis.bayar.hutang',
                $debtOrder->id
            )
            ->with(
                'warning',
                'Anda memiliki hutang yang harus dibayar terlebih dahulu.'
            );
    }
}