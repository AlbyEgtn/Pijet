@extends('layouts.admin')

@section('title','Dashboard Admin')
@section('header','Dashboard Admin')

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
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative z-10">

            <p class="text-sm text-teal-100 mb-1">
                Dashboard Monitoring
            </p>

            <h2 class="text-2xl md:text-3xl font-bold">
                Dashboard Admin 👋
            </h2>

            <p class="text-sm text-teal-100 mt-2">
                Monitoring sistem & performa layanan PijatJogja.com
            </p>

        </div>

    </div>


    <!-- ================= STATS ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <!-- CUSTOMER -->
        <div class="
            bg-white
            rounded-3xl
            p-5
            border border-gray-100
            shadow-sm
        ">

            <p class="text-sm text-gray-400">
                Total Customer
            </p>

            <h2 class="text-3xl font-bold text-gray-800 mt-3">
                {{ $totalCustomers }}
            </h2>

        </div>


        <!-- TERAPIS -->
        <div class="
            bg-white
            rounded-3xl
            p-5
            border border-gray-100
            shadow-sm
        ">

            <p class="text-sm text-gray-400">
                Total Terapis
            </p>

            <h2 class="text-3xl font-bold text-gray-800 mt-3">
                {{ $totalTherapists }}
            </h2>

        </div>


        <!-- SELESAI -->
        <div class="
            bg-white
            rounded-3xl
            p-5
            border border-gray-100
            shadow-sm
        ">

            <p class="text-sm text-gray-400">
                Pesanan Selesai
            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-3">
                {{ $totalCompletedOrders }}
            </h2>

        </div>


        <!-- BATAL -->
        <div class="
            bg-white
            rounded-3xl
            p-5
            border border-gray-100
            shadow-sm
        ">

            <p class="text-sm text-gray-400">
                Pesanan Batal
            </p>

            <h2 class="text-3xl font-bold text-red-500 mt-3">
                {{ $totalCancelledOrders }}
            </h2>

        </div>

    </div>


    <!-- ================= CHART ================= -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- CHART -->
        <div class="
            xl:col-span-2
            bg-white
            rounded-3xl
            p-5 md:p-6
            shadow-sm
            border border-gray-100
        ">

            <div class="mb-5">

                <h3 class="font-semibold text-gray-800 text-lg">
                    Chart Pemesanan Tahunan
                </h3>

                <p class="text-sm text-gray-400 mt-1">
                    Statistik jumlah pesanan selama 1 tahun
                </p>

            </div>

            <div class="h-[320px]">

                <canvas id="orderChart"></canvas>

            </div>

        </div>


        <!-- LAYANAN -->
        <div class="
            bg-white
            rounded-3xl
            p-5 md:p-6
            shadow-sm
            border border-gray-100
        ">

            <div class="mb-5">

                <h3 class="font-semibold text-gray-800 text-lg">
                    Layanan Terpopuler
                </h3>

                <p class="text-sm text-gray-400 mt-1">
                    Layanan paling banyak dipesan
                </p>

            </div>


            <div class="space-y-3">

                @foreach($popularServices as $index => $service)

                <div class="
                    flex items-center justify-between
                    p-4
                    rounded-2xl
                    bg-gray-50
                ">

                    <div>

                        <p class="font-medium text-gray-700">
                            {{ $service->name }}
                        </p>

                    </div>


                    <span class="
                        text-xs
                        font-semibold
                        px-3 py-1.5
                        rounded-full

                        @if($index == 0)
                            bg-yellow-100 text-yellow-700

                        @elseif($index == 1)
                            bg-gray-200 text-gray-700

                        @else
                            bg-red-100 text-red-600
                        @endif
                    ">

                        #{{ $index + 1 }}

                    </span>

                </div>

                @endforeach

            </div>

        </div>

    </div>


    <!-- ================= TABLES ================= -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- ================= PESANAN ================= -->
        <div class="
            bg-white
            rounded-3xl
            p-5 md:p-6
            shadow-sm
            border border-gray-100
            overflow-hidden
        ">

            <div class="mb-5">

                <h3 class="font-semibold text-gray-800 text-lg">
                    Pesanan Terbaru
                </h3>

                <p class="text-sm text-gray-400 mt-1">
                    Daftar transaksi terbaru
                </p>

            </div>


            <!-- MOBILE CARD -->
            <div class="space-y-4 md:hidden">

                @foreach($latestOrders as $order)

                <div class="
                    border border-gray-100
                    rounded-2xl
                    p-4
                ">

                    <div class="flex items-center justify-between gap-3">

                        <div>

                            <p class="font-semibold text-gray-700">
                                {{ $order->customer_name }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                {{ $order->transaction_code }}
                            </p>

                        </div>


                        <div>

                            @if($order->order_status == 'completed')

                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">
                                    Selesai
                                </span>

                            @elseif($order->order_status == 'cancelled')

                                <span class="bg-red-100 text-red-500 px-3 py-1 rounded-full text-xs">
                                    Batal
                                </span>

                            @elseif($order->order_status == 'process')

                                <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs">
                                    Proses
                                </span>

                            @else

                                <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs">
                                    {{ $order->order_status }}
                                </span>

                            @endif

                        </div>

                    </div>


                    <p class="text-sm text-gray-500 mt-4">
                        {{ $order->service_date }}
                    </p>

                </div>

                @endforeach

            </div>


            <!-- DESKTOP TABLE -->
            <div class="hidden md:block overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="text-left text-gray-400 border-b">

                            <th class="pb-3 font-medium">
                                ID
                            </th>

                            <th class="pb-3 font-medium">
                                Customer
                            </th>

                            <th class="pb-3 font-medium">
                                Tanggal
                            </th>

                            <th class="pb-3 font-medium">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach($latestOrders as $order)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="py-4 text-gray-700">
                                {{ $order->transaction_code }}
                            </td>

                            <td class="py-4 font-medium text-gray-700">
                                {{ $order->customer_name }}
                            </td>

                            <td class="py-4 text-gray-500">
                                {{ $order->service_date }}
                            </td>

                            <td class="py-4">

                                @if($order->order_status == 'completed')

                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">
                                        Selesai
                                    </span>

                                @elseif($order->order_status == 'cancelled')

                                    <span class="bg-red-100 text-red-500 px-3 py-1 rounded-full text-xs">
                                        Batal
                                    </span>

                                @elseif($order->order_status == 'process')

                                    <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs">
                                        Proses
                                    </span>

                                @else

                                    <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs">
                                        {{ $order->order_status }}
                                    </span>

                                @endif

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>


        <!-- ================= TERAPIS ================= -->
        <div class="
            bg-white
            rounded-3xl
            p-5 md:p-6
            shadow-sm
            border border-gray-100
            overflow-hidden
        ">

            <div class="mb-5">

                <h3 class="font-semibold text-gray-800 text-lg">
                    Terapis Terbaru
                </h3>

                <p class="text-sm text-gray-400 mt-1">
                    Terapis yang baru bergabung
                </p>

            </div>


            <div class="space-y-4">

                @foreach($latestTherapists as $therapist)

                @php
                    $city = json_decode($therapist->city, true);
                @endphp

                <div class="
                    flex items-center justify-between
                    gap-4
                    border border-gray-100
                    rounded-2xl
                    p-4
                ">

                    <!-- LEFT -->
                    <div class="flex items-center gap-4 min-w-0">

                        <!-- AVATAR -->
                        <div class="
                            w-12 h-12
                            rounded-2xl
                            bg-teal-600
                            text-white
                            flex items-center justify-center
                            font-semibold
                            shrink-0
                        ">

                            {{ strtoupper(substr($therapist->name,0,1)) }}

                        </div>


                        <!-- INFO -->
                        <div class="min-w-0">

                            <p class="font-medium text-gray-700 truncate">
                                {{ $therapist->name }}
                            </p>

                            <p class="text-sm text-gray-400 truncate">
                                {{ $therapist->email }}
                            </p>

                        </div>

                    </div>


                    <!-- CITY -->
                    <span class="
                        text-xs
                        px-3 py-1.5
                        rounded-full
                        bg-teal-50
                        text-teal-700
                        whitespace-nowrap
                    ">

                        {{ $city['name'] ?? '-' }}

                    </span>

                </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection


@section('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('orderChart');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: [
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Agu','Sep','Okt','Nov','Des'
        ],

        datasets: [
            {
                label: 'Jumlah Pesanan',
                data: @json($chartData),
                borderColor: '#0F766E',
                backgroundColor: 'rgba(15,118,110,0.12)',
                tension: 0.4,
                fill: true
            }
        ]

    },

    options: {

        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                display: false
            }
        },

        scales: {

            y: {
                beginAtZero: true,
                grid: {
                    color: '#f1f5f9'
                }
            },

            x: {
                grid: {
                    display: false
                }
            }

        }

    }

});

</script>

@endsection