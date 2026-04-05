@extends('layouts.finance')

@section('title','Detail Pesanan  ')
@section('header','Detail Pesanan ')

@section('content')

<div class="p-6" x-data="{ openModal:false }">

    <!-- TITLE -->
    <div class="mb-4 text-sm text-gray-600">
        <a href="{{ url()->previous() }}">
            ← Detail Pembayaran Cash
        </a>
    </div>

    <!-- MAIN CARD -->
    <div class="bg-white rounded-xl shadow p-6">

        <!-- HEADER -->
        <div class="flex justify-between items-start mb-6">

            <div>

                <h2 class="text-lg font-semibold text-teal-600">
                    ID Pesanan : {{ $transaction->transaction_code }}
                </h2>

                <div class="mt-1 flex items-center gap-2 text-sm">

                    <span class="text-gray-500">
                        Status layanan :
                    </span>

                    @if($transaction->status == 'lunas')
                        <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">
                            Sukses
                        </span>
                    @elseif($transaction->status == 'belum_lunas')
                        <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded">
                            Menunggu
                        </span>
                    @elseif($transaction->status == 'reschedule')
                        <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded">
                            Reschedule
                        </span>
                    @else
                        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">
                            Dibatalkan
                        </span>
                    @endif

                </div>

            </div>

            <div class="text-sm text-gray-500 text-right">

                <p>
                    Tanggal Pemesanan :
                    {{ \Carbon\Carbon::parse($transaction->service_date)->format('d F Y') }}
                </p>

                <p>
                    Waktu :
                    {{ $transaction->service_time }}
                </p>

            </div>

        </div>


        <!-- GRID -->
        <div class="grid grid-cols-3 gap-6">

            <!-- LEFT CONTENT -->
            <div class="col-span-2 space-y-6">

                <!-- INFORMASI PEMESANAN -->
                <div class="border rounded-lg p-4">

                    <h3 class="font-semibold mb-4">
                        Informasi Pemesanan
                    </h3>

                    <div class="grid grid-cols-2 gap-y-3 text-sm">

                        <div>
                            <p class="text-gray-500">ID Pelanggan</p>
                            <p class="font-medium">
                                {{ $transaction->customer_id ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Nama Pemesan</p>
                            <p class="font-medium">
                                {{ $transaction->orderer_name ?? $transaction->customer_name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Jadwal Layanan</p>
                            <p class="font-medium">
                                {{ $transaction->service_time }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">No Telepon</p>
                            <p class="font-medium">
                                {{ $transaction->customer_phone }}
                            </p>
                        </div>

                        <div class="col-span-2">
                            <p class="text-gray-500">Lokasi Pelanggan</p>
                            <p class="font-medium">
                                {{ $transaction->customer_city }}
                            </p>
                        </div>

                        <div class="col-span-2">
                            <p class="text-gray-500">Alamat Lengkap</p>
                            <p class="font-medium">
                                {{ $transaction->customer_address }}
                            </p>
                        </div>

                    </div>

                </div>


                <!-- INFORMASI LAYANAN -->
                <div class="space-y-4">

                    @foreach($transaction->services as $service)

                    <div class="border rounded-lg overflow-hidden">

                        <!-- HEADER SERVICE -->
                        <div class="bg-teal-600 text-white px-4 py-2 text-sm font-semibold">
                            {{ $service->service_name }}
                        </div>

                        <!-- BODY -->
                        <div class="p-4 text-sm grid grid-cols-4 gap-4">

                            <div>
                                <p class="text-gray-500">Nama Terapis</p>
                                <p class="font-medium">
                                    {{ $service->therapist_name ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-500">Layanan Utama</p>
                                <p class="font-medium">
                                    {{ $service->service_name }}
                                    ({{ $service->duration }} menit)
                                </p>
                                <p class="text-gray-500 text-xs">
                                    Rp{{ number_format($service->service_price) }}
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-500">Layanan Tambahan</p>

                                @if($service->additional_service)
                                    <p class="font-medium">
                                        {{ $service->additional_service }}
                                    </p>

                                    <p class="text-gray-500 text-xs">
                                        Rp{{ number_format($service->additional_price) }}
                                    </p>
                                @else
                                    -
                                @endif

                            </div>

                            <div>
                                <p class="text-gray-500">Total Durasi Pijat</p>
                                <p class="font-medium">
                                    {{ $service->total_duration }} menit
                                </p>
                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>


            <!-- RIGHT SIDEBAR -->
            <div class="space-y-6">

                <!-- INFORMASI PEMBAYARAN -->
                <div class="border rounded-lg p-4">

                    <h3 class="font-semibold mb-3">
                        Informasi Pembayaran
                    </h3>

                    <div class="text-sm space-y-2">

                        <p>
                            <span class="text-gray-500">Metode Pembayaran :</span>
                            <b>{{ ucfirst($transaction->payment_method) }}</b>
                        </p>

                        @if($transaction->payment)

                        <p>
                            <span class="text-gray-500">Nama Penerima :</span>
                            {{ $transaction->payment->account_holder }}
                        </p>

                        <p>
                            <span class="text-gray-500">Bank :</span>
                            {{ $transaction->payment->bank_name }}
                        </p>

                        <p>
                            <span class="text-gray-500">Nomor Rekening :</span>
                            {{ $transaction->payment->account_number }}
                        </p>

                        @endif

                        <span class="bg-green-200 text-green-700 text-xs px-2 py-1 rounded">
                            Sukses
                        </span>

                        <button 
                            @click="openModal = true"
                            class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                            Lihat Bukti Pembayaran
                        </button>

                    </div>

                </div>


                <!-- RINCIAN HARGA -->
                <div class="border rounded-lg p-4">

                    <h3 class="font-semibold mb-3">
                        Rincian Harga
                    </h3>

                    <div class="text-sm space-y-2">

                        @php
                        $grandTotal = 0;
                        @endphp

                        @foreach($transaction->services as $service)

                        @php
                        $totalService = $service->service_price + ($service->additional_price ?? 0);
                        $grandTotal += $totalService;
                        @endphp

                        <div class="flex justify-between">
                            <span>{{ $service->service_name }}</span>
                            <span>
                                Rp{{ number_format($totalService) }}
                            </span>
                        </div>

                        @endforeach

                        <hr>

                        <div class="flex justify-between font-semibold text-green-600">
                            <span>Grand Total</span>
                            <span>
                                Rp{{ number_format($grandTotal) }}
                            </span>
                        </div>

                    </div>

                </div>

                <!-- MODAL BUKTI PEMBAYARAN -->
                <div 
                    x-show="openModal"
                    x-transition
                    class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
                >

                    <div 
                        @click.away="openModal=false"
                        class="bg-white rounded-lg shadow-lg max-w-xl w-full p-4"
                    >

                        <!-- HEADER -->
                        <div class="flex justify-between items-center border-b pb-2 mb-4">

                            <h3 class="font-semibold text-gray-700">
                                Bukti Pembayaran
                            </h3>

                            <button 
                                @click="openModal=false"
                                class="text-gray-400 hover:text-gray-700 text-xl"
                            >
                                ×
                            </button>

                        </div>


                        <!-- CONTENT -->
                        <div class="flex justify-center">

                            @if($transaction->payment && $transaction->payment->payment_proof)

                                <img 
                                    src="{{ asset('storage/'.$transaction->payment->payment_proof) }}"
                                    class="max-h-[500px] rounded"
                                >

                            @else

                                <div class="text-center text-gray-500 py-10">
                                    Bukti pembayaran tidak tersedia
                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection