@extends('layouts.superadmin')

@section('title','Detail Cabang')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">

        <div class="flex items-center gap-3">

            <a href="{{ route('superadmin.cabang.index') }}"
               class="text-gray-500 hover:text-gray-700">
                ←
            </a>

            <h1 class="text-xl font-semibold">
                Detail Cabang
            </h1>

        </div>

        <a href="{{ route('superadmin.cabang.edit', $cabang->id) }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
            + Edit Cabang
        </a>

    </div>



    {{-- CABANG INFO --}}
    <div>

        <h2 class="text-lg font-semibold text-gray-700">
            {{ $cabang->kota }}
        </h2>

        <div class="flex items-center gap-2 text-sm mt-1">

            <span class="text-gray-500">
                Status Cabang :
            </span>

            <span class="bg-green-100 text-green-600 px-2 py-1 rounded-md text-xs">
                {{ $cabang->status }}
            </span>

        </div>

    </div>



    {{-- CARD INFORMASI CABANG --}}
    <div class="bg-white border rounded-xl p-6">

        <h3 class="font-semibold mb-4">
            Informasi Cabang
        </h3>

        <div class="grid grid-cols-2 gap-6 text-sm">

            <div class="space-y-2">

                <div>
                    <p class="text-gray-400">ID cabang</p>
                    <p class="font-medium">{{ $cabang->kode_cabang }}</p>
                </div>

                <div>
                    <p class="text-gray-400">Jumlah Total Pegawai</p>
                    <p class="font-medium">3 Pegawai</p>
                </div>

                <div>
                    <p class="text-gray-400">Jumlah Pegawai Admin</p>
                    <p class="font-medium">1 Pegawai Admin</p>
                </div>

                <div>
                    <p class="text-gray-400">Jumlah Pelanggan</p>
                    <p class="font-medium">1 Pegawai Finance</p>
                </div>

            </div>


            <div class="space-y-2">

                <div>
                    <p class="text-gray-400">Lokasi Cabang</p>
                    <p class="font-medium">
                        Karangjambe, Gg. Arjuna No.59, Bantul
                    </p>
                </div>

                <div>
                    <p class="text-gray-400">Jumlah Total Pengguna</p>
                    <p class="font-medium">100 Pengguna</p>
                </div>

                <div>
                    <p class="text-gray-400">Jumlah Pengguna Terapis</p>
                    <p class="font-medium">45 Terapis</p>
                </div>

                <div>
                    <p class="text-gray-400">Jumlah Pengguna Customer</p>
                    <p class="font-medium">55 Customer</p>
                </div>

            </div>

        </div>

    </div>



    {{-- CARD LAYANAN + TRANSAKSI --}}
    <div class="grid grid-cols-2 gap-6">


        {{-- CARD LAYANAN --}}
        <div class="bg-white border border-green-300 rounded-xl p-6">

            <h3 class="font-semibold text-green-600 mb-4">
                Layanan
            </h3>

            <div class="text-sm space-y-2">

                <p>Total Layanan Selesai</p>
                <p class="font-semibold">70 Layanan</p>

                <p>Total Layanan Dibatalkan</p>
                <p class="font-semibold">15 Layanan</p>

            </div>

        </div>



        {{-- CARD TRANSAKSI --}}
        <div class="bg-white border border-green-300 rounded-xl p-6">

            <h3 class="font-semibold text-green-600 mb-4">
                Transaksi
            </h3>

            <div class="text-sm space-y-2">

                <p>Total Transaksi Masuk</p>
                <p class="font-semibold">Rp 200.000.000</p>

                <p>Total Transaksi Keluar</p>
                <p class="font-semibold">Rp 30.000.000</p>

                <p>Total Pemasukan Bulanan</p>
                <p class="font-semibold">Rp 25.000.000</p>

            </div>

        </div>


    </div>

</div>

@endsection