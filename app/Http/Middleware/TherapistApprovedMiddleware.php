<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TherapistApprovedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user->role !== 'terapis') {
            return $next($request);
        }

        // route yang tetap boleh diakses walaupun belum approved
        $allowedRoutes = [
            'therapist.pending',
            'therapist.rejected',

            'terapis.informasi',
            'terapis.informasi.update',

            'terapis.confirm.password',
            'terapis.confirm.check',

            'logout',
        ];

        if (in_array($request->route()->getName(), $allowedRoutes)) {
            return $next($request);
        }

        if ($user->verification_status === 'pending') {
            return redirect()->route('therapist.pending');
        }

        if ($user->verification_status === 'rejected') {
            return redirect()->route('therapist.rejected');
        }

        return $next($request);
    }
}