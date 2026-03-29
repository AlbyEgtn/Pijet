@extends('layouts.terapis')

@section('content')

<div class="p-4 space-y-4">

    <!-- HEADER -->
    <h1 class="text-lg font-semibold">Pesanan Layanan</h1>

    <!-- LIST PESANAN -->
    <div class="space-y-3">

        @forelse($transactions as $trx)
        <a href="{{ route('terapis.pesanan.detail', $trx->id) }}"
           class="flex items-center justify-between bg-gray-100 p-4 rounded-xl hover:bg-gray-200 transition">

            <div class="flex items-center gap-3">

                <!-- AVATAR -->
                <div class="w-10 h-10 bg-teal-600 text-white flex items-center justify-center rounded-full">
                    {{ strtoupper(substr($trx->customer_name,0,1)) }}
                </div>

                <!-- INFO -->
                <div>
                    <p class="font-medium text-sm">{{ $trx->customer_name }}</p>
                    <p class="text-xs text-gray-500">
                        {{ $trx->service_date }} • {{ $trx->service_time }}
                    </p>
                </div>

            </div>

            <!-- STATUS -->
            <div class="text-xs font-medium
                @if($trx->status == 'belum_lunas') text-green-500
                @else text-gray-400
                @endif">
                {{ ucfirst(str_replace('_',' ',$trx->status)) }}
            </div>

        </a>
        @empty
        <p class="text-center text-gray-500">Tidak ada pesanan</p>
        @endforelse

    </div>

</div>

@endsection