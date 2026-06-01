@extends('layouts.finance')

@section('title','Dashboard')
@section('header','Dashboard Finance')

@section('content')

<div class="space-y-6">

    <!-- ================= HERO ================= -->
    <div class="
        relative overflow-hidden
        bg-gradient-to-r from-teal-600 via-teal-700 to-teal-800
        rounded-3xl
        p-6 md:p-8
        text-white
        shadow-xl
    ">

        <!-- BG -->
        <div class="
            absolute -top-10 -right-10
            w-56 h-56
            bg-white/10
            rounded-full
            blur-3xl
        "></div>

        <div class="
            relative z-10
            flex flex-col lg:flex-row
            lg:items-center
            lg:justify-between
            gap-6
        ">

            <!-- LEFT -->
            <div>

                <p class="
                    text-sm
                    text-teal-100
                    mb-2
                ">
                    Finance Dashboard
                </p>

                <h2 class="
                    text-2xl md:text-4xl
                    font-bold
                ">
                    Monitoring Keuangan
                </h2>

                <p class="
                    text-sm md:text-base
                    text-teal-100
                    mt-3
                    max-w-2xl
                ">
                    Pantau pemasukan, pengeluaran, transaksi, dan performa bisnis secara realtime.
                </p>

            </div>


            <!-- SUMMARY -->
            <div class="
                flex flex-wrap
                gap-4
            ">

                <!-- TOTAL -->
                <div class="
                    bg-white/10
                    backdrop-blur
                    rounded-2xl
                    px-5 py-4
                    min-w-[160px]
                ">

                    <p class="
                        text-xs
                        text-teal-100
                    ">
                        Total Revenue
                    </p>

                    <h3 class="
                        text-2xl
                        font-bold
                        mt-1
                    ">
                        Rp {{ number_format($grossIncome,0,',','.') }}
                    </h3>

                </div>


                <!-- BALANCE -->
                <div class="
                    bg-white/10
                    backdrop-blur
                    rounded-2xl
                    px-5 py-4
                    min-w-[160px]
                ">

                    <p class="
                        text-xs
                        text-teal-100
                    ">
                        Saldo Saat Ini
                    </p>

                    <h3 class="
                        text-2xl
                        font-bold
                        mt-1
                    ">
                        Rp {{ number_format($balance,0,',','.') }}
                    </h3>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= STATISTICS ================= -->
    <div class="
        grid grid-cols-1
        sm:grid-cols-2
        xl:grid-cols-4
        gap-5
    ">

        <!-- INCOME -->
        <div class="
            bg-white
            rounded-3xl
            p-5
            border border-gray-100
            shadow-sm
            hover:shadow-md
            transition
        ">

            <div class="
                flex items-start justify-between
                gap-4
            ">

                <div>

                    <p class="
                        text-sm
                        text-gray-400
                    ">
                        Total Pemasukan
                    </p>

                    <h2 class="
                        text-xl md:text-2xl
                        font-bold
                        text-teal-700
                        mt-2
                    ">
                        Rp {{ number_format($grossIncome,0,',','.') }}
                    </h2>

                </div>


                <!-- ICON -->
                <div class="
                    w-12 h-12
                    rounded-2xl
                    bg-teal-100
                    text-teal-700
                    flex items-center justify-center
                    text-xl
                ">
                    ⬇
                </div>

            </div>

        </div>


        <!-- EXPENSE -->
        <div class="
            bg-white
            rounded-3xl
            p-5
            border border-gray-100
            shadow-sm
            hover:shadow-md
            transition
        ">

            <div class="
                flex items-start justify-between
                gap-4
            ">

                <div>

                    <p class="
                        text-sm
                        text-gray-400
                    ">
                        Total Pengeluaran
                    </p>

                    <h2 class="
                        text-xl md:text-2xl
                        font-bold
                        text-red-500
                        mt-2
                    ">
                        Rp {{ number_format($totalExpense,0,',','.') }}
                    </h2>

                </div>


                <!-- ICON -->
                <div class="
                    w-12 h-12
                    rounded-2xl
                    bg-red-100
                    text-red-500
                    flex items-center justify-center
                    text-xl
                ">
                    ⬆
                </div>

            </div>

        </div>


        <!-- PROFIT -->
        <div class="
            bg-white
            rounded-3xl
            p-5
            border border-gray-100
            shadow-sm
            hover:shadow-md
            transition
        ">

            <div class="
                flex items-start justify-between
                gap-4
            ">

                <div>

                    <p class="
                        text-sm
                        text-gray-400
                    ">
                        Profit Perusahaan
                    </p>

                    <h2 class="
                        text-xl md:text-2xl
                        font-bold
                        text-teal-700
                        mt-2
                    ">
                        Rp {{ number_format($companyIncome,0,',','.') }}
                    </h2>

                </div>


                <!-- ICON -->
                <div class="
                    w-12 h-12
                    rounded-2xl
                    bg-teal-100
                    text-teal-700
                    flex items-center justify-center
                    text-xl
                ">
                    📈
                </div>

            </div>

        </div>


        <!-- BALANCE -->
        <div class="
            bg-white
            rounded-3xl
            p-5
            border border-gray-100
            shadow-sm
            hover:shadow-md
            transition
        ">

            <div class="
                flex items-start justify-between
                gap-4
            ">

                <div>

                    <p class="
                        text-sm
                        text-gray-400
                    ">
                        Saldo Perusahaan
                    </p>

                    <h2 class="
                        text-xl md:text-2xl
                        font-bold
                        text-gray-800
                        mt-2
                    ">
                        Rp {{ number_format($balance,0,',','.') }}
                    </h2>

                </div>


                <!-- ICON -->
                <div class="
                    w-12 h-12
                    rounded-2xl
                    bg-gray-100
                    text-gray-700
                    flex items-center justify-center
                    text-xl
                ">
                    💰
                </div>

            </div>

        </div>

    </div>


    <!-- ================= REKAP CHART ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        p-5 md:p-6
    ">

        <!-- HEADER -->
        <div class="
            flex flex-col sm:flex-row
            sm:items-center
            sm:justify-between
            gap-3
            mb-6
        ">

            <div>

                <h3 class="
                    text-lg
                    font-semibold
                    text-gray-800
                ">
                    Rekap Bulanan
                </h3>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Statistik booking dan pemasukan tahunan.
                </p>

            </div>


            <span class="
                px-4 py-2
                rounded-2xl
                bg-teal-50
                text-teal-700
                text-sm font-medium
                w-fit
            ">
                {{ date('Y') }}
            </span>

        </div>


        <!-- CHART -->
        <div class="
            relative
            h-[320px] md:h-[420px]
        ">

            <canvas id="rekapChart"></canvas>

        </div>

    </div>


    <!-- ================= BOTTOM CHART ================= -->
    <div class="
        grid grid-cols-1
        xl:grid-cols-2
        gap-6
    ">

        <!-- SERVICE -->
        <div class="
            bg-white
            rounded-3xl
            border border-gray-100
            shadow-sm
            p-5 md:p-6
        ">

            <div class="mb-5">

                <h3 class="
                    text-lg
                    font-semibold
                    text-gray-800
                ">
                    Layanan Terpopuler
                </h3>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Statistik layanan paling banyak digunakan.
                </p>

            </div>


            <div class="
                relative
                h-[300px]
            ">

                <canvas id="serviceChart"></canvas>

            </div>

        </div>


        <!-- ORDER -->
        <div class="
            bg-white
            rounded-3xl
            border border-gray-100
            shadow-sm
            p-5 md:p-6
        ">

            <div class="mb-5">

                <h3 class="
                    text-lg
                    font-semibold
                    text-gray-800
                ">
                    Status Pesanan
                </h3>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Perbandingan transaksi selesai dan dibatalkan.
                </p>

            </div>


            <div class="
                relative
                h-[300px]
            ">

                <canvas id="orderChart"></canvas>

            </div>

        </div>

    </div>

