@extends('layouts.terapis')

@section('title','Dashboard')
@section('header','Dashboard')

@section('content')

<div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

    <!-- ================= LEFT ================= -->
    <div class="xl:col-span-8 space-y-6">

        <!-- ================= HEADER ================= -->
        <div class="
            relative overflow-hidden
            bg-gradient-to-r from-teal-600 via-teal-700 to-teal-800
            text-white
            p-5 md:p-7
            rounded-3xl
            shadow-lg
        ">

            <!-- BG EFFECT -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                <!-- LEFT -->
                <div>

                    <p class="text-sm text-teal-100 mb-1">
                        Dashboard Terapis
                    </p>

                    <h2 class="text-2xl md:text-3xl font-bold">
                        Halo, {{ $user->name }} 👋
                    </h2>

                    <p class="text-sm text-teal-100 mt-2">
                        Siap menerima pesanan hari ini?
                    </p>

                </div>

                <!-- STATUS -->
                <form method="POST"
                    action="{{ route('terapis.update.informasi') }}">

                    @csrf

                    <input type="hidden" name="status" value="0">

                    <label class="
                        flex items-center justify-between
                        bg-white/10 backdrop-blur-md
                        border border-white/10
                        rounded-2xl
                        px-4 py-3
                        min-w-[220px]
                    ">

                        <div>

                            <p class="text-xs text-teal-100">
                                Status Terapis
                            </p>

                            <p class="font-semibold">
                                {{ $terapis->status ? 'Online' : 'Offline' }}
                            </p>

                        </div>

                        <div class="relative">

                            <input type="checkbox"
                                name="status"
                                value="1"
                                onchange="this.form.submit()"
                                {{ $terapis->status ? 'checked' : '' }}
                                class="sr-only peer">

                            <div class="
                                w-14 h-7
                                bg-white/30
                                rounded-full
                                peer-checked:bg-green-400
                                transition
                            "></div>

                            <div class="
                                absolute top-1 left-1
                                w-5 h-5 bg-white rounded-full
                                transition
                                peer-checked:translate-x-7
                            "></div>

                        </div>

                    </label>

                </form>

            </div>

        </div>


        <!-- ================= LIST PESANAN ================= -->
        <div class="bg-white rounded-3xl shadow-sm p-5 md:p-6 border border-gray-100">

            <div class="flex items-center justify-between mb-5">

                <div>

                    <h2 class="font-semibold text-gray-800 text-lg">
                        Pesanan Masuk
                    </h2>

                    <p class="text-sm text-gray-400">
                        Pesanan terbaru di area kamu
                    </p>

                </div>

                <a href="{{ route('terapis.pesanan') }}"
                    class="text-sm text-teal-600 hover:text-teal-700 font-medium">
                    Lihat Semua
                </a>

            </div>


            <div class="space-y-4">

                @forelse($transactions as $trx)

                <div class="
                    border border-gray-100
                    rounded-2xl
                    p-4
                    hover:shadow-lg
                    hover:-translate-y-1
                    transition
                    duration-300
                ">

                    <div class="flex flex-col sm:flex-row sm:justify-between gap-4">

                        <!-- LEFT -->
                        <div class="min-w-0">

                            <div class="flex items-center gap-3">

                                <div class="
                                    w-12 h-12 rounded-2xl
                                    bg-teal-100
                                    text-teal-700
                                    flex items-center justify-center
                                    font-bold
                                ">
                                    {{ strtoupper(substr($trx->customer_name,0,1)) }}
                                </div>

                                <div class="min-w-0">

                                    <p class="font-semibold text-gray-800 truncate">
                                        {{ $trx->customer_name }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $trx->customer_city }}
                                    </p>

                                </div>

                            </div>

                            <div class="mt-4">

                                <p class="text-sm text-gray-700">
                                    {{ $trx->services->first()->service_name ?? '-' }}
                                </p>

                                <p class="text-xs text-gray-400 mt-1">
                                    ⏱ {{ $trx->services->first()->duration ?? 0 }} menit
                                </p>

                            </div>

                        </div>


                        <!-- RIGHT -->
                        <div class="sm:text-right">

                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($trx->service_date)->format('d M Y') }}
                            </p>

                            <p class="text-xl font-bold text-teal-600 mt-1">
                                Rp {{ number_format($trx->total_price) }}
                            </p>

                        </div>

                    </div>


                    <!-- ACTION -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-5">

                        <span class="
                            inline-flex items-center
                            w-fit
                            px-3 py-1
                            rounded-full
                            text-xs font-semibold
                            bg-yellow-100 text-yellow-700
                        ">
                            Siap Diambil
                        </span>


                        <div class="flex gap-2 w-full sm:w-auto">

                            <!-- DETAIL -->
                            <a href="{{ route('terapis.pesanan.detail',$trx->id) }}"
                                class="
                                    flex-1 sm:flex-none
                                    text-center
                                    text-sm
                                    px-4 py-2
                                    border
                                    rounded-xl
                                    hover:bg-gray-100
                                    transition
                                ">
                                Detail
                            </a>


                            <!-- AMBIL -->
                            <form method="POST"
                                action="{{ route('terapis.pesanan.ambil',$trx->id) }}"
                                class="flex-1 sm:flex-none">

                                @csrf

                                @if($terapis->status != 1)

                                    <button disabled
                                        class="
                                            w-full
                                            text-sm
                                            bg-gray-200
                                            text-gray-500
                                            px-4 py-2
                                            rounded-xl
                                            cursor-not-allowed
                                        ">
                                        Offline
                                    </button>

                                @else

                                    <button
                                        class="
                                            w-full
                                            text-sm
                                            bg-teal-600
                                            text-white
                                            px-4 py-2
                                            rounded-xl
                                            hover:bg-teal-700
                                            transition
                                            shadow
                                        ">
                                        Ambil
                                    </button>

                                @endif

                            </form>

                        </div>

                    </div>

                </div>

                @empty

                <div class="text-center py-16">

                    <div class="text-5xl mb-3">
                        
                    </div>

                    <p class="text-gray-500 font-medium">
                        Belum ada pesanan di kota kamu
                    </p>

                    <p class="text-sm text-gray-400 mt-1">
                        Pesanan baru akan muncul di sini
                    </p>

                </div>

                @endforelse

            </div>

        </div>

    </div>


    <!-- ================= RIGHT ================= -->
    <div class="xl:col-span-4 space-y-6">

        <!-- ================= PROFIL ================= -->
        <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-100">

            <div class="flex items-center gap-4 mb-5">

                <div class="
                    w-14 h-14 rounded-2xl
                    bg-gradient-to-br from-teal-500 to-teal-700
                    text-white
                    flex items-center justify-center
                    text-xl font-bold
                ">
                    {{ strtoupper(substr($user->name,0,1)) }}
                </div>

                <div>

                    <h2 class="font-semibold text-gray-800">
                        {{ $user->name }}
                    </h2>

                    <p class="text-sm text-gray-400">
                        Terapis Aktif
                    </p>

                </div>

            </div>


            <div class="space-y-4 text-sm">

                <!-- WHATSAPP -->
                <div class="flex justify-between items-center">

                    <span class="text-gray-500">
                        WhatsApp
                    </span>

                    <span class="font-medium text-gray-700">
                        {{ $user->phone ?? '-' }}
                    </span>

                </div>


                <!-- STATUS -->
                <div class="flex justify-between items-center">

                    <span class="text-gray-500">
                        Status
                    </span>

                    <span class="
                        px-3 py-1 rounded-full text-xs font-semibold
                        {{ $terapis->status
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-600'
                        }}
                    ">
                        {{ $terapis->status ? 'Online' : 'Offline' }}
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection