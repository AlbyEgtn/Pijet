@extends('layouts.admin')

@section('title','Dashboard Admin')
@section('header','Dashboard Admin')

@section('content')

<div class="space-y-6">

    <!-- RINGKASAN -->
    <div class="bg-[#DDEEE7] rounded-xl p-6">

        <h2 class="font-semibold text-gray-700 mb-4">
            Ringkasan
        </h2>

        <div class="grid grid-cols-4 gap-4">

            <!-- TOTAL CUSTOMER -->
            <div class="bg-white rounded-xl p-5 flex items-center justify-between shadow-sm">

                <div>

                    <p class="text-gray-500 text-sm">
                        Total Customer
                    </p>

                    <h2 class="text-2xl font-bold mt-1">
                        {{ $totalCustomers }}
                    </h2>

                    <p class="text-xs text-gray-400">
                        Lihat selengkapnya
                    </p>

                </div>

                <div class="text-blue-400 text-3xl">
                    👤
                </div>

            </div>


            <!-- TOTAL TERAPIS -->
            <div class="bg-white rounded-xl p-5 flex items-center justify-between shadow-sm">

                <div>

                    <p class="text-gray-500 text-sm">
                        Total Terapis
                    </p>

                    <h2 class="text-2xl font-bold mt-1">
                        {{ $totalTherapists }}
                    </h2>

                    <p class="text-xs text-gray-400">
                        Lihat selengkapnya
                    </p>

                </div>

                <div class="text-blue-400 text-3xl">
                    👨‍⚕️
                </div>

            </div>


            <!-- PESANAN SELESAI -->
            <div class="bg-white rounded-xl p-5 flex items-center justify-between shadow-sm">

                <div>

                    <p class="text-gray-500 text-sm">
                        Total Pesanan Selesai
                    </p>

                    <h2 class="text-2xl font-bold mt-1">
                        {{ $totalCompletedOrders }}
                    </h2>

                    <p class="text-xs text-blue-500">
                        Lihat laporan
                    </p>

                </div>

                <div class="text-green-500 text-3xl">
                    ✔
                </div>

            </div>


            <!-- PESANAN DIBATALKAN -->
            <div class="bg-white rounded-xl p-5 flex items-center justify-between shadow-sm">

                <div>

                    <p class="text-gray-500 text-sm">
                        Total Pesanan Dibatalkan
                    </p>

                    <h2 class="text-2xl font-bold mt-1">
                        {{ $totalCancelledOrders }}
                    </h2>

                    <p class="text-xs text-blue-500">
                        Lihat laporan
                    </p>

                </div>

                <div class="text-red-500 text-3xl">
                    ✖
                </div>

            </div>

        </div>

    </div>



    <!-- CHART + LAYANAN -->
    <div class="grid grid-cols-3 gap-6">

        <!-- CHART -->
        <div class="col-span-2 bg-[#DDEEE7] rounded-xl p-6">

            <div class="flex justify-between items-center mb-4">

                <h3 class="font-semibold text-gray-700">
                    Chart Pemesanan Tahunan
                </h3>

            </div>

            <canvas id="orderChart" class="h-56"></canvas>

        </div>


        <!-- LAYANAN TERPOPULER -->
        <div class="bg-[#DDEEE7] rounded-xl p-6">

            <div class="flex justify-between items-center mb-4">

                <h3 class="font-semibold text-gray-700">
                    Layanan Terpopuler
                </h3>

            </div>

            <div class="space-y-4">

                @foreach($popularServices as $index => $service)

                <div class="flex justify-between items-center">

                    <span class="text-gray-700">
                        {{ $service->name }}
                    </span>

                    <span class="font-semibold
                        @if($index == 0) text-yellow-500
                        @elseif($index == 1) text-gray-500
                        @else text-red-500
                        @endif
                    ">
                        #{{ $index + 1 }}
                    </span>

                </div>

                @endforeach

            </div>

        </div>

    </div>



    <!-- TABLE -->
    <div class="grid grid-cols-2 gap-6">

        <!-- TABEL PESANAN -->
        <div class="bg-[#DDEEE7] rounded-xl p-6">

            <h3 class="font-semibold text-gray-700 mb-4">
                Tabel Pesanan Terkini
            </h3>

            <table class="w-full text-sm">

                <thead>

                    <tr class="text-gray-500 text-left">

                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    @foreach($latestOrders as $order)

                    <tr>

                        <td>
                            {{ $order->transaction_code }}
                        </td>

                        <td>
                            {{ $order->service_date }}
                        </td>

                        <td>
                            {{ $order->customer_name }}
                        </td>

                        <td>

                            @if($order->status == 'lunas')

                                <span class="text-green-500">
                                    Selesai
                                </span>

                            @elseif($order->status == 'dibatalkan')

                                <span class="text-red-500">
                                    Dibatalkan
                                </span>

                            @elseif($order->status == 'proses')

                                <span class="text-yellow-500">
                                    Proses
                                </span>

                            @else

                                <span class="text-gray-500">
                                    {{ $order->status }}
                                </span>

                            @endif

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>



        <!-- TABEL TERAPIS -->
        <div class="bg-[#DDEEE7] rounded-xl p-6">

            <h3 class="font-semibold text-gray-700 mb-4">
                Tabel Pendaftar Terapis
            </h3>

            <table class="w-full text-sm">

                <thead>

                    <tr class="text-gray-500 text-left">

                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kontak</th>
                        <th>Kota</th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    @foreach($latestTherapists as $therapist)

                    <tr>

                        <td>
                            {{ $therapist->name }}
                        </td>

                        <td>
                            {{ $therapist->email }}
                        </td>

                        <td>
                            {{ $therapist->phone }}
                        </td>

                        <td>
                            {{ $therapist->city }}
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

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

                borderColor: '#3E7F73',

                backgroundColor: 'rgba(62,127,115,0.1)',

                tension: 0.4,

                fill: true
            }

        ]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {
                display: false
            }

        },

        scales: {

            y: {
                beginAtZero: true
            }

        }

    }

});

</script>

@endsection