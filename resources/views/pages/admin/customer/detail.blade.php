@extends('layouts.admin')

@section('title','Detail Customer')
@section('header','Detail Customer')

@section('content')

<div class="space-y-6">

    <!-- ================= HEADER ================= -->
    <div class="
        bg-gradient-to-r from-teal-600 via-teal-700 to-teal-800
        rounded-3xl
        p-5 md:p-7
        text-white
        shadow-lg
        relative overflow-hidden
    ">

        <!-- BG EFFECT -->
        <div class="
            absolute -top-10 -right-10
            w-40 h-40
            bg-white/10
            rounded-full
            blur-3xl
        "></div>

        <div class="relative z-10">

            <p class="text-sm text-teal-100 mb-1">
                Informasi Customer
            </p>

            <h2 class="text-2xl md:text-3xl font-bold">
                Detail Customer 👤
            </h2>

            <p class="text-sm text-teal-100 mt-2">
                Riwayat transaksi dan informasi pelanggan
            </p>

        </div>

    </div>


    <!-- ================= CUSTOMER INFO ================= -->
    <div class="
        bg-white
        rounded-3xl
        shadow-sm
        border border-gray-100
        p-5 md:p-6
    ">

        <div class="
            flex flex-col md:flex-row
            md:items-center
            justify-between
            gap-5
        ">

            <!-- PROFILE -->
            <div class="
                flex items-center
                gap-4
            ">

                <!-- AVATAR -->
                <div class="
                    w-16 h-16
                    rounded-2xl
                    bg-teal-600
                    text-white
                    flex items-center justify-center
                    text-xl font-bold
                    shrink-0
                ">

                    {{ strtoupper(substr($customer->customer_name,0,1)) }}

                </div>


                <!-- INFO -->
                <div>

                    <h3 class="
                        text-xl
                        font-semibold
                        text-gray-800
                    ">
                        {{ $customer->customer_name }}
                    </h3>

                    <p class="
                        text-sm
                        text-gray-400
                        mt-1
                    ">
                        Customer PijatJogja.com
                    </p>

                </div>

            </div>


            <!-- PHONE -->
            <div class="
                bg-gray-50
                rounded-2xl
                px-5 py-4
                border border-gray-100
            ">

                <p class="
                    text-xs
                    text-gray-400
                    mb-1
                ">
                    Nomor Telepon
                </p>

                <p class="
                    font-semibold
                    text-gray-700
                ">
                    {{ $customer->customer_phone }}
                </p>

            </div>

        </div>

    </div>


    <!-- ================= TRANSACTION HISTORY ================= -->
    <div class="
        bg-white
        rounded-3xl
        shadow-sm
        border border-gray-100
        overflow-hidden
    ">

        <!-- HEADER -->
        <div class="
            px-5 md:px-6
            py-5
            border-b border-gray-100
        ">

            <h3 class="
                text-lg
                font-semibold
                text-gray-800
            ">
                Riwayat Transaksi
            </h3>

            <p class="
                text-sm
                text-gray-400
                mt-1
            ">
                Daftar seluruh transaksi customer
            </p>

        </div>


        <!-- ================= MOBILE VIEW ================= -->
        <div class="block md:hidden">

            @forelse($transactions as $trx)

            @php
                $statusClass = match($trx->status) {
                    'completed', 'lunas' => 'bg-green-100 text-green-600',
                    'pending', 'process' => 'bg-yellow-100 text-yellow-600',
                    'cancelled', 'dibatalkan' => 'bg-red-100 text-red-600',
                    default => 'bg-gray-100 text-gray-600'
                };
            @endphp

            <div class="
                p-5
                border-b border-gray-100
                space-y-4
            ">

                <!-- TOP -->
                <div class="
                    flex items-start justify-between
                    gap-3
                ">

                    <div>

                        <p class="
                            font-semibold
                            text-gray-800
                        ">
                            {{ $trx->transaction_code }}
                        </p>

                        <p class="
                            text-sm
                            text-gray-400
                            mt-1
                        ">
                            {{ $trx->service_date }}
                        </p>

                    </div>


                    <!-- STATUS -->
                    <span class="
                        px-3 py-1.5
                        rounded-full
                        text-xs font-semibold
                        whitespace-nowrap
                        {{ $statusClass }}
                    ">

                        {{ ucfirst(str_replace('_',' ',$trx->status)) }}

                    </span>

                </div>


                <!-- TOTAL -->
                <div class="
                    flex items-center justify-between
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <div>

                        <p class="
                            text-xs
                            text-gray-400
                            mb-1
                        ">
                            Total Pembayaran
                        </p>

                        <p class="
                            text-lg
                            font-bold
                            text-teal-600
                        ">
                            Rp {{ number_format($trx->total_price,0,',','.') }}
                        </p>

                    </div>

                </div>

            </div>

            @empty

            <!-- EMPTY -->
            <div class="
                p-10
                text-center
            ">

                <div class="text-5xl mb-3">
                    📭
                </div>

                <p class="
                    text-gray-500
                    font-medium
                ">
                    Tidak ada transaksi
                </p>

            </div>

            @endforelse

        </div>


        <!-- ================= DESKTOP TABLE ================= -->
        <div class="hidden md:block overflow-x-auto">

            <table class="min-w-full text-sm">

                <!-- HEADER -->
                <thead class="
                    bg-gray-50
                    text-gray-500
                    text-xs
                    uppercase
                ">

                    <tr>

                        <th class="px-6 py-4 text-left font-medium">
                            Kode
                        </th>

                        <th class="px-6 py-4 text-center font-medium">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-center font-medium">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right font-medium">
                            Total
                        </th>

                    </tr>

                </thead>


                <!-- BODY -->
                <tbody class="divide-y divide-gray-100">

                    @forelse($transactions as $trx)

                    @php
                        $statusClass = match($trx->status) {
                            'completed', 'lunas' => 'bg-green-100 text-green-600',
                            'pending', 'process' => 'bg-yellow-100 text-yellow-600',
                            'cancelled', 'dibatalkan' => 'bg-red-100 text-red-600',
                            default => 'bg-gray-100 text-gray-600'
                        };
                    @endphp

                    <tr class="hover:bg-gray-50 transition">

                        <!-- CODE -->
                        <td class="
                            px-6 py-5
                            font-medium
                            text-gray-800
                        ">

                            {{ $trx->transaction_code }}

                        </td>


                        <!-- DATE -->
                        <td class="
                            px-6 py-5
                            text-center
                            text-gray-600
                        ">

                            {{ $trx->service_date }}

                        </td>


                        <!-- STATUS -->
                        <td class="
                            px-6 py-5
                            text-center
                        ">

                            <span class="
                                inline-flex items-center
                                px-3 py-1.5
                                rounded-full
                                text-xs font-semibold
                                {{ $statusClass }}
                            ">

                                {{ ucfirst(str_replace('_',' ',$trx->status)) }}

                            </span>

                        </td>


                        <!-- TOTAL -->
                        <td class="
                            px-6 py-5
                            text-right
                            font-semibold
                            text-teal-600
                        ">

                            Rp {{ number_format($trx->total_price,0,',','.') }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4"
                            class="
                                text-center
                                p-10
                                text-gray-400
                            ">

                            Tidak ada transaksi

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection