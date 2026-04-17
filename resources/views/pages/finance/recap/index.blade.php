@extends('layouts.finance')

@section('title','Rekap Transaksi')
@section('header','Rekap Transaksi')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-6 rounded-2xl shadow-lg flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold tracking-tight">
                Rekap Transaksi
            </h2>
            <p class="text-sm text-teal-100 mt-1">
                Ringkasan keuangan dan distribusi pendapatan
            </p>
        </div>
    </div>


    <!-- FILTER -->
    <form method="GET" class="bg-white p-5 rounded-2xl shadow flex flex-wrap gap-4 items-end">

        <div class="flex flex-col">
            <label class="text-xs text-gray-500 mb-1">Status</label>
            <select name="status" class="border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-500">
                <option value="">Semua</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <div class="flex flex-col">
            <label class="text-xs text-gray-500 mb-1">Dari</label>
            <input type="date" name="date_from" class="border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-500">
        </div>

        <div class="flex flex-col">
            <label class="text-xs text-gray-500 mb-1">Sampai</label>
            <input type="date" name="date_to" class="border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-500">
        </div>

        <button class="bg-teal-600 hover:bg-teal-700 transition text-white px-5 py-2 rounded-lg text-sm font-medium shadow">
            Terapkan Filter
        </button>

    </form>


    <!-- SUMMARY -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- TOTAL -->
        <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition">
            <p class="text-xs text-gray-400 uppercase tracking-wide">Total Transaksi</p>
            <h2 class="text-2xl font-bold text-gray-800 mt-2">
                Rp {{ number_format($totalIncome,0,',','.') }}
            </h2>
        </div>

        <!-- THERAPIST -->
        <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition">
            <p class="text-xs text-gray-400 uppercase tracking-wide">Terapis (70%)</p>
            <h2 class="text-2xl font-bold text-red-500 mt-2">
                Rp {{ number_format($totalTherapist,0,',','.') }}
            </h2>
        </div>

        <!-- COMPANY -->
        <div class="bg-white p-5 rounded-2xl shadow hover:shadow-md transition">
            <p class="text-xs text-gray-400 uppercase tracking-wide">Perusahaan (30%)</p>
            <h2 class="text-2xl font-bold text-teal-700 mt-2">
                Rp {{ number_format($totalCompany,0,',','.') }}
            </h2>
        </div>

    </div>


    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3 text-left">Kode</th>
                        <th class="px-5 py-3 text-left">Customer</th>
                        <th class="px-5 py-3 text-left">Tanggal</th>
                        <th class="px-5 py-3 text-left">Total</th>
                        <th class="px-5 py-3 text-left">Terapis</th>
                        <th class="px-5 py-3 text-left">Company</th>
                        <th class="px-5 py-3 text-left">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @foreach($transactions as $trx)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-5 py-3 font-semibold text-gray-700">
                            {{ $trx->transaction_code }}
                        </td>

                        <td class="px-5 py-3 text-gray-600">
                            {{ $trx->customer_name }}
                        </td>

                        <td class="px-5 py-3 text-gray-500">
                            {{ $trx->created_at->format('d M Y') }}
                        </td>

                        <td class="px-5 py-3 font-medium text-gray-800">
                            Rp {{ number_format($trx->total_price,0,',','.') }}
                        </td>

                        <td class="px-5 py-3 font-medium text-red-500">
                            Rp {{ number_format($trx->therapist_income ?? 0,0,',','.') }}
                        </td>

                        <td class="px-5 py-3 font-medium text-teal-700">
                            Rp {{ number_format($trx->company_income ?? 0,0,',','.') }}
                        </td>

                        <td class="px-5 py-3">
                            @if($trx->order_status == 'completed')
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-medium">
                                    Completed
                                </span>
                            @elseif($trx->order_status == 'cancelled')
                                <span class="bg-red-100 text-red-500 px-3 py-1 rounded-full text-xs font-medium">
                                    Cancelled
                                </span>
                            @else
                                <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ $trx->order_status }}
                                </span>
                            @endif
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>
        </div>

    </div>


    <!-- PAGINATION -->
    <div class="flex justify-end">
        {{ $transactions->links() }}
    </div>

</div>

@endsection