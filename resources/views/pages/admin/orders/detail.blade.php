@extends('layouts.admin')

@section('title','Detail Status Pesanan')
@section('header','Detail Status Pesanan')

@section('content')

<div
    x-data="{
        showPayment:false,
        showReject:false
    }"
    class="space-y-6"
>

@php
    $startedAt = $transaction->started_at
        ? \Carbon\Carbon::parse($transaction->started_at)
        : null;

    $completedAt = $transaction->completed_at
        ? \Carbon\Carbon::parse($transaction->completed_at)
        : null;

    $duration = ($startedAt && $completedAt)
        ? $startedAt->diffInMinutes($completedAt)
        : null;
@endphp

    <!-- ================= BACK ================= -->
    <a href="{{ route('admin.orders.status') }}"
       class="
            inline-flex items-center gap-2
            text-sm
            text-gray-500
            hover:text-teal-600
            transition
       ">

        ← Kembali ke Status Order

    </a>


    <!-- ================= HEADER ================= -->
    <div class="
        bg-gradient-to-r from-teal-600 via-teal-700 to-teal-800
        rounded-3xl
        p-5 md:p-7
        text-white
        shadow-lg
        relative overflow-hidden
    ">

        <!-- BG -->
        <div class="
            absolute -top-10 -right-10
            w-40 h-40
            bg-white/10
            rounded-full
            blur-3xl
        "></div>

        <div class="
            relative z-10
            flex flex-col lg:flex-row
            lg:items-center
            lg:justify-between
            gap-5
        ">

            <!-- LEFT -->
            <div>

                <p class="text-sm text-teal-100 mb-1">
                    Detail Pesanan
                </p>

                <h2 class="
                    text-2xl md:text-3xl
                    font-bold
                ">
                    {{ $transaction->transaction_code }}
                </h2>

                <div class="
                    flex flex-wrap items-center
                    gap-2
                    mt-3
                ">

                    <span class="
                        px-3 py-1.5
                        rounded-full
                        text-xs font-semibold
                        bg-white/20
                        backdrop-blur
                    ">

                        {{ ucfirst($transaction->payment_status) }}

                    </span>


                    <span class="
                        px-3 py-1.5
                        rounded-full
                        text-xs font-semibold
                        bg-white/20
                        backdrop-blur
                    ">

                        {{ ucfirst($transaction->order_status) }}

                    </span>

                </div>

            </div>


            <!-- RIGHT -->
            <div class="
                text-left lg:text-right
                text-sm text-teal-100
            ">

                <p>
                    Tanggal :
                    <span class="font-semibold text-white">
                        {{ $transaction->created_at->format('d M Y') }}
                    </span>
                </p>

                <p class="mt-1">
                    Jam :
                    <span class="font-semibold text-white">
                        {{ $transaction->created_at->format('H:i') }} WIB
                    </span>
                </p>

            </div>

        </div>


        <!-- ================= ACTION ================= -->
        @if($transaction->payment_status === 'uploaded')

        <div class="
            flex flex-col sm:flex-row
            gap-3
            mt-6
            relative z-10
        ">

            <!-- APPROVE -->
            <form method="POST"
                action="{{ route('admin.orders.approve',$transaction->id) }}">

                @csrf

                <button class="
                    w-full sm:w-auto
                    bg-white
                    text-teal-700
                    hover:bg-gray-100
                    transition
                    px-5 py-3
                    rounded-2xl
                    text-sm font-semibold
                    shadow-sm
                ">

                    Konfirmasi Pembayaran

                </button>

            </form>


            <!-- REJECT -->
            <button
                @click="showReject = true"
                class="
                    w-full sm:w-auto
                    bg-red-500
                    hover:bg-red-600
                    transition
                    text-white
                    px-5 py-3
                    rounded-2xl
                    text-sm font-semibold
                "
            >

                Tolak Pembayaran

            </button>

        </div>

        @endif

    </div>


    <!-- ================= CONTENT ================= -->
    <div class="
        grid grid-cols-1 xl:grid-cols-3
        gap-6
    ">

        <!-- ================= LEFT ================= -->
        <div class="
            xl:col-span-2
            space-y-6
        ">

            <!-- ================= CUSTOMER INFO ================= -->
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
                        Informasi Pemesanan
                    </h3>

                    <p class="
                        text-sm
                        text-gray-400
                        mt-1
                    ">
                        Informasi lengkap customer dan lokasi
                    </p>

                </div>

                @if($transaction->terapis)

                <div class="
                    bg-white
                    rounded-3xl
                    border border-gray-100
                    shadow-sm
                    p-5 md:p-6
                ">

                    <h3 class="
                        text-lg
                        font-semibold
                        text-gray-800
                        mb-4
                    ">
                        Terapis Bertugas
                    </h3>

                    <div class="flex items-center gap-4">

                        <img
                            src="{{ $transaction->terapis->user->foto
                                ? asset('storage/'.$transaction->terapis->user->foto)
                                : 'https://ui-avatars.com/api/?name='.urlencode($transaction->terapis->user->name) }}"
                            class="w-16 h-16 rounded-2xl object-cover border">

                        <div>

                            <p class="
                                font-semibold
                                text-gray-800
                            ">
                                {{ $transaction->terapis->user->name }}
                            </p>

                            <p class="
                                text-sm
                                text-gray-500
                            ">
                                {{ $transaction->terapis->user->email }}
                            </p>

                            <p class="
                                text-sm
                                text-gray-500
                            ">
                                {{ $transaction->terapis->user->phone }}
                            </p>

                        </div>

                    </div>

                </div>

                @endif


                <div class="
                    grid grid-cols-1 md:grid-cols-2
                    gap-5 text-sm
                ">

                    <!-- PEMESAN -->
                    <div>

                        <p class="
                            text-gray-400
                            text-xs mb-1
                        ">
                            Pemesan
                        </p>

                        <p class="
                            font-medium
                            text-gray-700
                        ">
                            {{ $transaction->orderer_name ?? '-' }}
                        </p>

                    </div>


                    <!-- CUSTOMER -->
                    <div>

                        <p class="
                            text-gray-400
                            text-xs mb-1
                        ">
                            Customer
                        </p>

                        <p class="
                            font-medium
                            text-gray-700
                        ">
                            {{ $transaction->customer_name }}
                        </p>

                    </div>


                    <!-- PHONE -->
                    <div>

                        <p class="
                            text-gray-400
                            text-xs mb-1
                        ">
                            No HP
                        </p>

                        <p class="
                            font-medium
                            text-gray-700
                        ">
                            {{ $transaction->customer_phone ?? '-' }}
                        </p>

                    </div>


                    <!-- DATE -->
                    <div>

                        <p class="
                            text-gray-400
                            text-xs mb-1
                        ">
                            Tanggal Layanan
                        </p>

                        <p class="
                            font-medium
                            text-gray-700
                        ">
                            {{ $transaction->service_date }}
                        </p>

                    </div>


                    <!-- TIME -->
                    <div>

                        <p class="
                            text-gray-400
                            text-xs mb-1
                        ">
                            Jam
                        </p>

                        <p class="
                            font-medium
                            text-gray-700
                        ">
                            {{ $transaction->service_time }}
                        </p>

                    </div>


                    <!-- CITY -->
                    <div>

                        <p class="
                            text-gray-400
                            text-xs mb-1
                        ">
                            Kota
                        </p>

                        <p class="
                            font-medium
                            text-gray-700
                        ">
                            {{ $transaction->customer_city ?? '-' }}
                        </p>

                    </div>


                    <!-- ADDRESS -->
                    <div class="md:col-span-2">

                        <p class="
                            text-gray-400
                            text-xs mb-1
                        ">
                            Alamat
                        </p>

                        <div class="
                            bg-gray-50
                            rounded-2xl
                            p-4
                            text-gray-700
                            leading-relaxed
                        ">

                            {{ $transaction->customer_address ?? '-' }}

                        </div>

                    </div>

                </div>


                <!-- REJECT INFO -->
                @if($transaction->status == 'dibatalkan' && $transaction->cancel_reason)

                <div class="
                    mt-5
                    bg-red-50
                    border border-red-200
                    rounded-2xl
                    p-5
                ">

                    <p class="
                        text-sm
                        font-semibold
                        text-red-700
                        mb-2
                    ">
                        Alasan Penolakan
                    </p>

                    <p class="
                        text-sm
                        text-red-600
                        leading-relaxed
                    ">
                        {{ $transaction->cancel_reason }}
                    </p>

                </div>

                @endif

            </div>

            <!-- ================= WAKTU LAYANAN ================= -->
            @if(
                $transaction->started_at ||
                $transaction->completed_at ||
                $transaction->order_status == 'ongoing' ||
                $transaction->order_status == 'completed'
            )

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
                        Waktu Layanan
                    </h3>

                    <p class="
                        text-sm
                        text-gray-400
                        mt-1
                    ">
                        Monitoring durasi pengerjaan layanan
                    </p>

                </div>

                <div class="
                    grid grid-cols-1 md:grid-cols-3
                    gap-4
                ">

                    <!-- MULAI -->
                    <div class="
                        bg-emerald-50
                        border border-emerald-200
                        rounded-2xl
                        p-5
                        text-center
                    ">

                        <p class="
                            text-xs
                            text-gray-500
                            mb-2
                        ">
                            Mulai Layanan
                        </p>

                        @if($startedAt)

                            <p class="
                                text-2xl
                                font-bold
                                text-emerald-600
                            ">
                                {{ $startedAt->format('H:i') }}
                            </p>

                            <p class="
                                text-xs
                                text-gray-400
                                mt-2
                            ">
                                {{ $startedAt->format('d M Y') }}
                            </p>

                        @else

                            <p class="text-gray-400">
                                Belum Dimulai
                            </p>

                        @endif

                    </div>

                    <!-- DURASI -->
                    <div class="
                        bg-amber-50
                        border border-amber-200
                        rounded-2xl
                        p-5
                        text-center
                    ">

                        <p class="
                            text-xs
                            text-gray-500
                            mb-2
                        ">
                            Durasi
                        </p>

                        @if($duration !== null)

                            <p class="
                                text-2xl
                                font-bold
                                text-amber-600
                            ">

                                @if($duration >= 60)

                                    {{ intdiv($duration,60) }}j
                                    {{ $duration % 60 }}m

                                @else

                                    {{ $duration }} Menit

                                @endif

                            </p>

                            <p class="
                                text-xs
                                text-gray-400
                                mt-2
                            ">
                                {{ $duration }} menit
                            </p>

                        @elseif($startedAt)

                            <p class="
                                text-amber-600
                                font-semibold
                            ">
                                Sedang Berjalan
                            </p>

                        @else

                            <p class="text-gray-400">
                                -
                            </p>

                        @endif

                    </div>

                    <!-- SELESAI -->
                    <div class="
                        bg-blue-50
                        border border-blue-200
                        rounded-2xl
                        p-5
                        text-center
                    ">

                        <p class="
                            text-xs
                            text-gray-500
                            mb-2
                        ">
                            Selesai
                        </p>

                        @if($completedAt)

                            <p class="
                                text-2xl
                                font-bold
                                text-blue-600
                            ">
                                {{ $completedAt->format('H:i') }}
                            </p>

                            <p class="
                                text-xs
                                text-gray-400
                                mt-2
                            ">
                                {{ $completedAt->format('d M Y') }}
                            </p>

                        @else

                            <p class="text-gray-400">
                                Belum Selesai
                            </p>

                        @endif

                    </div>

                </div>

            </div>

            @endif

        </div>


        <!-- ================= RIGHT ================= -->
        <div class="space-y-6">

            <!-- ================= PAYMENT ================= -->
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
                        Pembayaran
                    </h3>

                    <p class="
                        text-sm
                        text-gray-400
                        mt-1
                    ">
                        Informasi pembayaran customer
                    </p>

                </div>


                <div class="space-y-4 text-sm">

                    <!-- METHOD -->
                    <div>

                        <p class="
                            text-gray-400
                            text-xs mb-1
                        ">
                            Metode Pembayaran
                        </p>

                        <p class="
                            font-medium
                            text-gray-700
                        ">
                            {{ ucfirst($transaction->payment_method) }}
                        </p>

                    </div>


                    @if($transaction->payment)

                    <!-- BANK -->
                    <div>

                        <p class="
                            text-gray-400
                            text-xs mb-1
                        ">
                            Nama Bank
                        </p>

                        <p class="
                            font-medium
                            text-gray-700
                        ">
                            {{ $transaction->payment->bank_name ?? '-' }}
                        </p>

                    </div>


                    <!-- ACCOUNT -->
                    <div>

                        <p class="
                            text-gray-400
                            text-xs mb-1
                        ">
                            Nomor Rekening
                        </p>

                        <p class="
                            font-medium
                            text-gray-700
                        ">
                            {{ $transaction->payment->account_number ?? '-' }}
                        </p>

                    </div>


                    <!-- BUTTON -->
                    <button
                        @click="showPayment = true"
                        class="
                            w-full
                            mt-3
                            bg-blue-50
                            hover:bg-blue-100
                            transition
                            text-blue-600
                            py-3
                            rounded-2xl
                            text-sm font-medium
                        "
                    >

                        Lihat Bukti Pembayaran

                    </button>

                    @endif

                </div>

            </div>


            <!-- ================= PRICE ================= -->
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
                        Rincian Harga
                    </h3>

                    <p class="
                        text-sm
                        text-gray-400
                        mt-1
                    ">
                        Detail pembayaran layanan
                    </p>

                </div>


                <div class="space-y-4">

                    @foreach($transaction->services as $service)

                    <div class="space-y-2">

                        <div class="
                            flex justify-between
                            gap-4
                            text-sm
                        ">

                            <span class="text-gray-600">
                                {{ $service->service_name }}
                            </span>

                            <span class="
                                font-medium
                                text-gray-700
                            ">
                                {{ $service->formatted_service_price }}
                            </span>

                        </div>


                        @if($service->additional_price)

                        <div class="
                            flex justify-between
                            gap-4
                            text-sm
                        ">

                            <span class="text-gray-500">
                                + {{ $service->additional_service }}
                            </span>

                            <span class="
                                font-medium
                                text-gray-700
                            ">
                                {{ $service->formatted_additional_price }}
                            </span>

                        </div>

                        @endif

                    </div>

                    @endforeach


                    <hr class="border-gray-100">


                    <!-- TOTAL -->
                    <div class="
                        flex justify-between
                        items-center
                    ">

                        <span class="
                            font-semibold
                            text-gray-800
                        ">
                            Total
                        </span>

                        <span class="
                            text-xl
                            font-bold
                            text-teal-600
                        ">

                            {{ $transaction->formatted_total_price }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= PAYMENT MODAL ================= -->
    <div
        x-show="showPayment"
        x-cloak
        x-transition
        @click.self="showPayment = false"
        class="
            fixed inset-0
            bg-black/60
            backdrop-blur-sm
            flex items-center justify-center
            z-50
            p-4
        "
    >

        <div class="
            bg-white
            rounded-3xl
            w-full max-w-lg
            p-5
            shadow-2xl
        ">

            <div class="
                flex items-center justify-between
                mb-5
            ">

                <h3 class="
                    text-lg
                    font-semibold
                    text-gray-800
                ">
                    Bukti Pembayaran
                </h3>

                <button
                    @click="showPayment = false"
                    class="
                        w-10 h-10
                        rounded-xl
                        hover:bg-gray-100
                        transition
                    "
                >

                    ✕

                </button>

            </div>


            <img
                src="{{ asset('storage/'.$transaction->payment_proof ?? '') }}"
                class="
                    w-full
                    rounded-2xl
                    max-h-[70vh]
                    object-contain
                    bg-gray-50
                "
            >

        </div>

    </div>


    <!-- ================= REJECT MODAL ================= -->
    <div
        x-show="showReject"
        x-cloak
        x-transition
        @click.self="showReject = false"
        class="
            fixed inset-0
            bg-black/60
            backdrop-blur-sm
            flex items-center justify-center
            z-50
            p-4
        "
    >

        <div class="
            bg-white
            rounded-3xl
            w-full max-w-md
            p-6
            shadow-2xl
        ">

            <h3 class="
                text-lg
                font-semibold
                text-gray-800
                mb-2
            ">
                Tolak Pembayaran
            </h3>

            <p class="
                text-sm
                text-gray-400
                mb-5
            ">
                Masukkan alasan penolakan pembayaran customer
            </p>


            <form method="POST"
                action="{{ route('admin.orders.reject',$transaction->id) }}">

                @csrf

                <textarea
                    name="cancel_reason"
                    rows="5"
                    required
                    placeholder="Masukkan alasan penolakan..."
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        p-4
                        text-sm
                        focus:ring-2 focus:ring-red-500
                        focus:border-transparent
                        outline-none
                    "
                ></textarea>


                <div class="
                    flex flex-col sm:flex-row
                    gap-3
                    mt-5
                ">

                    <!-- REJECT -->
                    <button class="
                        flex-1
                        bg-red-500
                        hover:bg-red-600
                        transition
                        text-white
                        py-3
                        rounded-2xl
                        text-sm font-semibold
                    ">

                        Tolak

                    </button>


                    <!-- CANCEL -->
                    <button
                        type="button"
                        @click="showReject = false"
                        class="
                            flex-1
                            bg-gray-100
                            hover:bg-gray-200
                            transition
                            text-gray-700
                            py-3
                            rounded-2xl
                            text-sm font-semibold
                        "
                    >

                        Batal

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection