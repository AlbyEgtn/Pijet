<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Report;

class PenggunaController extends Controller
{
    public function index($type)
    {
        if ($type == 'pelanggan') {
            $users = User::where('role', 'customer')->paginate(10);
        } else {
            $users = User::where('role', 'terapis')
                        ->with('terapis')
                        ->paginate(10);
        }

        return view('pages.superadmin.pengguna.pelanggan', compact('users', 'type'));
    }

    public function show($type, $id)
    {
        $user = User::with(['terapis'])->findOrFail($id);

        // 🔥 ambil transaksi berdasarkan customer_id
        $transactions = \App\Models\Transaction::with('services')
            ->where('customer_id', $user->id)
            ->latest()
            ->get();

        // statistik real
        $totalLayanan = $transactions->count();
        $totalBatal = $transactions->where('status', 'dibatalkan')->count();
        $totalWarning = $user->warning_count ?? 0;

        return view('pages.superadmin.pengguna.detail', compact(
            'user',
            'type',
            'transactions',
            'totalLayanan',
            'totalBatal',
            'totalWarning'
        ));
    }

    public function suspend(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->is_suspended = true;
        $user->save();

        // optional simpan log (kalau mau nanti)
        // $request->reason
        // $request->note
        // $request->duration

        return back()->with('success', 'Akun berhasil ditangguhkan');
    }

    public function penangguhan($type)
    {
        if ($type == 'aduan') {

            // ambil data laporan (contoh pakai model Report)
            $reports = \App\Models\Report::with(['user', 'reportedUser'])
                        ->latest()
                        ->paginate(10);

            return view('pages.superadmin.penangguhan.aduan', compact('reports'));
        }

        if ($type == 'ditangguhkan') {

            $users = User::where('is_suspended', true)
                        ->latest()
                        ->paginate(10);

            return view('pages.superadmin.penangguhan.index', compact('users', 'type'));
        }

        abort(404);
    }


    public function detail($reportId)
    {
        $report = Report::with(['user','reportedUser'])
            ->findOrFail($reportId);

        return view('pages.superadmin.penangguhan.detail', compact('report'));
    }
}