@extends('layouts.finance')

@section('title','Detail Pesanan')
@section('header','Detail Pesanan')

@section('content')

<div
    class="space-y-6"
    x-data="{ openModal:false }"
>

    <!-- ================= BACK ================= -->
    <div>

        <a
            href="{{ url()->previous() }}"
            class="
                inline-flex items-center
                gap-2
                text-sm
                text-gray-500
                hover:text-teal-600
                transition
            "
        >

            ← Kembali

        </a>

    </div>



    <!-- ================= HEADER ================= -->
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


        @php

            $paymentMap = [
                'pending' => ['Menunggu', 'bg-yellow-500'],
                'uploaded' => ['Upload Bukti', 'bg-blue-500'],
                'verified' => ['Lunas', 'bg-green-600'],
                'failed' => ['Ditolak', 'bg-red-500'],
                'expired' => ['Kadaluarsa', 'bg-gray-500'],
            ];

            [$pText, $pColor] = $paymentMap[$transaction->payment_status]
                ?? ['Unknown','bg-gray-400'];



            $orderMap = [
                'waiting' => ['Menunggu', 'bg-gray-400'],
                'ready' => ['Siap', 'bg-indigo-500'],
                'assigned' => ['Diambil', 'bg-purple-500'],
                'on_the_way' => ['Menuju Lokasi', 'bg-blue-500'],
                'ongoing' => ['Sedang Jalan', 'bg-orange-500'],
                'completed' => ['Selesai', 'bg-green-600'],
                'cancelled' => ['Dibatalkan', 'bg-red-500'],
                'rescheduled' => ['Reschedule', 'bg-cyan-500'],
            ];

            [$oText, $oColor] = $orderMap[$transaction->order_status]
                ?? ['Unknown','bg-gray-400'];

        @endphp


        <div class="
            relative z-10
            flex flex-col lg:flex-row
            lg:items-start
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
                    Detail Transaksi
                </p>

                <h2 class="
                    text-2xl md:text-4xl
                    font-bold
                    break-all
                ">
                    {{ $transaction->transaction_code }}
                </h2>


                <!-- STATUS -->
                <div class="
                    flex flex-wrap
                    items-center
                    gap-3
                    mt-5
                ">

                    <!-- PAYMENT -->
                    <span class="
                        px-4 py-2
                        rounded-full
                        text-xs font-semibold
                        text-white
                        {{ $pColor }}
                    ">

                        {{ $pText }}

                    </span>


                    <!-- ORDER -->
                    <span class="
                        px-4 py-2
                        rounded-full
                        text-xs font-semibold
                        text-white
                        {{ $oColor }}
                    ">

                        {{ $oText }}

                    </span>

                </div>

            </div>


            <!-- RIGHT -->
            <div class="
                bg-white/10
                backdrop-blur
                rounded-3xl
                p-5
                min-w-[220px]
                text-sm
            ">

                <div class="space-y-3">

                    <div>

                        <p class="text-teal-100">
                            Tanggal
                        </p>

                        <p class="font-semibold mt-1">
                            {{ \Carbon\Carbon::parse($transaction->service_date)->format('d F Y') }}
                        </p>

                    </div>


                    <div>

                        <p class="text-teal-100">
                            Waktu
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $transaction->service_time }}
                        </p>

                    </div>


                    @if($transaction->completed_at)

                        <div>

                            <p class="text-teal-100">
                                Selesai
                            </p>

                            <p class="font-semibold mt-1">
                                {{ \Carbon\Carbon::parse($transaction->completed_at)->format('H:i') }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>



    <!-- ================= CONTENT ================= -->
    <div class="
        grid grid-cols-1
        xl:grid-cols-3
        gap-6
    ">

        <!-- ================= LEFT ================= -->
        <div class="
            xl:col-span-2
            space-y-6
        ">

            <!-- CUSTOMER -->
            <div class="
                bg-white
                rounded-3xl
                border border-gray-100
                shadow-sm
                p-6
            ">

                <div class="mb-6">

                    <h3 class="
                        text-xl
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
                        Informasi customer dan lokasi layanan.
                    </p>

                </div>


                <!-- GRID -->
                <div class="
                    grid grid-cols-1
                    md:grid-cols-2
                    gap-5
                    text-sm
                ">

                    <!-- ITEM -->
                    <div>

                        <p class="text-gray-400">
                            ID Pelanggan
                        </p>

                        <p class="
                            font-semibold
                            text-gray-700
                            mt-1
                        ">
                            {{ $transaction->customer_id ?? '-' }}
                        </p>

                    </div>


                    <!-- ITEM -->
                    <div>

                        <p class="text-gray-400">
                            Nama Pemesan
                        </p>

                        <p class="
                            font-semibold
                            text-gray-700
                            mt-1
                        ">
                            {{ $transaction->orderer_name ?? $transaction->customer_name }}
                        </p>

                    </div>


                    <!-- ITEM -->
                    <div>

                        <p class="text-gray-400">
                            Nomor Telepon
                        </p>

                        <p class="
                            font-semibold
                            text-gray-700
                            mt-1
                        ">
                            {{ $transaction->customer_phone ?? '-' }}
                        </p>

                    </div>


                    <!-- ITEM -->
                    <div>

                        <p class="text-gray-400">
                            Gender Terapis
                        </p>

                        <p class="
                            font-semibold
                            text-gray-700
                            mt-1
                        ">
                            {{ $transaction->therapist_gender ?? '-' }}
                        </p>

                    </div>


                    <!-- ITEM -->
                    <div class="md:col-span-2">

                        <p class="text-gray-400">
                            Kota
                        </p>

                        <p class="
                            font-semibold
                            text-gray-700
                            mt-1
                        ">
                            {{ $transaction->customer_city }}
                        </p>

                    </div>


                    <!-- ITEM -->
                    <div class="md:col-span-2">

                        <p class="text-gray-400">
                            Alamat
                        </p>

                        <p class="
                            font-semibold
                            text-gray-700
                            mt-1
                            leading-relaxed
                        ">
                            {{ $transaction->customer_address }}
                        </p>

                    </div>

                </div>

            </div>



            <!-- ================= SERVICE ================= -->
            <div class="
                bg-white
                rounded-3xl
                border border-gray-100
                shadow-sm
                p-6
            ">

                <!-- HEADER -->
                <div class="mb-6">

                    <h3 class="
                        text-xl
                        font-semibold
                        text-gray-800
                    ">
                        Detail Layanan
                    </h3>

                    <p class="
                        text-sm
                        text-gray-400
                        mt-1
                    ">
                        Seluruh layanan yang dipilih customer.
                    </p>

                </div>


                <!-- LIST -->
                <div class="space-y-5">

                    @foreach($transaction->services as $service)

                        <div class="
                            border border-gray-100
                            rounded-3xl
                            overflow-hidden
                        ">

                            <!-- TOP -->
                            <div class="
                                bg-gradient-to-r
                                from-teal-600 to-teal-700
                                px-5 py-4
                                text-white
                            ">

                                <h4 class="
                                    font-semibold
                                ">
                                    {{ $service->service_name }}
                                </h4>

                            </div>


                            <!-- CONTENT -->
                            <div class="
                                p-5
                                grid grid-cols-1
                                sm:grid-cols-2
                                xl:grid-cols-4
                                gap-5
                                text-sm
                            ">

                                <!-- TERAPIS -->
                                <div>

                                    <p class="text-gray-400">
                                        Terapis
                                    </p>

                                    <p class="
                                        font-semibold
                                        text-gray-700
                                        mt-1
                                    ">
                                        {{ $service->therapist_name ?? '-' }}
                                    </p>

                                </div>


                                <!-- SERVICE -->
                                <div>

                                    <p class="text-gray-400">
                                        Layanan
                                    </p>

                                    <p class="
                                        font-semibold
                                        text-gray-700
                                        mt-1
                                    ">
                                        {{ $service->service_name }}
                                    </p>

                                </div>


                                <!-- ADDITIONAL -->
                                <div>

                                    <p class="text-gray-400">
                                        Tambahan
                                    </p>

                                    <p class="
                                        font-semibold
                                        text-gray-700
                                        mt-1
                                    ">
                                        {{ $service->additional_service ?? '-' }}
                                    </p>

                                </div>


                                <!-- DURATION -->
                                <div>

                                    <p class="text-gray-400">
                                        Durasi
                                    </p>

                                    <p class="
                                        font-semibold
                                        text-gray-700
                                        mt-1
                                    ">
                                        {{ $service->total_duration }} Menit
                                    </p>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>



        <!-- ================= RIGHT ================= -->
        <div class="space-y-6">

            <!-- PAYMENT -->
            <div class="
                bg-white
                rounded-3xl
                border border-gray-100
                shadow-sm
                p-6
            ">

                <div class="mb-5">

                    <h3 class="
                        text-lg
                        font-semibold
                        text-gray-800
                    ">
                        Informasi Pembayaran
                    </h3>

                </div>


                @php

                    $proof = $transaction->payment->payment_proof
                        ?? $transaction->payment_proof
                        ?? null;

                @endphp


                <div class="
                    space-y-4
                    text-sm
                ">

                    <!-- METHOD -->
                    <div>

                        <p class="text-gray-400">
                            Metode Pembayaran
                        </p>

                        <p class="
                            font-semibold
                            text-gray-700
                            mt-1
                        ">
                            {{ ucfirst($transaction->payment_method) }}
                        </p>

                    </div>


                    <!-- BANK -->
                    @if($transaction->payment)

                        <div>

                            <p class="text-gray-400">
                                Nama Bank
                            </p>

                            <p class="
                                font-semibold
                                text-gray-700
                                mt-1
                            ">
                                {{ $transaction->payment->bank_name }}
                            </p>

                        </div>


                        <div>

                            <p class="text-gray-400">
                                Nomor Rekening
                            </p>

                            <p class="
                                font-semibold
                                text-gray-700
                                mt-1
                            ">
                                {{ $transaction->payment->account_number }}
                            </p>

                        </div>

                    @endif


                    <!-- STATUS -->
                    <div>

                        <span class="
                            inline-flex items-center
                            px-4 py-2
                            rounded-full
                            text-xs font-semibold
                            text-white
                            {{ $pColor }}
                        ">

                            {{ $pText }}

                        </span>

                    </div>


                    <!-- PROOF -->
                    @if($proof)

                        <button
                            @click="openModal = true"
                            class="
                                w-full
                                bg-blue-50
                                hover:bg-blue-100
                                text-blue-700
                                py-3
                                rounded-2xl
                                text-sm font-semibold
                                transition
                            "
                        >

                            Lihat Bukti Pembayaran

                        </button>

                    @endif

                </div>

            </div>



            <!-- PRICE -->
            <div class="
                bg-white
                rounded-3xl
                border border-gray-100
                shadow-sm
                p-6
            ">

                <div class="mb-5">

                    <h3 class="
                        text-lg
                        font-semibold
                        text-gray-800
                    ">
                        Rincian Harga
                    </h3>

                </div>


                @php $grandTotal = 0; @endphp

                <div class="space-y-4">

                    @foreach($transaction->services as $service)

                        @php
                            $total = $service->service_price + ($service->additional_price ?? 0);
                            $grandTotal += $total;
                        @endphp

                        <div class="
                            flex items-center justify-between
                            text-sm
                        ">

                            <div>

                                <p class="
                                    font-medium
                                    text-gray-700
                                ">
                                    {{ $service->service_name }}
                                </p>

                            </div>

                            <p class="
                                font-semibold
                                text-gray-800
                            ">
                                Rp{{ number_format($total) }}
                            </p>

                        </div>

                    @endforeach

                </div>


                <!-- TOTAL -->
                <div class="
                    mt-6
                    pt-5
                    border-t border-gray-100
                    flex items-center justify-between
                ">

                    <span class="
                        text-base
                        font-semibold
                        text-gray-700
                    ">
                        Total
                    </span>

                    <span class="
                        text-2xl
                        font-bold
                        text-teal-700
                    ">
                        Rp{{ number_format($grandTotal) }}
                    </span>

                </div>

            </div>

        </div>

    </div>



    <!-- ================= MODAL ================= -->
    <div
        x-show="openModal"
        x-transition
        class="
            fixed inset-0
            z-50
            flex items-center justify-center
            bg-black/70
            p-4
        "
    >

        <!-- MODAL -->
        <div
            @click.away="openModal = false"
            class="
                bg-white
                rounded-3xl
                shadow-2xl
                w-full
                max-w-3xl
                overflow-hidden
            "
        >

            <!-- HEADER -->
            <div class="
                flex items-center justify-between
                px-6 py-5
                border-b border-gray-100
            ">

                <div>

                    <h3 class="
                        text-lg
                        font-semibold
                        text-gray-800
                    ">
                        Bukti Pembayaran
                    </h3>

                    <p class="
                        text-sm
                        text-gray-400
                        mt-1
                    ">
                        Upload bukti transfer customer.
                    </p>

                </div>


                <!-- CLOSE -->
                <button
                    @click="openModal = false"
                    class="
                        w-10 h-10
                        rounded-2xl
                        hover:bg-gray-100
                        flex items-center justify-center
                        text-gray-500
                        transition
                    "
                >

                    ✕

                </button>

            </div>


            <!-- CONTENT -->
            <div class="
                p-6
                bg-gray-50
                flex items-center justify-center
            ">

                @if($proof)

                    <img
                        src="{{ asset('storage/'.$proof) }}"
                        class="
                            max-h-[75vh]
                            rounded-2xl
                            shadow-lg
                            object-contain
                        "
                    >

                @else

                    <div class="
                        py-20
                        text-center
                    ">

                        <p class="
                            text-gray-400
                            text-sm
                        ">
                            Bukti pembayaran tidak tersedia
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection