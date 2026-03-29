@extends('layouts.terapis')

@section('title','Dashboard')

@section('content')

<div class="grid grid-cols-12 gap-6">

    {{-- LEFT SIDE --}}
    <div class="col-span-8 space-y-6">

        {{-- HEADER --}}
        <div class="bg-teal-600 text-white p-6 rounded-2xl shadow">

            <div class="flex justify-between items-center">

                <div>
                    <h2 class="text-lg font-semibold">
                        Selamat Bergabung
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

            <div class="flex justify-between mb-4">
                <h2 class="font-semibold">
                    Pesanan Layanan
                </h2>
                <a href="#" class="text-sm text-blue-500">
                    Selengkapnya
                </a>
            </div>

            {{-- ITEM --}}
            @for ($i = 0; $i < 5; $i++)
            <div class="flex items-center justify-between py-3 border-b">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-full bg-gray-200"></div>

                    <div>
                        <p class="font-medium">
                            Matt Shadow
                        </p>
                        <p class="text-xs text-gray-500">
                            Menunggu
                        </p>
                    </div>

                </div>

                <span class="text-blue-500 text-sm">
                    Menunggu
                </span>

            </div>
            @endfor

        </div>

    </div>


    {{-- RIGHT SIDE --}}
    <div class="col-span-4 space-y-6">

        {{-- DETAIL --}}
        <div class="bg-white rounded-2xl shadow p-6">

            <h2 class="font-semibold mb-4">
                Detail Pesanan
            </h2>

            {{-- CARD --}}
            <div class="border rounded-xl p-4 mb-4">

                <p class="font-medium">
                    Matt Shadow
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    Full Body Massage (90 menit)
                </p>

                <div class="mt-3 text-sm text-gray-600">
                    <p>Lokasi: Homecare</p>
                    <p>Tanggal: 25 Agustus 2025</p>
                </div>

                <div class="mt-3 font-semibold text-right">
                    Rp 170.000
                </div>

                <button class="mt-3 w-full bg-teal-600 text-white py-2 rounded-lg">
                    Ambil Pesanan
                </button>

            </div>

        </div>

    </div>

</div>

@endsection