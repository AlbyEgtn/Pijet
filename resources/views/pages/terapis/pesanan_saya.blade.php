@extends('layouts.terapis')

@section('title','Pesanan Saya')
@section('header','Pesanan Saya')

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
                    Riwayat & Status Pesanan
                </p>

                <h1 class="text-2xl md:text-3xl font-bold">
                    Pesanan Saya 🧾
                </h1>

                <p class="text-sm text-teal-100 mt-2">
                    Kelola semua pesanan yang telah kamu ambil
                </p>

            </div>

            <!-- TOTAL -->
            <div class="
                bg-white/10 backdrop-blur-md
                border border-white/10
                rounded-2xl
                px-5 py-4
                min-w-[180px]
            ">

                <p class="text-sm text-teal-100">
                    Total Pesanan
                </p>

                <h2 class="text-3xl font-bold mt-1">
                    {{ $transactions->count() }}
                </h2>

            </div>

        </div>

    </div>


    <!-- ================= FILTER ================= -->
    <div class="
        bg-white
        rounded-3xl
        p-4
        shadow-sm
        border border-gray-100
    ">

        <div class="flex gap-3 overflow-x-auto scrollbar-hide pb-1">

            <!-- SEMUA -->
            <a href="{{ route('terapis.pesanan.saya') }}"
                class="
                    whitespace-nowrap
                    px-4 py-2
                    rounded-2xl
                    text-sm font-medium
                    transition

                    {{ request('status') == null
                        ? 'bg-teal-600 text-white shadow'
                        : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
                    }}
                ">
                Semua
            </a>


            <!-- ASSIGNED -->
            <a href="{{ route('terapis.pesanan.saya', ['status'=>'assigned']) }}"
                class="
                    whitespace-nowrap
                    px-4 py-2
                    rounded-2xl
                    text-sm font-medium
                    transition

                    {{ request('status') == 'assigned'
                        ? 'bg-blue-500 text-white shadow'
                        : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
                    }}
                ">
                Diambil
            </a>


            <!-- CANCELLED -->
            <a href="{{ route('terapis.pesanan.saya', ['status'=>'cancelled']) }}"
                class="
                    whitespace-nowrap
                    px-4 py-2
                    rounded-2xl
                    text-sm font-medium
                    transition

                    {{ request('status') == 'cancelled'
                        ? 'bg-red-500 text-white shadow'
                        : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
                    }}
                ">
                Dibatalkan
            </a>


            <!-- COMPLETED -->
            <a href="{{ route('terapis.pesanan.saya', ['status'=>'completed']) }}"
                class="
                    whitespace-nowrap
                    px-4 py-2
                    rounded-2xl
                    text-sm font-medium
                    transition

                    {{ request('status') == 'completed'
                        ? 'bg-green-500 text-white shadow'
                        : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
                    }}
                ">
                Selesai
            </a>

        </div>

    </div>


    <!-- ================= LIST ================= -->
    <div class="space-y-5">

        @forelse($transactions as $trx)

        <div class="
            bg-white
            rounded-3xl
            p-5
            border border-gray-100
            shadow-sm
            hover:shadow-xl
            hover:-translate-y-1
            transition
            duration-300
        ">

            <!-- ================= HEADER ================= -->
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">

                <!-- LEFT -->
                <div class="flex items-start gap-4 min-w-0">

                    <!-- AVATAR -->
                    <div class="
                        w-14 h-14
                        rounded-2xl
                        bg-gradient-to-br from-teal-500 to-teal-700
                        text-white
                        flex items-center justify-center
                        text-lg font-bold
                        shrink-0
                    ">
                        {{ strtoupper(substr($trx->customer_name,0,1)) }}
                    </div>


                    <!-- INFO -->
                    <div class="min-w-0">

                        <p class="font-semibold text-lg text-gray-800 truncate">
                            {{ $trx->customer_name }}
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            ID {{ $trx->transaction_code }}
                        </p>

                        <div class="flex flex-wrap gap-2 mt-3">

                            <span class="
                                bg-gray-100
                                text-gray-600
                                text-xs
                                px-3 py-1
                                rounded-full
                            ">
                                📅 {{ \Carbon\Carbon::parse($trx->service_date)->format('d M Y') }}
                            </span>

                            <span class="
                                bg-gray-100
                                text-gray-600
                                text-xs
                                px-3 py-1
                                rounded-full
                            ">
                                🕒 {{ $trx->service_time }}
                            </span>

                        </div>

                    </div>

                </div>


                <!-- STATUS -->
                <span class="
                    w-fit
                    text-xs
                    px-3 py-1.5
                    rounded-full
                    font-semibold

                    @if($trx->order_status == 'assigned')
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


            <!-- ================= ADDRESS ================= -->
            <div class="
                mt-5
                bg-gray-50
                rounded-2xl
                p-4
            ">

                <p class="text-xs text-gray-400 mb-1">
                    Lokasi Customer
                </p>

                <p class="text-sm text-gray-700 leading-relaxed">
                    {{ $trx->customer_address }}
                </p>

            </div>


            <!-- ================= TOTAL ================= -->
            <div class="
                mt-5
                flex items-center justify-between
                border-t border-gray-100
                pt-4
            ">

                <div>

                    <p class="text-xs text-gray-400">
                        Total Pembayaran
                    </p>

                    <p class="text-2xl font-bold text-teal-600 mt-1">
                        Rp{{ number_format($trx->total_price,0,',','.') }}
                    </p>

                </div>

            </div>


            <!-- ================= ACTION ================= -->
            <div class="
                mt-5
                flex flex-col sm:flex-row
                gap-3
            ">

                <!-- DETAIL -->
                <a href="{{ route('terapis.pesanan.saya.detail', $trx->id) }}"
                    class="
                        flex-1
                        text-center
                        bg-teal-600
                        hover:bg-teal-700
                        transition
                        text-white
                        py-3
                        rounded-2xl
                        text-sm font-medium
                        shadow-md
                    ">

                    Lihat Detail

                </a>


                <!-- BATALKAN -->
                @if(in_array($trx->order_status, ['assigned','on_the_way']))

                <form action="{{ route('terapis.pesanan.batal', $trx->id) }}"
                    method="POST"
                    class="flex-1">

                    @csrf

                    <button
                        class="
                            w-full
                            border border-red-500
                            text-red-500
                            py-3
                            rounded-2xl
                            text-sm font-medium
                            hover:bg-red-50
                            transition
                        ">

                        Batalkan

                    </button>

                </form>

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
                Belum ada pesanan
            </h2>

            <p class="text-sm text-gray-400 mt-2">
                Pesanan yang kamu ambil akan muncul di sini
            </p>

        </div>

        @endforelse

    </div>

</div>

@endsection