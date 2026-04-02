@extends('layouts.admin')

@section('title','Detail Customer')
@section('header','Detail Customer ')

@section('content')

<div class="p-6 space-y-6">

    <h1 class="text-xl font-semibold">Detail Customer</h1>

    <!-- INFO -->
    <div class="bg-white p-4 rounded shadow">
        <p><b>Nama:</b> {{ $customer->customer_name }}</p>
        <p><b>No HP:</b> {{ $customer->customer_phone }}</p>
    </div>

    <!-- LIST TRANSAKSI -->
    <div class="bg-white p-4 rounded shadow">

        <h2 class="font-semibold mb-3">Riwayat Transaksi</h2>

        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2 text-left">Kode</th>
                    <th class="px-3 py-2 text-center">Tanggal</th>
                    <th class="px-3 py-2 text-center">Status</th>
                    <th class="px-3 py-2 text-right">Total</th>
                </tr>
            </thead>

            <tbody>
            @forelse($transactions as $trx)
                <tr class="border-b">
                    <td class="px-3 py-2">{{ $trx->transaction_code }}</td>
                    <td class="px-3 py-2 text-center">{{ $trx->service_date }}</td>
                    <td class="px-3 py-2 text-center">{{ $trx->status }}</td>
                    <td class="px-3 py-2 text-right">
                        Rp {{ number_format($trx->total_price,0,',','.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-400">
                        Tidak ada transaksi
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection