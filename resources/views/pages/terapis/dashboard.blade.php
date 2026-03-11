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

    <div class="p-6 border-b">

        <h2 class="font-semibold">
            Pesanan Layanan
        </h2>

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

            <tr class="border-t">

                <td class="p-4">
                    Matt Shadow
                </td>

                <td class="p-4">
                    20 Agustus 2025
                </td>

                <td class="p-4 text-blue-500">
                    Menunggu
                </td>

            </tr>

        </tbody>

    </table>

</div>

@endsection