@extends('layouts.superadmin')

@section('title','Dashboard')
@section('header','Dashboard')

@section('content')

<div class="space-y-6">

    <!-- ================= HERO ================= -->
    <div class="
        relative overflow-hidden
        bg-gradient-to-r from-teal-600 via-teal-700 to-teal-800
        rounded-3xl
        p-6 md:p-8
        shadow-xl
        text-white
    ">

        <!-- BG EFFECT -->
        <div class="
            absolute -top-16 -right-16
            w-52 h-52
            bg-white/10
            rounded-full
            blur-3xl
        "></div>

        <div class="
            absolute -bottom-16 -left-16
            w-52 h-52
            bg-black/10
            rounded-full
            blur-3xl
        "></div>


        <div class="relative z-10">

            <p class="
                text-sm
                text-teal-100
                mb-2
            ">
                Super Admin Panel
            </p>

            <h2 class="
                text-2xl md:text-4xl
                font-bold
                leading-tight
            ">
                Kontrol Sistem Pijat.in
            </h2>

            <p class="
                text-sm md:text-base
                text-teal-100
                mt-3
                max-w-2xl
                leading-relaxed
            ">
                Monitoring pengguna, transaksi, layanan,
                dan keseluruhan aktivitas sistem dalam satu dashboard.
            </p>

        </div>

    </div>


    <!-- ================= SUMMARY ================= -->
    <div class="
        grid grid-cols-1
        sm:grid-cols-2
        xl:grid-cols-3
        gap-5
    ">

        <!-- USER -->
        <div class="
            bg-white
            rounded-3xl
            p-5 md:p-6
            shadow-sm
            border border-gray-100
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
                        Total Pengguna
                    </p>

                    <h2 class="
                        text-3xl
                        font-bold
                        text-gray-800
                        mt-2
                    ">

                        {{ \App\Models\User::count() }}

                    </h2>

                </div>


                <!-- ICON -->
                <div class="
                    w-12 h-12
                    rounded-2xl
                    bg-teal-50
                    flex items-center justify-center
                    shrink-0
                ">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6 text-teal-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2m10-10a4 4 0 11-8 0 4 4 0 018 0z"/>

                    </svg>

                </div>

            </div>


            <p class="
                text-xs
                text-teal-600
                mt-5
                font-medium
            ">
                Semua role dalam sistem
            </p>

        </div>


        <!-- TRANSACTION -->
        <div class="
            bg-white
            rounded-3xl
            p-5 md:p-6
            shadow-sm
            border border-gray-100
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
                        Total Transaksi
                    </p>

                    <h2 class="
                        text-3xl
                        font-bold
                        text-gray-800
                        mt-2
                    ">

                        {{ \App\Models\Transaction::count() }}

                    </h2>

                </div>


                <!-- ICON -->
                <div class="
                    w-12 h-12
                    rounded-2xl
                    bg-blue-50
                    flex items-center justify-center
                    shrink-0
                ">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6 text-blue-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>

                    </svg>

                </div>

            </div>


            <p class="
                text-xs
                text-blue-600
                mt-5
                font-medium
            ">
                Semua aktivitas pemesanan
            </p>

        </div>


        <!-- REVENUE -->
        <div class="
            bg-white
            rounded-3xl
            p-5 md:p-6
            shadow-sm
            border border-gray-100
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
                        Total Revenue
                    </p>

                    <h2 class="
                        text-2xl md:text-3xl
                        font-bold
                        text-gray-800
                        mt-2
                        leading-tight
                    ">

                        Rp {{ number_format(
                            \App\Models\Transaction::where('order_status','completed')
                            ->sum('total_price'),
                            0,
                            ',',
                            '.'
                        ) }}

                    </h2>

                </div>


                <!-- ICON -->
                <div class="
                    w-12 h-12
                    rounded-2xl
                    bg-green-50
                    flex items-center justify-center
                    shrink-0
                ">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6 text-green-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3 1.343 3 3-1.343 3-3 3m0-12V3m0 6v6m0 6v-3"/>

                    </svg>

                </div>

            </div>


            <p class="
                text-xs
                text-green-600
                mt-5
                font-medium
            ">
                Dari transaksi selesai
            </p>

        </div>

    </div>

</div>


<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// COUNTER ANIMATION
document.querySelectorAll('.counter').forEach(counter => {
    let update = () => {
        let target = +counter.getAttribute('data-target');
        let count = +counter.innerText;
        let inc = target / 40;

        if(count < target){
            counter.innerText = Math.ceil(count + inc);
            setTimeout(update, 20);
        } else {
            counter.innerText = target;
        }
    };
    update();
});

// CHART (REAL DATA)
new Chart(document.getElementById('chart'), {
    type: 'line',
    data: {
        labels: @json($months),
        datasets: [{
            label: 'Revenue',
            data: @json($revenues),
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointRadius: 4
        }]
    },
    options: {
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                ticks: {
                    callback: value => 'Rp ' + value.toLocaleString()
                }
            }
        }
    }
});
</script>

@endsection