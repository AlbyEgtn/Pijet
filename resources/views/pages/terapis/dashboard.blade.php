@extends('layouts.terapis')

@section('title','Dashboard')

@section('content')

<div class="grid grid-cols-12 gap-6">

    <!-- ================= LEFT ================= -->
    <div class="col-span-8 space-y-6">

        <!-- HEADER -->
        <div class="bg-teal-600 text-white p-6 rounded-2xl shadow">

            <div class="flex justify-between items-center">

                <div>
                    <h2 class="text-lg font-semibold">
                        Halo, {{ $user->name }} 👋
                    </h2>
                    <p class="text-sm opacity-80">
                        Siap menerima pesanan hari ini?
                    </p>
                </div>

                <!-- STATUS -->
                <form method="POST" action="{{ route('terapis.update.informasi') }}">
                    @csrf

                    <input type="hidden" name="status" value="0">

                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="status" value="1"
                            onchange="this.form.submit()"
                            {{ $terapis->status ? 'checked' : '' }}
                            class="sr-only peer">

                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-500 relative">
                            <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-5"></div>
                        </div>
                    </label>
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
                    Lihat Semua
                </a>

            </div>

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

        </div>

    </div>


    <!-- ================= RIGHT ================= -->
    <div class="col-span-4 space-y-6">

        <!-- PROFIL -->
        <div class="bg-white rounded-2xl shadow p-6">

            <h2 class="font-semibold mb-4">
                Profil Terapis
            </h2>

            <div class="text-sm space-y-2">
                <p><b>Nama:</b> {{ $user->name }}</p>
                <p><b>WhatsApp:</b> {{ $terapis->whatsapp ?? '-' }}</p>
                <p><b>Status:</b>
                    <span class="{{ $terapis->status ? 'text-green-600' : 'text-red-500' }}">
                        {{ $terapis->status ? 'Online' : 'Offline' }}
                    </span>
                </p>
            </div>

        </div>

    </div>

</div>

@endsection