</div>

@endsection



@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    // ================= REKAP =================
    const rekapCtx = document.getElementById('rekapChart');

    if (rekapCtx) {

        new Chart(rekapCtx, {

            type: 'bar',

            data: {

                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],

                datasets: [

                    {
                        label: 'Jumlah Booking',
                        data: @json($ordersChart),
                        backgroundColor: '#0F766E',
                        borderRadius: 12
                    },

                    {
                        type: 'line',
                        label: 'Pemasukan',
                        data: @json($incomeChart),
                        borderColor: '#14B8A6',
                        backgroundColor: '#14B8A6',
                        tension: 0.4
                    }

                ]

            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        position: 'top'
                    }

                }

            }

        });

    }



    // ================= SERVICE =================
    const serviceCtx = document.getElementById('serviceChart');

    if (serviceCtx) {

        new Chart(serviceCtx, {

            type: 'pie',

            data: {

                labels: @json($serviceLabels),

                datasets: [

                    {

                        data: @json($serviceData),

                        backgroundColor: [
                            '#0F766E',
                            '#14B8A6',
                            '#5EEAD4',
                            '#99F6E4',
                            '#CCFBF1',
                            '#ECFEFF'
                        ]

                    }

                ]

            },

            options: {

                responsive: true,
                maintainAspectRatio: false

            }

        });

    }



    // ================= ORDER =================
    const orderCtx = document.getElementById('orderChart');

    if (orderCtx) {

        new Chart(orderCtx, {

            type: 'doughnut',

            data: {

                labels: ['Completed','Cancelled'],

                datasets: [

                    {

                        data: [{{ $completed }}, {{ $cancelled }}],

                        backgroundColor: [
                            '#0F766E',
                            '#EF4444'
                        ]

                    }

                ]

            },

            options: {

                responsive: true,
                maintainAspectRatio: false

            }

        });

    }

});

</script>

@endsection