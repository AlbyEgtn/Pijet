@extends('layouts.auth')

@section('title', 'Login')

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

            <!-- logo -->
            <img src="{{ asset('images/logo.png') }}" class="mx-auto w-12 mb-2">

            <h1 class="text-lg font-semibold tracking-wide">
                Selamat Datang
            </h1>

            <p class="text-xs opacity-80 mt-1">
                Masuk untuk melanjutkan
            </p>

        </div>


        <!-- ================= CARD LOGIN ================= -->
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
            <h1 class="text-xl font-semibold text-center mb-6">
                Login
            </h1>


            <!-- ================= FORM ================= -->
            <form method="POST" action="/login">

                @csrf

                <!-- EMAIL -->
                <div class="mb-4">
                    <input
                        type="text"
                        name="email"
                        placeholder="Email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-full
                        focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm"
                    >
                </div>

                <!-- PASSWORD -->
                <div class="mb-2 relative">

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-full
                        focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm"
                    >

                    <button
                        type="button"
                        onclick="togglePassword()"
                        class="absolute right-4 top-3 text-gray-400 hover:text-gray-600"
                    >

                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                                  c4.478 0 8.268 2.943 9.542 7
                                  -1.274 4.057-5.064 7-9.542 7
                                  -4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        <svg id="eyeClosed"
                             xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5 hidden"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-width="2"
                                  d="M6 6l12 12M3 12s3-6 9-6 9 6 9 6-3 6-9 6-9-6-9-6z"/>
                        </svg>

                    </button>

                </div>

                <!-- FORGOT -->
                <div class="text-right text-xs mb-6">
                    <a href="/forgot-password"
                       class="text-teal-600 hover:underline">
                        Lupa Password?
                    </a>
                </div>

                <!-- BUTTON -->
                <button
                    class="w-full bg-gradient-to-r from-teal-500 to-teal-600
                    hover:from-teal-600 hover:to-teal-700
                    transition text-white py-3 rounded-full text-sm font-medium shadow-md"
                >
                    Masuk
                </button>

                <!-- REGISTER -->
                <div class="text-center text-sm text-gray-500 mt-6">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                       class="text-teal-600 font-medium hover:underline">
                        Daftar di sini
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

function togglePassword(){

    const input = document.getElementById("password");
    const eyeOpen = document.getElementById("eyeOpen");
    const eyeClosed = document.getElementById("eyeClosed");

    if(input.type === "password"){
        input.type = "text";
        eyeOpen.classList.add("hidden");
        eyeClosed.classList.remove("hidden");
    }else{
        input.type = "password";
        eyeOpen.classList.remove("hidden");
        eyeClosed.classList.add("hidden");
    }

}

</script>

@endpush