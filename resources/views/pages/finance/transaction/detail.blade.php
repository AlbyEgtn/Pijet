@extends('layouts.finance')

@section('title','Detail Pesanan')
@section('header','Detail Pesanan')

@section('content')

<div class="p-6" x-data="{ openModal:false }">

<!-- BACK -->
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

            <!-- STATUS -->
            <div class="mt-1 flex items-center gap-2 text-sm">

                {{-- PAYMENT STATUS --}}
                @php
                    $paymentMap = [
                        'pending' => ['Menunggu', 'bg-yellow-500'],
                        'uploaded' => ['Upload Bukti', 'bg-blue-500'],
                        'verified' => ['Lunas', 'bg-green-600'],
                        'failed' => ['Ditolak', 'bg-red-500'],
                        'expired' => ['Kadaluarsa', 'bg-gray-500'],
                    ];
                    [$pText, $pColor] = $paymentMap[$transaction->payment_status] ?? ['Unknown','bg-gray-400'];
                @endphp

                <span class="text-white text-xs px-2 py-1 rounded {{ $pColor }}">
                    {{ $pText }}
                </span>

                {{-- ORDER STATUS --}}
                @php
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
                    [$oText, $oColor] = $orderMap[$transaction->order_status] ?? ['Unknown','bg-gray-400'];
                @endphp

                <span class="text-white text-xs px-2 py-1 rounded {{ $oColor }}">
                    {{ $oText }}
                </span>

            </div>
        </div>

        <div class="text-sm text-gray-500 text-right">
            <p>
                Tanggal :
                {{ \Carbon\Carbon::parse($transaction->service_date)->format('d F Y') }}
            </p>
            <p>
                Waktu :
                {{ $transaction->service_time }}
            </p>

            {{-- tambahan kecil --}}
            @if($transaction->completed_at)
            <p class="text-green-600 text-xs">
                Selesai: {{ \Carbon\Carbon::parse($transaction->completed_at)->format('H:i') }}
            </p>
            @endif
        </div>

    </div>

    <!-- GRID -->
    <div class="grid grid-cols-3 gap-6">

        <!-- LEFT -->
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
                        <p class="text-gray-500">No Telepon</p>
                        <p class="font-medium">
                            {{ $transaction->customer_phone ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Gender Terapis</p>
                        <p class="font-medium">
                            {{ $transaction->therapist_gender ?? '-' }}
                        </p>
                    </div>

                    <div class="col-span-2">
                        <p class="text-gray-500">Lokasi</p>
                        <p class="font-medium">
                            {{ $transaction->customer_city }}
                        </p>
                    </div>

                    <div class="col-span-2">
                        <p class="text-gray-500">Alamat</p>
                        <p class="font-medium">
                            {{ $transaction->customer_address }}
                        </p>
                    </div>

                </div>

            </div>

            <!-- SERVICE -->
            <div class="space-y-4">

                @foreach($transaction->services as $service)

                <div class="border rounded-lg overflow-hidden">

                    <div class="bg-teal-600 text-white px-4 py-2 text-sm font-semibold">
                        {{ $service->service_name }}
                    </div>

                    <div class="p-4 text-sm grid grid-cols-4 gap-4">

                        <div>
                            <p class="text-gray-500">Terapis</p>
                            <p class="font-medium">
                                {{ $service->therapist_name ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Layanan</p>
                            <p class="font-medium">
                                {{ $service->service_name }} ({{ $service->duration }} menit)
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Tambahan</p>
                            <p class="font-medium">
                                {{ $service->additional_service ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Durasi</p>
                            <p class="font-medium">
                                {{ $service->total_duration }} menit
                            </p>
                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        <!-- RIGHT -->
        <div class="space-y-6">

            <!-- PEMBAYARAN -->
            <div class="border rounded-lg p-4">

                <h3 class="font-semibold mb-3">
                    Informasi Pembayaran
                </h3>

                <div class="text-sm space-y-2">

                    <p>
                        <span class="text-gray-500">Metode :</span>
                        <b>{{ ucfirst($transaction->payment_method) }}</b>
                    </p>

                    @if($transaction->payment)
                    <p>{{ $transaction->payment->bank_name }}</p>
                    <p>{{ $transaction->payment->account_number }}</p>
                    @endif

                    <span class="text-xs px-2 py-1 rounded text-white {{ $pColor }}">
                        {{ $pText }}
                    </span>

                    @php
                        $proof = $transaction->payment->payment_proof 
                            ?? $transaction->payment_proof 
                            ?? null;
                    @endphp

                    @if($proof)
                    <button 
                        @click="openModal = true"
                        class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                        Lihat Bukti
                    </button>
                    @endif

                </div>

            </div>

            <!-- HARGA -->
            <div class="border rounded-lg p-4">

                <h3 class="font-semibold mb-3">
                    Rincian Harga
                </h3>

                @php $grandTotal = 0; @endphp

                @foreach($transaction->services as $service)

                    @php
                        $total = $service->service_price + ($service->additional_price ?? 0);
                        $grandTotal += $total;
                    @endphp

                    <div class="flex justify-between text-sm">
                        <span>{{ $service->service_name }}</span>
                        <span>Rp{{ number_format($total) }}</span>
                    </div>

                @endforeach

                <hr>

                <div class="flex justify-between font-semibold text-green-600">
                    <span>Total</span>
                    <span>Rp{{ number_format($grandTotal) }}</span>
                </div>

            </div>

        </div>

    </div>

</div>


<!-- MODAL BUKTI -->
<div 
    x-show="openModal"
    x-transition
    class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
>

    <div 
        @click.away="openModal = false"
        class="bg-white rounded-lg shadow-lg max-w-xl w-full p-4"
    >

        <!-- HEADER -->
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h3 class="font-semibold text-gray-700">
                Bukti Pembayaran
            </h3>

            <button 
                @click="openModal = false"
                class="text-gray-400 hover:text-gray-700 text-xl"
            >
                ×
            </button>
        </div>

        <!-- CONTENT -->
        <div class="flex justify-center">

            @if($proof)

                <img 
                    src="{{ asset('storage/'.$proof) }}"
                    class="max-h-[500px] rounded"
                >

            @else

                <div class="text-gray-500 text-sm py-10">
                    Bukti pembayaran tidak tersedia
                </div>

            @endif

        </div>

    </div>

</div>

</div>

@endsection
