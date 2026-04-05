@extends('layouts.terapis')

@section('title','Detail Pesanan')
@section('header',' Detail Pesanan ')

@section('content')

<div class="p-6 max-w-4xl mx-auto space-y-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center">

        <div>
            <h1 class="text-xl font-semibold text-gray-800">
                Detail Pesanan
            </h1>
            <p class="text-sm text-gray-500">
                ID {{ $transaction->transaction_code }}
            </p>
        </div>

        <!-- STATUS -->
        <span class="text-xs px-3 py-1 rounded-full font-medium
            @if($transaction->order_status == 'ready') bg-yellow-100 text-yellow-700
            @elseif($transaction->order_status == 'assigned') bg-blue-100 text-blue-700
            @elseif($transaction->order_status == 'ongoing') bg-purple-100 text-purple-700
            @elseif($transaction->order_status == 'completed') bg-green-100 text-green-700
            @elseif($transaction->order_status == 'cancelled') bg-red-100 text-red-700
            @else bg-gray-100 text-gray-600
            @endif
        ">
            {{ ucfirst(str_replace('_',' ',$transaction->order_status)) }}
        </span>

    </div>

    <!-- CUSTOMER -->
    <div class="bg-white rounded-2xl shadow p-5 space-y-3">

        <h2 class="font-semibold text-gray-700">Informasi Customer</h2>

        <div class="grid grid-cols-2 gap-4 text-sm">

            <div>
                <p class="text-gray-500">Nama</p>
                <p class="font-medium">{{ $transaction->customer_name }}</p>
            </div>

            <div>
                <p class="text-gray-500">Telepon</p>
                <p class="font-medium">{{ $transaction->customer_phone ?? '-' }}</p>
            </div>

            <div class="col-span-2">
                <p class="text-gray-500">Alamat</p>
                <p class="font-medium">{{ $transaction->customer_address }}</p>
            </div>

            <div>
                <p class="text-gray-500">Kota</p>
                <p class="font-medium">{{ $transaction->customer_city }}</p>
            </div>

        </div>

    </div>

    <!-- LAYANAN -->
    <div class="bg-white rounded-2xl shadow p-5 space-y-4">

        <h2 class="font-semibold text-gray-700">Detail Layanan</h2>

        @forelse($transaction->services as $service)
        <div class="flex justify-between border-b pb-3">

            <div>
                <p class="font-medium">{{ $service->service_name }}</p>
                <p class="text-xs text-gray-500">
                    {{ $service->duration }} menit
                </p>
            </div>

            <div class="text-teal-600 font-semibold">
                Rp{{ number_format($service->price ?? 0,0,',','.') }}
            </div>

        </div>
        @empty
        <p class="text-gray-500 text-sm">Tidak ada layanan</p>
        @endforelse

    </div>

    <!-- JADWAL -->
    <div class="bg-white rounded-2xl shadow p-5 space-y-2">

        <h2 class="font-semibold text-gray-700">Jadwal</h2>

        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Tanggal</span>
            <span>{{ \Carbon\Carbon::parse($transaction->service_date)->format('d M Y') }}</span>
        </div>

        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Jam</span>
            <span>{{ $transaction->service_time }}</span>
        </div>

    </div>

    <!-- PEMBAYARAN -->
    <div class="bg-white rounded-2xl shadow p-5 space-y-2">

        <h2 class="font-semibold text-gray-700">Pembayaran</h2>

        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Status</span>
            <span class="font-medium">
                {{ ucfirst($transaction->payment_status) }}
            </span>
        </div>

        <div class="flex justify-between text-lg font-semibold text-teal-600">
            <span>Total</span>
            <span>Rp{{ number_format($transaction->total_price,0,',','.') }}</span>
        </div>

    </div>

    <!-- ACTION LOGIC (SUPER IMPORTANT) -->
    <div class="space-y-3">

        @php
            $canTake =
                $terapis->status == 1 &&
                $transaction->payment_status == 'verified' &&
                $transaction->order_status == 'ready' &&
                is_null($transaction->terapis_id);
        @endphp

        @if($canTake)
            <form action="{{ route('terapis.pesanan.ambil', $transaction->id) }}" method="POST">
                @csrf
                <button class="w-full bg-teal-600 text-white py-3 rounded-xl hover:bg-teal-700">
                    Ambil Pesanan
                </button>
            </form>

        @else
            <div class="bg-gray-100 text-gray-600 text-center p-3 rounded-xl">

                @if($terapis->status != 1)
                    Status kamu OFFLINE
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