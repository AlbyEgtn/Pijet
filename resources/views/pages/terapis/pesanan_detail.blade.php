@extends('layouts.terapis')

@section('title','Detail Pesanan')
@section('header','Detail Pesanan')

@section('content')

<div class="max-w-5xl mx-auto space-y-6">

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
                    Detail Transaksi
                </p>

                <h1 class="text-2xl md:text-3xl font-bold">
                    Detail Pesanan 📋
                </h1>

                <p class="text-sm text-teal-100 mt-2">
                    ID {{ $transaction->transaction_code }}
                </p>

            </div>


            <!-- STATUS -->
            <span class="
                w-fit
                text-sm
                px-4 py-2
                rounded-2xl
                font-semibold

                @if($transaction->order_status == 'ready')
                    bg-yellow-100 text-yellow-700

                @elseif($transaction->order_status == 'assigned')
                    bg-blue-100 text-blue-700

                @elseif($transaction->order_status == 'ongoing')
                    bg-purple-100 text-purple-700

                @elseif($transaction->order_status == 'completed')
                    bg-green-100 text-green-700

                @elseif($transaction->order_status == 'cancelled')
                    bg-red-100 text-red-700

                @else
                    bg-gray-100 text-gray-600
                @endif
            ">

                {{ ucfirst(str_replace('_',' ',$transaction->order_status)) }}

            </span>

        </div>

    </div>


    <!-- ================= CUSTOMER ================= -->
    <div class="
        bg-white
        rounded-3xl
        shadow-sm
        border border-gray-100
        p-5 md:p-6
    ">

        <div class="flex items-center gap-3 mb-6">

            <div class="
                w-14 h-14
                rounded-2xl
                bg-gradient-to-br from-teal-500 to-teal-700
                text-white
                flex items-center justify-center
                text-lg font-bold
            ">
                {{ strtoupper(substr($transaction->customer_name,0,1)) }}
            </div>

            <div>

                <h2 class="font-semibold text-gray-800 text-lg">
                    Informasi Customer
                </h2>

                <p class="text-sm text-gray-400">
                    Detail data pelanggan
                </p>

            </div>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-sm">

            <!-- NAMA -->
            <div class="
                bg-gray-50
                rounded-2xl
                p-4
            ">

                <p class="text-gray-400 text-xs mb-1">
                    Nama Customer
                </p>

                <p class="font-semibold text-gray-700">
                    {{ $transaction->customer_name }}
                </p>

            </div>


            <!-- TELEPON -->
            <div class="
                bg-gray-50
                rounded-2xl
                p-4
            ">

                <p class="text-gray-400 text-xs mb-1">
                    Nomor Telepon
                </p>

                <p class="font-semibold text-gray-700">
                    {{ $transaction->customer_phone ?? '-' }}
                </p>

            </div>


            <!-- ALAMAT -->
            <div class="
                bg-gray-50
                rounded-2xl
                p-4
                md:col-span-2
            ">

                <p class="text-gray-400 text-xs mb-1">
                    Alamat Lengkap
                </p>

                <p class="font-semibold text-gray-700 leading-relaxed">
                    {{ $transaction->customer_address }}
                </p>

            </div>


            <!-- KOTA -->
            <div class="
                bg-gray-50
                rounded-2xl
                p-4
            ">

                <p class="text-gray-400 text-xs mb-1">
                    Kota
                </p>

                <p class="font-semibold text-gray-700">
                    {{ $transaction->customer_city }}
                </p>

            </div>

        </div>

    </div>


    <!-- ================= LAYANAN ================= -->
    <div class="
        bg-white
        rounded-3xl
        shadow-sm
        border border-gray-100
        p-5 md:p-6
    ">

        <div class="mb-5">

            <h2 class="font-semibold text-gray-800 text-lg">
                Detail Layanan
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Daftar layanan yang dipilih customer
            </p>

        </div>


        <div class="space-y-4">

            @forelse($transaction->services as $service)

            <div class="
                flex flex-col sm:flex-row
                sm:items-center sm:justify-between
                gap-4
                border border-gray-100
                rounded-2xl
                p-4
                hover:shadow-md
                transition
            ">

                <!-- LEFT -->
                <div>

                    <p class="font-semibold text-gray-800">
                        {{ $service->service_name }}
                    </p>

                    <p class="text-sm text-gray-500 mt-1">
                        ⏱ {{ $service->duration }} menit
                    </p>

                </div>


                <!-- PRICE -->
                <div class="
                    text-lg
                    font-bold
                    text-teal-600
                ">
                    Rp{{ number_format($service->price ?? 0,0,',','.') }}
                </div>

            </div>

            @empty

            <div class="
                text-center
                py-10
                text-gray-400
            ">
                Tidak ada layanan
            </div>

            @endforelse

        </div>

    </div>


    <!-- ================= JADWAL ================= -->
    <div class="
        bg-white
        rounded-3xl
        shadow-sm
        border border-gray-100
        p-5 md:p-6
    ">

        <div class="mb-5">

            <h2 class="font-semibold text-gray-800 text-lg">
                Jadwal Pelayanan
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Waktu layanan customer
            </p>

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <!-- TANGGAL -->
            <div class="
                bg-gray-50
                rounded-2xl
                p-4
            ">

                <p class="text-xs text-gray-400 mb-1">
                    Tanggal
                </p>

                <p class="font-semibold text-gray-700">
                    📅 {{ \Carbon\Carbon::parse($transaction->service_date)->format('d M Y') }}
                </p>

            </div>


            <!-- JAM -->
            <div class="
                bg-gray-50
                rounded-2xl
                p-4
            ">

                <p class="text-xs text-gray-400 mb-1">
                    Jam
                </p>

                <p class="font-semibold text-gray-700">
                    🕒 {{ $transaction->service_time }}
                </p>

            </div>

        </div>

    </div>


    <!-- ================= PEMBAYARAN ================= -->
    <div class="
        bg-white
        rounded-3xl
        shadow-sm
        border border-gray-100
        p-5 md:p-6
    ">

        <div class="mb-5">

            <h2 class="font-semibold text-gray-800 text-lg">
                Informasi Pembayaran
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Status dan total pembayaran
            </p>

        </div>


        <div class="space-y-4">

            <!-- STATUS -->
            <div class="
                flex items-center justify-between
                bg-gray-50
                rounded-2xl
                p-4
            ">

                <span class="text-sm text-gray-500">
                    Status Pembayaran
                </span>

                <span class="
                    text-sm
                    font-semibold
                    text-green-600
                ">
                    {{ ucfirst($transaction->payment_status) }}
                </span>

            </div>


            <!-- TOTAL -->
            <div class="
                flex items-center justify-between
                bg-teal-50
                rounded-2xl
                p-5
            ">

                <span class="text-gray-600 font-medium">
                    Total Pembayaran
                </span>

                <span class="
                    text-2xl
                    font-bold
                    text-teal-600
                ">
                    Rp{{ number_format($transaction->total_price,0,',','.') }}
                </span>

            </div>

        </div>

    </div>


    <!-- ================= ACTION ================= -->
    <div class="space-y-4">

        @php
            $canTake =
                $terapis->status == 1 &&
                $transaction->payment_status == 'verified' &&
                $transaction->order_status == 'ready' &&
                is_null($transaction->terapis_id);
        @endphp


        @if($canTake)

        <form action="{{ route('terapis.pesanan.ambil', $transaction->id) }}"
            method="POST">

            @csrf

            <button
                class="
                    w-full
                    bg-teal-600
                    hover:bg-teal-700
                    transition
                    text-white
                    py-4
                    rounded-2xl
                    font-semibold
                    shadow-lg
                ">

                Ambil Pesanan

            </button>

        </form>

        @else

        <div class="
            bg-gray-100
            text-gray-600
            text-center
            p-4
            rounded-2xl
            text-sm
        ">

            @if($terapis->status != 1)

                Status kamu sedang OFFLINE

            @elseif($transaction->payment_status != 'verified')

                Pembayaran belum diverifikasi

            @elseif($transaction->order_status != 'ready')

                Pesanan tidak tersedia

            @elseif($transaction->terapis_id)

                Pesanan sudah diambil

            @else

                Tidak dapat mengambil pesanan

            @endif

        </div>

        @endif

    </div>

</div>

@endsection