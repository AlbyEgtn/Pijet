@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('body-class', 'min-h-screen w-screen bg-gray-100')

@section('content')

<div class="min-h-screen w-full flex flex-col md:flex-row">

    <!-- ================= LEFT (DESKTOP ONLY) ================= -->
    <div class="hidden md:flex w-1/2 relative items-center justify-center text-white
        bg-gradient-to-br from-teal-600 via-teal-500 to-emerald-400">

        <div class="absolute inset-0 opacity-10 bg-[url('/images/chart.png')] bg-cover"></div>

        <div class="relative text-center max-w-sm px-6">

            <img src="/images/pijit.png" class="mx-auto mb-8 w-48 drop-shadow-xl">

            <h2 class="text-xl font-semibold mb-3">
                Layanan Pijat Profesional
            </h2>

            <p class="text-sm opacity-90 leading-relaxed">
                Platform manajemen layanan pijat yang membantu
                mengelola pemesanan, jadwal terapis, serta aktivitas
                layanan secara terintegrasi dalam satu sistem yang
                mudah digunakan.
            </p>

        </div>
    </div>


    <!-- ================= RIGHT ================= -->
    <div class="w-full md:w-1/2 flex flex-col items-center justify-start md:justify-center relative">

        <!-- ================= MOBILE HEADER ================= -->
        <div class="md:hidden w-full relative bg-gradient-to-br from-teal-600 to-teal-500 text-white text-center pt-10 pb-20 rounded-b-[60px] shadow-md">

            <img src="{{ asset('images/logo.png') }}" class="mx-auto w-12 mb-2">

            <h1 class="text-lg font-semibold tracking-wide">
                Lupa Password
            </h1>

            <p class="text-xs opacity-80 mt-1">
                Reset akun Anda dengan mudah
            </p>

        </div>


        <!-- ================= CARD ================= -->
        <div class="
            bg-white shadow-xl rounded-2xl
            px-6 py-8 md:p-10
            w-[92%] max-w-[380px]
            -mt-16 md:mt-0
            relative z-10
        ">

            <!-- DESKTOP LOGO -->
            <div class="hidden md:flex items-center justify-center gap-2 mb-8">

                <img src="{{ asset('images/logo.png') }}" class="w-8 h-8">

                <span class="text-teal-600 font-semibold text-lg">
                    Pijat.in
                </span>

            </div>

            <!-- TITLE -->
            <h1 class="text-xl font-semibold text-center mb-2">
                Lupa Kata Sandi
            </h1>

            <p class="text-sm text-gray-500 text-center mb-6">
                Masukkan email untuk menerima kode verifikasi
            </p>


            <!-- ================= FORM ================= -->
            <form method="POST" action="{{ route('forgot.send') }}">
                @csrf

                <div class="mb-5">

                    <input
                        type="email"
                        name="email"
                        placeholder="Masukkan Email"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-full
                        focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm"
                    >

                </div>

                <button
                    class="w-full bg-gradient-to-r from-teal-500 to-teal-600
                    hover:from-teal-600 hover:to-teal-700
                    transition text-white py-3 rounded-full text-sm font-medium shadow-md">

                    Selanjutnya

                </button>

                <!-- BACK -->
                <div class="text-center text-sm text-gray-500 mt-6">
                    Ingat password?
                    <a href="{{ route('login') }}"
                       class="text-teal-600 font-medium hover:underline">
                        Kembali Login
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection