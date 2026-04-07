@extends('layouts.terapis')

@section('title','Dashboard')
@section('header',' Dashboard ')

@section('content')

<div class="grid grid-cols-12 gap-6">

<<<<<<< HEAD
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
=======
    <!-- ================= LEFT ================= -->
    <div class="col-span-8 space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-6 rounded-2xl shadow">

        <div class="flex justify-between items-center">

            <!-- LEFT -->
            <div>
                <h2 class="text-lg font-semibold">
                    Halo, {{ $user->name }} 👋
                </h2>
                <p class="text-sm text-teal-100">
                    Siap menerima pesanan hari ini?
                </p>
            </div>

            <!-- RIGHT (STATUS) -->
            <form method="POST" action="{{ route('terapis.update.informasi') }}">
                @csrf

                <input type="hidden" name="status" value="0">

                <label class="inline-flex items-center cursor-pointer gap-3">

                    <!-- LABEL STATUS -->
                    <span class="text-sm font-medium">
                        {{ $terapis->status ? 'Online' : 'Offline' }}
                    </span>

                    <!-- TOGGLE -->
                    <input type="checkbox" name="status" value="1"
                        onchange="this.form.submit()"
                        {{ $terapis->status ? 'checked' : '' }}
                        class="sr-only peer">

                    <div class="w-11 h-6 bg-white/30 rounded-full peer peer-checked:bg-green-400 transition relative">
>>>>>>> df56f5da5624620b191301cd14ab1289247f314f

                        <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-5"></div>

                    </div>
                </label>
<<<<<<< HEAD

            </div>
        </div>


        {{-- LIST PESANAN --}}
        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between items-center mb-4">
                <h2 class="font-semibold">Pesanan Terbaru</h2>

                <a href="{{ route('terapis.pesanan') }}"
                   class="text-sm text-teal-600 hover:underline">
=======
            </form>

        </div>

    </div>

        <!-- LIST PESANAN -->
        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between mb-4">

                <h2 class="font-semibold text-gray-800">
                    Pesanan Masuk
                </h2>

                <a href="{{ route('terapis.pesanan') }}"
                    class="text-sm text-teal-600 hover:underline">
>>>>>>> df56f5da5624620b191301cd14ab1289247f314f
                    Lihat Semua
                </a>

            </div>

<<<<<<< HEAD
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
=======
            <div class="space-y-4">

                @forelse($transactions as $trx)

                <div class="border rounded-xl p-4 hover:shadow transition">

                    <div class="flex justify-between">

                        <!-- LEFT -->
                        <div>

                            <p class="font-semibold">
                                {{ $trx->customer_name }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ $trx->customer_city }}
                            </p>

                            <p class="text-sm mt-1">
                                {{ $trx->services->first()->service_name ?? '-' }}
                                • {{ $trx->services->first()->duration ?? 0 }} menit
                            </p>

                        </div>

                        <!-- RIGHT -->
                        <div class="text-right">

                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($trx->service_date)->format('d M Y') }}
                            </p>

                            <p class="font-semibold text-teal-600">
                                Rp {{ number_format($trx->total_price) }}
                            </p>

                        </div>

                    </div>

                    <!-- ACTION -->
                    <div class="flex justify-between items-center mt-4">

                        <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded">
                            Siap Diambil
                        </span>

                        <div class="flex gap-2">

                            <!-- ✅ ROUTE FIX -->
                            <a href="{{ route('terapis.pesanan.detail',$trx->id) }}"
                                class="text-sm px-3 py-1 border rounded hover:bg-gray-100">
                                Detail
                            </a>

                            <!-- ✅ ROUTE FIX -->
                            <form method="POST" action="{{ route('terapis.pesanan.ambil',$trx->id) }}">
                                @csrf
                                @if($terapis->status != 1)
                                    <button disabled
                                        class="text-sm bg-gray-300 text-gray-500 px-3 py-1 rounded cursor-not-allowed">
                                        Offline
                                    </button>
                                @else
                                    <button
                                        class="text-sm bg-teal-600 text-white px-3 py-1 rounded hover:bg-teal-700">
                                        Ambil
                                    </button>
                                @endif
                            </form>

                        </div>

                    </div>

                </div>

                @empty

                <div class="text-center py-10 text-gray-500">
                    Belum ada pesanan di kota kamu
                </div>

                @endforelse

            </div>
>>>>>>> df56f5da5624620b191301cd14ab1289247f314f

        </div>

    </div>


<<<<<<< HEAD

    {{-- ================= RIGHT SIDE ================= --}}
    <div class="col-span-4 space-y-6">

        {{-- DETAIL PESANAN --}}
=======
    <!-- ================= RIGHT ================= -->
    <div class="col-span-4 space-y-6">

        <!-- PROFIL -->
>>>>>>> df56f5da5624620b191301cd14ab1289247f314f
        <div class="bg-white rounded-2xl shadow p-6">

            <h2 class="font-semibold mb-4">
                Profil Terapis
            </h2>

<<<<<<< HEAD
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

=======
            <div class="text-sm space-y-2">
                <p><b>Nama:</b> {{ $user->name }}</p>
                <p><b>WhatsApp:</b> {{ $terapis->whatsapp ?? '-' }}</p>
                <p><b>Status:</b>
                    <span class="{{ $terapis->status ? 'text-green-600' : 'text-red-500' }}">
                        {{ $terapis->status ? 'Online' : 'Offline' }}
                    </span>
                </p>
>>>>>>> df56f5da5624620b191301cd14ab1289247f314f
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