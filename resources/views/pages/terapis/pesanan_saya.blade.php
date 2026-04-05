@extends('layouts.terapis')

@section('title','Pesanan Saya')
@section('header',' Pesanan Saya ')

@section('content')

<div class="p-4 space-y-4">

    <h1 class="text-lg font-semibold">Pesanan Saya</h1>

    <!-- ================= FILTER ================= -->
    <div class="flex gap-2 overflow-x-auto">

        <a href="{{ route('terapis.pesanan.saya') }}"
           class="px-3 py-1 rounded-full text-sm
           {{ request('status') == null ? 'bg-teal-600 text-white' : 'bg-gray-200' }}">
            Semua
        </a>

        <a href="{{ route('terapis.pesanan.saya', ['status'=>'assigned']) }}"
           class="px-3 py-1 rounded-full text-sm
           {{ request('status') == 'assigned' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
            Diambil
        </a>

        <a href="{{ route('terapis.pesanan.saya', ['status'=>'cancelled']) }}"
           class="px-3 py-1 rounded-full text-sm
           {{ request('status') == 'cancelled' ? 'bg-red-500 text-white' : 'bg-gray-200' }}">
            Dibatalkan
        </a>

        <a href="{{ route('terapis.pesanan.saya', ['status'=>'completed']) }}"
           class="px-3 py-1 rounded-full text-sm
           {{ request('status') == 'completed' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
            Selesai
        </a>

    </div>

    <!-- ================= LIST ================= -->
    @forelse($transactions as $trx)
    <div class="bg-white p-4 rounded-xl shadow space-y-3">

        <!-- HEADER -->
        <div class="flex justify-between items-center">
            <div>
                <p class="font-semibold">{{ $trx->customer_name }}</p>
                <p class="text-xs text-gray-500">
                    ID {{ $trx->transaction_code }}
                </p>
            </div>

            <!-- ✅ FIX STATUS -->
            <span class="text-xs px-2 py-1 rounded
                @if($trx->order_status == 'assigned') bg-blue-100 text-blue-600
                @elseif($trx->order_status == 'completed') bg-green-100 text-green-600
                @elseif($trx->order_status == 'cancelled') bg-red-100 text-red-600
                @else bg-gray-100 text-gray-600
                @endif
            ">
                {{ ucfirst(str_replace('_',' ',$trx->order_status)) }}
            </span>
        </div>

        <!-- DETAIL -->
        <div class="text-sm text-gray-600">
            <p>
                {{ \Carbon\Carbon::parse($trx->service_date)->format('d M Y') }}
                • {{ $trx->service_time }}
            </p>
            <p>{{ $trx->customer_address }}</p>
        </div>

        <!-- TOTAL -->
        <div class="flex justify-between font-semibold">
            <span>Total</span>
            <span>Rp{{ number_format($trx->total_price,0,',','.') }}</span>
        </div>

        <!-- ACTION -->
        <div class="flex gap-2">

            <a href="{{ route('terapis.pesanan.saya.detail', $trx->id) }}"
               class="flex-1 text-center bg-teal-600 text-white py-2 rounded-lg">
                Detail
            </a>

            <!-- ✅ BATALKAN -->
            @if(in_array($trx->order_status, ['assigned','on_the_way']))
            <form action="{{ route('terapis.pesanan.batal', $trx->id) }}" method="POST" class="flex-1">
                @csrf
                <button class="w-full border border-red-500 text-red-500 py-2 rounded-lg hover:bg-red-50">
                    Batalkan
                </button>
            </form>
            @endif

        </div>

    </div>
    @empty
    <div class="text-center text-gray-500 mt-10">
        Belum ada pesanan
    </div>
    @endforelse

</div>

@endsection