@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('body-class', 'h-screen w-screen overflow-hidden bg-black')

@section('content')

<div class="h-full w-full flex">

    <!-- LEFT SIDE -->
    <div class="w-1/2 relative flex items-center justify-center text-white
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


    <!-- RIGHT SIDE -->
    <div class="w-1/2 bg-gray-100 flex items-center justify-center">

        <div class="bg-white shadow-lg rounded-xl p-10 w-[380px]">

            <!-- LOGO -->
            <div class="flex items-center justify-center gap-2 mb-8">

                <img src="{{ asset('images/logo.png') }}" class="w-8 h-8">

                <span class="text-teal-600 font-semibold text-lg">
                    Pijat.in
                </span>

            </div>

            <h1 class="text-xl font-semibold text-center mb-3">
                Lupa Kata Sandi
            </h1>

            <p class="text-sm text-gray-500 text-center mb-6">
                Masukkan email untuk menerima kode verifikasi
            </p>

            <form method="POST" action="{{ route('forgot.send') }}">
                @csrf

                <div class="mb-5">

                    <input
                        type="email"
                        name="email"
                        placeholder="Masukkan Email"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-full
                        focus:outline-none focus:ring-2 focus:ring-teal-400"
                    >

                </div>

                <button
                    class="w-full bg-teal-500 hover:bg-teal-600
                    transition text-white py-2 rounded-full">

                    Selanjutnya

                </button>

            </form>

        </div>

    </div>

</div>

@endsection