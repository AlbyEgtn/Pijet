@extends('layouts.terapis')

@section('title','Dashboard')

@section('content')

<div class="grid grid-cols-3 gap-6">

    {{-- SALDO --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <p class="text-gray-500 text-sm">
            Total Saldo
        </p>

        <h2 class="text-2xl font-bold mt-2">
            Rp {{ number_format($terapis->balance ?? 0) }}
        </h2>

    </div>


    {{-- TOTAL ORDER --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <p class="text-gray-500 text-sm">
            Total Pesanan
        </p>

        <h2 class="text-2xl font-bold mt-2">
            {{ $terapis->total_orders ?? 0 }}
        </h2>

    </div>


    {{-- STATUS --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <p class="text-gray-500 text-sm">
            Status Terapis
        </p>

        <div class="mt-2 flex items-center gap-2">

            <span class="w-3 h-3 rounded-full bg-green-500"></span>

            <span>
                Online
            </span>

        </div>

    </div>

</div>


{{-- PESANAN --}}
<div class="bg-white mt-8 rounded-xl shadow">

    <div class="p-6 border-b flex justify-between items-center">

        <h2 class="font-semibold">
            Pesanan Layanan
        </h2>

        <a href="{{ route('terapis.pesanan') }}"
           class="text-sm text-teal-600 hover:underline">
            Lihat Semua
        </a>

    </div>

    <table class="w-full text-sm">

        <thead class="bg-gray-50">
            <tr>
                <th class="p-4 text-left">Customer</th>
                <th class="p-4 text-left">Tanggal</th>
                <th class="p-4 text-left">Status</th>
            </tr>
        </thead>

        <tbody>

            @forelse($transactions as $trx)
            <tr class="border-t hover:bg-gray-50">

                <td class="p-4">
                    {{ $trx->customer_name }}
                </td>

                <td class="p-4">
                    {{ \Carbon\Carbon::parse($trx->service_date)->format('d M Y') }}
                </td>

                <td class="p-4">

                    <span class="px-2 py-1 rounded text-xs
                        @if($trx->status == 'belum_lunas') bg-yellow-100 text-yellow-700
                        @elseif($trx->status == 'proses') bg-blue-100 text-blue-700
                        @elseif($trx->status == 'lunas') bg-green-100 text-green-700
                        @elseif($trx->status == 'dibatalkan') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-700
                        @endif
                    ">
                        {{ ucfirst(str_replace('_',' ',$trx->status)) }}
                    </span>

                </td>

            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-4 text-center text-gray-500">
                    Belum ada pesanan
                </td>
            </tr>
            @endforelse
            
        </tbody>

    </table>

</div>

@endsection