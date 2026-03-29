@extends('layouts.terapis')

@section('title','Dashboard')

@section('content')

<div class="p-8 bg-gray-50 min-h-screen">

    <!-- HEADER PROFILE -->
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center justify-between">

        <div class="flex items-center gap-5">

            <div class="w-20 h-20 rounded-full bg-teal-600 text-white flex items-center justify-center text-3xl font-bold">
                {{ strtoupper(substr($user->name,0,1)) }}
            </div>

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ $user->name }}
                </h2>

                <p class="text-gray-500">
                    {{ $user->email }}
                </p>

                <p class="text-sm text-gray-400 mt-1">
                    Terapis
                </p>
            </div>

        </div>

    </div>


    <!-- STATISTIK -->
    <div class="grid grid-cols-2 gap-6 mt-6">

        <div class="bg-white p-6 rounded-xl shadow-sm">

            <p class="text-gray-500 text-sm">
                Total Saldo
            </p>

            <h3 class="text-2xl font-bold text-gray-800 mt-1">
                Rp{{ number_format($terapis->balance ?? 0) }}
            </h3>

        </div>


        <div class="bg-white p-6 rounded-xl shadow-sm">

            <p class="text-gray-500 text-sm">
                Total Layanan
            </p>

            <h3 class="text-2xl font-bold text-gray-800 mt-1">
                {{ $terapis->total_orders ?? 0 }} Pemesanan
            </h3>

        </div>

    </div>



    <!-- MENU PROFILE -->
    <div class="mt-8">

        <h3 class="text-lg font-semibold text-gray-700 mb-4">
            Pengaturan Profil
        </h3>

        <div class="grid grid-cols-3 gap-6">

            <!-- DATA PROFILE -->
            <a href="{{ route('terapis.confirm.password') }}"
               class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">

                <div class="text-teal-600 text-2xl mb-3">
                    👤
                </div>

                <h4 class="font-semibold text-gray-800">
                    Data Profile
                </h4>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola data pribadi terapis
                </p>

            </a>


            <!-- INFORMASI -->
            <a href="{{ route("terapis.informasi.confirm") }}"
               class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">

                <div class="text-teal-600 text-2xl mb-3">
                    ℹ️
                </div>

                <h4 class="font-semibold text-gray-800">
                    Informasi Lainnya
                </h4>

                <p class="text-sm text-gray-500 mt-1">
                    Informasi tambahan akun
                </p>

            </a>


            <!-- PEDOMAN -->
            <a href="{{ route("terapis.pedoman") }}"
               class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">

                <div class="text-teal-600 text-2xl mb-3">
                    📘
                </div>

                <h4 class="font-semibold text-gray-800">
                    Pedoman
                </h4>

                <p class="text-sm text-gray-500 mt-1">
                    Panduan penggunaan sistem
                </p>

            </a>


            <!-- GANTI PASSWORD -->
            <a href="{{ route("terapis.password.form") }}"
               class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">

                <div class="text-teal-600 text-2xl mb-3">
                    🔒
                </div>

                <h4 class="font-semibold text-gray-800">
                    Ganti Password
                </h4>

                <p class="text-sm text-gray-500 mt-1">
                    Ubah password akun
                </p>

            </a>


            <!-- BANTUAN -->
            <a href="{{ route("terapis.bantuan") }}"
               class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">

                <div class="text-teal-600 text-2xl mb-3">
                    ❓
                </div>

                <h4 class="font-semibold text-gray-800">
                    Bantuan
                </h4>

                <p class="text-sm text-gray-500 mt-1">
                    Hubungi bantuan sistem
                </p>

            </a>

        </div>

    </div>

</div>

@endsection