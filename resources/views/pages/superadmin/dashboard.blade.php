@extends('layouts.superadmin')

@section('title','Dashboard  ')
@section('header','Dashboard ')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-6 rounded-2xl shadow">

        <h2 class="text-xl font-semibold">
            Super Admin Panel
        </h2>

        <p class="text-sm text-teal-100 mt-1">
            Kontrol penuh terhadap sistem & manajemen aplikasi
        </p>

    </div>


    <!-- SUMMARY -->
    <div class="grid grid-cols-3 gap-6">

        <!-- USER -->
        <div class="bg-white rounded-2xl p-5 shadow hover:shadow-md transition">

            <p class="text-sm text-gray-500">
                Total Pengguna
            </p>

            <h2 class="text-2xl font-bold mt-1 text-gray-800">
                {{ \App\Models\User::count() }}
            </h2>

            <p class="text-xs text-teal-600 mt-2">
                Semua role dalam sistem
            </p>

        </div>


        <!-- TRANSAKSI -->
        <div class="bg-white rounded-2xl p-5 shadow hover:shadow-md transition">

            <p class="text-sm text-gray-500">
                Total Transaksi
            </p>

            <h2 class="text-2xl font-bold mt-1 text-gray-800">
                {{ \App\Models\Transaction::count() }}
            </h2>

            <p class="text-xs text-teal-600 mt-2">
                Semua aktivitas pemesanan
            </p>

        </div>


        <!-- PENDAPATAN -->
        <div class="bg-white rounded-2xl p-5 shadow hover:shadow-md transition">

            <p class="text-sm text-gray-500">
                Total Revenue
            </p>

            <h2 class="text-2xl font-bold mt-1 text-gray-800">
                Rp {{ number_format(\App\Models\Transaction::where('order_status','completed')->sum('total_price'),0,',','.') }}
            </h2>

            <p class="text-xs text-teal-600 mt-2">
                Dari transaksi selesai
            </p>

        </div>

    </div>


    {{--<!-- QUICK ACTION -->
    <div class="bg-white rounded-2xl p-6 shadow">

        <h3 class="font-semibold text-gray-700 mb-4">
            Quick Actions
        </h3>

        <div class="grid grid-cols-3 gap-4">

            <a href="#" class="bg-teal-50 hover:bg-teal-100 transition p-4 rounded-xl text-center">
                <div class="text-xl">👥</div>
                <p class="text-sm mt-2 text-gray-700">Kelola User</p>
            </a>

            <a href="#" class="bg-teal-50 hover:bg-teal-100 transition p-4 rounded-xl text-center">
                <div class="text-xl">🏢</div>
                <p class="text-sm mt-2 text-gray-700">Kelola Terapis</p>
            </a>

            <a href="#" class="bg-teal-50 hover:bg-teal-100 transition p-4 rounded-xl text-center">
                <div class="text-xl">⚙️</div>
                <p class="text-sm mt-2 text-gray-700">Pengaturan Sistem</p>
            </a>

        </div>

    </div>--}}


    <!-- INFO -->
    <div class="bg-white rounded-2xl p-6 shadow">

        <h3 class="font-semibold text-gray-700 mb-3">
            Informasi Sistem
        </h3>

        <div class="text-sm text-gray-600 space-y-1">

            <p>• Role management aktif</p>
            <p>• Sistem transaksi berjalan normal</p>
            <p>• Database terhubung (SQLite)</p>

        </div>

    </div>

</div>

@endsection