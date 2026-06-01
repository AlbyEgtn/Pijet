@extends('layouts.terapis')

@section('title','Pesanan')
@section('header','Pesanan')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

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

        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-5">

            <div>

                <p class="text-sm text-teal-100 mb-1">
                    Daftar Pesanan
                </p>

                <h1 class="text-2xl md:text-3xl font-bold">
                    Pesanan Tersedia
                </h1>

                <p class="text-sm text-teal-100 mt-2">
                    Ambil pesanan sesuai lokasi kamu
                </p>

            </div>

            <!-- TOTAL -->
            <div class="
                bg-white/10 backdrop-blur-md
                border border-white/10
                rounded-2xl
                px-5 py-4
                min-w-[160px]
            ">

                <p class="text-sm text-teal-100">
                    Total Pesanan
                </p>

                <h2 class="text-3xl font-bold mt-1">
                    {{ $transactions->count() ?? 0 }}
                </h2>

            </div>

        </div>

    </div>


    <!-- ================= ALERT ================= -->
    @if(session('error'))

    <div class="
        bg-red-50 border border-red-200
        text-red-700
        px-4 py-3
        rounded-2xl
        text-sm
    ">
        {{ session('error') }}
    </div>

    @endif


    <!-- ================= LIST ================= -->
    <div class="space-y-5">

        @forelse($transactions as $trx)

        <div class="
            bg-white
            border border-gray-100
            rounded-3xl
            p-5
            shadow-sm
            hover:shadow-xl
            hover:-translate-y-1
            transition
            duration-300
        ">

            <div class="flex flex-col lg:flex-row lg:justify-between gap-5">

                <!-- ================= LEFT ================= -->
                <div class="flex gap-4 min-w-0">

                    <!-- AVATAR -->
                    <div class="
                        w-14 h-14
                        bg-gradient-to-br from-teal-500 to-teal-700
                        text-white
                        flex items-center justify-center
                        rounded-2xl
                        font-bold text-lg
                        shrink-0
                    ">
                        {{ strtoupper(substr($trx->customer_name,0,1)) }}
                    </div>


                    <!-- INFO -->
                    <div class="space-y-2 min-w-0">

                        <div>

                            <p class="font-semibold text-gray-800 text-lg truncate">
                                {{ $trx->customer_name }}
                            </p>

                            <p class="text-sm text-gray-500">
                                📍 {{ $trx->customer_city ?? '-' }}
                            </p>

                        </div>


                        <!-- SERVICE -->
                        <div class="
                            bg-gray-50
                            rounded-2xl
                            px-4 py-3
                        ">

                            <p class="text-sm font-medium text-gray-700">
                                {{ $trx->services->first()->service_name ?? '-' }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                ⏱ {{ $trx->services->first()->duration ?? 0 }} menit
                            </p>

                        </div>


                        <!-- DATE -->
                        <div class="flex flex-wrap items-center gap-2 text-xs text-gray-500">

                            <span class="
                                bg-gray-100
                                px-3 py-1
                                rounded-full
                            ">
                                📅 {{ \Carbon\Carbon::parse($trx->service_date)->format('d M Y') }}
                            </span>

                            <span class="
                                bg-gray-100
                                px-3 py-1
                                rounded-full
                            ">
                                🕒 {{ $trx->service_time }}
                            </span>

                        </div>

                    </div>

                </div>


                <!-- ================= RIGHT ================= -->
                <div class="flex flex-col justify-between gap-4 lg:items-end">

                    <!-- PRICE -->
                    <div>

                        <p class="text-xs text-gray-400">
                            Total Pembayaran
                        </p>

                        <p class="text-2xl font-bold text-teal-600 mt-1">
                            Rp{{ number_format($trx->total_price,0,',','.') }}
                        </p>

                    </div>


                    <!-- STATUS -->
                    <span class="
                        w-fit
                        text-xs px-3 py-1.5 rounded-full font-semibold

                        @if($trx->order_status == 'ready')
                            bg-yellow-100 text-yellow-700

                        @elseif($trx->order_status == 'assigned')
                            bg-blue-100 text-blue-700

                        @elseif($trx->order_status == 'completed')
                            bg-green-100 text-green-700

                        @elseif($trx->order_status == 'cancelled')
                            bg-red-100 text-red-700

                        @else
                            bg-gray-100 text-gray-600
                        @endif
                    ">

                        {{ ucfirst(str_replace('_',' ',$trx->order_status)) }}

                    </span>

                </div>

            </div>


            <!-- ================= FOOTER ================= -->
            <div class="
                mt-6
                pt-4
                border-t border-gray-100
                flex flex-col sm:flex-row
                sm:items-center sm:justify-between
                gap-3
            ">

                <!-- DETAIL -->
                <a href="{{ route('terapis.pesanan.detail', $trx->id) }}"
                    class="
                        text-sm
                        text-teal-600
                        font-medium
                        hover:text-teal-700
                        transition
                    ">
                    Lihat Detail →
                </a>


                <!-- BUTTON -->
                @if($terapis->status == 1)

                    <form action="{{ route('terapis.pesanan.ambil', $trx->id) }}"
                        method="POST"
                        class="w-full sm:w-auto">

                        @csrf

                        <button
                            class="
                                w-full sm:w-auto
                                bg-teal-600
                                hover:bg-teal-700
                                transition
                                text-white
                                text-sm
                                font-medium
                                px-5 py-2.5
                                rounded-2xl
                                shadow-md
                            ">

                            Ambil Pesanan

                        </button>

                    </form>

                @else

                    <button disabled
                        class="
                            w-full sm:w-auto
                            bg-gray-200
                            text-gray-500
                            text-sm
                            px-5 py-2.5
                            rounded-2xl
                            cursor-not-allowed
                        ">

                        Status Offline

                    </button>

                @endif

            </div>

        </div>

        @empty


        <!-- ================= EMPTY ================= -->
        <div class="
            bg-white
            rounded-3xl
            p-10
            text-center
            border border-gray-100
            shadow-sm
        ">

            <div class="text-6xl mb-4">
                📭
            </div>

            <h2 class="text-lg font-semibold text-gray-700">
                Tidak ada pesanan tersedia
            </h2>

            <p class="text-sm text-gray-400 mt-2">
                Pesanan baru akan muncul otomatis di sini
            </p>

        </div>

        @endforelse

    </div>


    <!-- ================= PAGINATION ================= -->
    @if(method_exists($transactions, 'links'))

    <div class="pt-2">
        {{ $transactions->links() }}
    </div>

    @endif

</div>

@endsection