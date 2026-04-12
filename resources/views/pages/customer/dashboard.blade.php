@extends('layouts.customer')

@section('title','Dashboard')

@section('content')

<!-- ================= HERO ================= -->
<section class="relative h-[420px] md:h-[480px] bg-gradient-to-r from-teal-800 via-teal-700 to-teal-600 overflow-hidden">

    <!-- overlay halus -->
    <div class="absolute inset-0 bg-black/20"></div>

    <!-- decorative blur -->
    <div class="absolute -top-24 -right-24 w-72 h-72 bg-emerald-300 rounded-full blur-3xl opacity-30"></div>
    <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-teal-300 rounded-full blur-3xl opacity-30"></div>

    <!-- CONTENT -->
    <div class="relative z-10 max-w-7xl mx-auto px-6 h-full flex items-center justify-between text-white">

        <div class="max-w-xl">

            <h1 class="text-3xl md:text-4xl font-semibold leading-tight">
                Relaksasi Profesional, <br>
                <span class="text-emerald-300">Langsung ke Rumah Anda</span>
            </h1>

            <p class="text-sm md:text-base opacity-90 mt-4 leading-relaxed">
                Nikmati pengalaman pijat terbaik dengan terapis profesional.
                Praktis, nyaman, dan berkualitas.
            </p>

            <div class="mt-6 flex gap-4 flex-wrap">

                <a href="{{ route('customer.services') }}"
                   class="bg-emerald-400 hover:bg-emerald-500 text-white px-6 py-3 rounded-xl shadow-lg transition text-sm font-medium">

                    Pesan Sekarang →

                </a>

                <a href="{{ route('customer.orders') }}"
                   class="border border-white/40 hover:bg-white hover:text-teal-800 px-6 py-3 rounded-xl transition text-sm">

                    Lihat Riwayat

                </a>

            </div>

        </div>

        <!-- IMAGE (optional visual) -->
        <div class="hidden md:block">
            <img src="{{ asset('images/pijit.png') }}"
                 class="w-[380px] opacity-90 drop-shadow-xl">
        </div>

    </div>

</section>


<!-- ================= CONTENT ================= -->
<div class="max-w-7xl mx-auto px-6 py-10 space-y-14">


    <!-- ================= LAYANAN POPULER ================= -->
    <section>

        <div class="flex justify-between items-center mb-6">

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Layanan Populer
                </h2>
                <p class="text-xs text-gray-400">
                    Pilihan favorit pelanggan
                </p>
            </div>

            <a href="{{ route('customer.services') }}"
               class="text-teal-600 text-sm hover:underline">
                Lihat Semua →
            </a>

        </div>


        @if($services->count())

        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach($services as $service)

            <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition overflow-hidden">

                <!-- IMAGE -->
                <div class="aspect-[4/3] overflow-hidden">
                    <img src="{{ $service->image_url }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>

                <!-- CONTENT -->
                <div class="p-4">

                    <h3 class="font-semibold text-sm text-gray-800 line-clamp-1">
                        {{ $service->name }}
                    </h3>

                    <p class="text-xs text-gray-400 mt-1">
                        ⏱ {{ $service->duration }} menit
                    </p>

                    <div class="flex justify-between items-center mt-3">

                        <span class="text-teal-600 font-semibold text-sm">
                            Rp {{ number_format($service->price,0,',','.') }}
                        </span>

                        <a href="{{ route('customer.services') }}"
                           class="text-xs bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded-lg transition">
                            Lihat
                        </a>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

        @else

        <div class="bg-white rounded-xl shadow p-6 text-center text-gray-500">
            Belum ada layanan tersedia.
        </div>

        @endif

    </section>



    <!-- ================= LAYANAN TAMBAHAN ================= -->
    <section>

        <div class="mb-6">

            <h2 class="text-xl font-semibold text-gray-800">
                Layanan Tambahan
            </h2>

            <p class="text-xs text-gray-400">
                Pelengkap layanan utama Anda
            </p>

        </div>


        @if(isset($additionalServices) && $additionalServices->count())

        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">

            @foreach($additionalServices as $service)

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition p-4 flex items-center gap-4">

                <!-- IMAGE -->
                <img src="{{ $service->image_url }}"
                     class="w-16 h-16 rounded-xl object-cover">

                <!-- TEXT -->
                <div class="flex-1">

                    <p class="font-semibold text-sm text-gray-800">
                        {{ $service->name }}
                    </p>

                    <p class="text-xs text-gray-400 line-clamp-2">
                        {{ $service->description }}
                    </p>

                </div>

                <!-- PRICE -->
                <div class="text-right">

                    <p class="text-teal-600 font-semibold text-sm">
                        Rp {{ number_format($service->price,0,',','.') }}
                    </p>

                </div>

            </div>

            @endforeach

        </div>

        @else

        <div class="bg-white rounded-xl shadow p-6 text-center text-gray-500">
            Belum ada layanan tambahan tersedia.
        </div>

        @endif

    </section>


    <!-- ================= CTA ================= -->
    <section class="bg-gradient-to-r from-teal-600 to-emerald-500 rounded-2xl p-8 text-white shadow-lg">

        <div class="flex flex-col md:flex-row justify-between items-center gap-4">

            <div>
                <h3 class="text-lg font-semibold">
                    Siap untuk relaksasi hari ini?
                </h3>
                <p class="text-sm opacity-90">
                    Pesan sekarang dan rasakan kenyamanan di rumah Anda.
                </p>
            </div>

            <a href="{{ route('customer.services') }}"
               class="bg-white text-teal-700 px-6 py-3 rounded-xl text-sm font-medium hover:bg-gray-100 transition shadow">
                Pesan Sekarang
            </a>

        </div>

    </section>

</div>

@endsection