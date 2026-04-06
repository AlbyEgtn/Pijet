@extends('layouts.terapis')

@section('title','Dashboard')

@section('content')

<div class="grid grid-cols-12 gap-6">

    {{-- ================= LEFT SIDE ================= --}}
    <div class="col-span-8 space-y-6">

        {{-- HEADER --}}
        <div class="bg-teal-600 text-white p-6 rounded-2xl shadow">
            <div class="flex justify-between items-center">

                <div>
                    <h2 class="text-lg font-semibold">
                        Selamat Datang
                    </h2>
                    <p class="text-sm opacity-80">
                        {{ $user->name }}
                    </p>
                </div>

                {{-- TOGGLE --}}
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-500 relative">
                        <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-5"></div>
                    </div>
                </label>

            </div>
        </div>


        {{-- LIST PESANAN --}}
        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between items-center mb-4">
                <h2 class="font-semibold">Pesanan Terbaru</h2>

                <a href="{{ route('terapis.pesanan') }}"
                   class="text-sm text-teal-600 hover:underline">
                    Lihat Semua
                </a>
            </div>

            @forelse($transactions->take(5) as $trx)
            <div class="flex items-center justify-between py-3 border-b">

                <div>
                    <p class="font-medium">
                        {{ $trx->customer_name }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ \Carbon\Carbon::parse($trx->service_date)->format('d M Y') }}
                    </p>
                </div>

                <span class="text-xs px-2 py-1 rounded
                    @if($trx->status == 'belum_lunas') bg-yellow-100 text-yellow-700
                    @elseif($trx->status == 'proses') bg-blue-100 text-blue-700
                    @elseif($trx->status == 'lunas') bg-green-100 text-green-700
                    @elseif($trx->status == 'dibatalkan') bg-red-100 text-red-700
                    @else bg-gray-100 text-gray-700
                    @endif
                ">
                    {{ ucfirst(str_replace('_',' ',$trx->status)) }}
                </span>

            </div>
            @empty
            <p class="text-center text-gray-500 py-6">
                Belum ada pesanan
            </p>
            @endforelse

        </div>

    </div>



    {{-- ================= RIGHT SIDE ================= --}}
    <div class="col-span-4 space-y-6">

        {{-- DETAIL PESANAN --}}
        <div class="bg-white rounded-2xl shadow p-6">

            <h2 class="font-semibold mb-4">
                Detail Pesanan
            </h2>

            @if($transactions->first())
            @php $trx = $transactions->first(); @endphp

            <div class="border rounded-xl p-4">

                <p class="font-medium">
                    {{ $trx->customer_name }}
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $trx->service_date }} • {{ $trx->service_time }}
                </p>

                <div class="mt-3 text-sm text-gray-600">
                    <p>Alamat: {{ $trx->customer_address }}</p>
                </div>

                <div class="mt-3 font-semibold text-right">
                    Rp {{ number_format($trx->total_price) }}
                </div>

                @if($trx->status == 'belum_lunas')
                <form action="{{ route('terapis.pesanan.ambil', $trx->id) }}" method="POST">
                    @csrf
                    <button class="mt-3 w-full bg-teal-600 text-white py-2 rounded-lg">
                        Ambil Pesanan
                    </button>
                </form>
                @else
                <div class="mt-3 w-full text-center bg-gray-200 py-2 rounded-lg text-gray-600">
                    Tidak tersedia
                </div>
                @endif

            </div>

            @else
            <p class="text-center text-gray-500">
                Tidak ada pesanan
            </p>
            @endif

        </div>

    </div>

</div>

@endsection