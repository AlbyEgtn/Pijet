@extends('layouts.finance')

@section('title','Rekap Transaksi')
@section('header','Rekap Transaksi')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-6 rounded-2xl shadow">

        <h2 class="text-xl font-semibold">
            Rekap Transaksi 📊
        </h2>

        <p class="text-sm text-teal-100">
            Ringkasan keuangan dan distribusi pendapatan
        </p>

    </div>


    <!-- FILTER -->
    <form method="GET" class="bg-white p-4 rounded-2xl shadow flex gap-4 items-end">

        <div>
            <label class="text-xs text-gray-500">Status</label>
            <select name="status" class="border rounded-lg px-3 py-2 text-sm">
                <option value="">Semua</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <div>
            <label class="text-xs text-gray-500">Dari</label>
            <input type="date" name="date_from" class="border rounded-lg px-3 py-2 text-sm">
        </div>

        <div>
            <label class="text-xs text-gray-500">Sampai</label>
            <input type="date" name="date_to" class="border rounded-lg px-3 py-2 text-sm">
        </div>

        <button class="bg-teal-600 text-white px-4 py-2 rounded-lg text-sm">
            Filter
        </button>

    </form>


    <!-- SUMMARY -->
    <div class="grid grid-cols-3 gap-6">

        <div class="bg-white p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Total Transaksi</p>
            <h2 class="text-xl font-bold">
                Rp {{ number_format($totalIncome,0,',','.') }}
            </h2>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Terapis (70%)</p>
            <h2 class="text-xl font-bold text-red-500">
                Rp {{ number_format($totalTherapist,0,',','.') }}
            </h2>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <p class="text-sm text-gray-500">Perusahaan (30%)</p>
            <h2 class="text-xl font-bold text-teal-700">
                Rp {{ number_format($totalCompany,0,',','.') }}
            </h2>
        </div>

    </div>


    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">

                <tr>
                    <th class="px-4 py-3 text-left">Kode</th>
                    <th class="px-4 py-3 text-left">Customer</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Total</th>
                    <th class="px-4 py-3 text-left">Terapis</th>
                    <th class="px-4 py-3 text-left">Company</th>
                    <th class="px-4 py-3 text-left">Status</th>
                </tr>

            </thead>

            <tbody class="divide-y">

                @foreach($transactions as $trx)

                <tr class="hover:bg-gray-50">

                    <td class="px-4 py-3 font-medium">
                        {{ $trx->transaction_code }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $trx->customer_name }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $trx->created_at->format('d M Y') }}
                    </td>

                    <td class="px-4 py-3">
                        Rp {{ number_format($trx->total_price,0,',','.') }}
                    </td>

                    <td class="px-4 py-3 text-red-500">
                        Rp {{ number_format($trx->therapist_income ?? 0,0,',','.') }}
                    </td>

                    <td class="px-4 py-3 text-teal-700">
                        Rp {{ number_format($trx->company_income ?? 0,0,',','.') }}
                    </td>

                    <td class="px-4 py-3">

                        @if($trx->order_status == 'completed')
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">
                                Completed
                            </span>
                        @elseif($trx->order_status == 'cancelled')
                            <span class="bg-red-100 text-red-500 px-2 py-1 rounded text-xs">
                                Cancelled
                            </span>
                        @else
                            <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded text-xs">
                                {{ $trx->order_status }}
                            </span>
                        @endif

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>


    <!-- PAGINATION -->
    <div>
        {{ $transactions->links() }}
    </div>

</div>

@endsection