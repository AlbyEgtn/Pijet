@extends('layouts.customer')

@section('content')

<!-- ======================
    HEADER COMPACT
====================== -->
<div class="bg-white/90 backdrop-blur-md sticky top-0 z-40 border-b">

    <!-- TOP -->
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">

        <!-- TITLE -->
        <div>
            <h1 class="text-base font-semibold text-gray-800">
                Layanan
            </h1>
            <p class="text-xs text-gray-500">
                Pilih layanan terbaik untuk relaksasi
            </p>
        </div>

        <!-- CART -->
        <a href="{{ route('customer.cart') }}" class="relative">

            <div class="bg-gray-100 p-2 rounded-full hover:bg-gray-200 transition">
                🛒
            </div>

        </a>

    </div>

    <!-- SEARCH -->
    <div class="max-w-7xl mx-auto px-6 pb-4">

        <form method="GET">
            <div class="flex items-center bg-white rounded-xl px-4 py-2 shadow-sm border border-gray-200 focus-within:ring-2 focus-within:ring-gray-300 transition">

                <span class="text-gray-400 mr-2">🔍</span>

                <input
                    type="text"
                    name="search"
                    placeholder="Cari layanan pijat..."
                    value="{{ request('search') }}"
                    class="w-full bg-transparent text-sm text-gray-700 focus:outline-none"
                >

                @if(request('search'))
                <a href="{{ route('customer.services') }}"
                   class="text-gray-400 hover:text-red-500 text-sm">
                    ✕
                </a>
                @endif

            </div>
        </form>

    </div>

    <!-- ACCENT LINE -->
    <div class="h-[2px] bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>

</div>


<!-- ======================
    CONTENT
====================== -->
<div class="max-w-7xl mx-auto px-6 py-6 space-y-8">


<!-- ======================
    LAYANAN UTAMA
====================== -->
<section>

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-base font-semibold text-gray-800">
            Layanan Utama
        </h2>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

        @foreach($services as $service)

        <div class="bg-white rounded-xl border hover:shadow-md transition overflow-hidden group">

            <div class="aspect-[4/3] overflow-hidden">
                <img
                    src="{{ $service->image_url }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                >
            </div>

            <div class="p-4">

                <h3 class="font-semibold text-sm line-clamp-1 text-gray-800">
                    {{ $service->name }}
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    {{ $service->duration }} menit
                </p>

                <div class="flex justify-between items-center mt-3">

                    <span class="text-teal-600 font-semibold text-sm">
                        Rp {{ number_format($service->price) }}
                    </span>

                    <button
                        onclick="addToCart({{ $service->id }})"
                        class="bg-teal-600 hover:bg-teal-700 text-white w-8 h-8 rounded-full flex items-center justify-center text-lg transition">

                        +

                    </button>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>



<!-- ======================
    LAYANAN TAMBAHAN
====================== -->
<section>

    <h2 class="text-base font-semibold text-gray-800 mb-4">
        Add-on / Layanan Tambahan
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

        @foreach($additionalServices as $service)

        <div class="bg-white rounded-xl border hover:shadow-md transition p-4 flex items-center gap-4">

            <img
                src="{{ $service->image_url }}"
                class="w-14 h-14 rounded-lg object-cover"
            >

            <div class="flex-1">

                <p class="font-semibold text-sm text-gray-800">
                    {{ $service->name }}
                </p>

                <p class="text-xs text-gray-500 line-clamp-2">
                    {{ $service->description }}
                </p>

            </div>

            <div class="text-right">

                <p class="text-teal-600 font-semibold text-sm">
                    Rp {{ number_format($service->price) }}
                </p>

                <button
                    onclick="addToCart({{ $service->id }})"
                    class="mt-1 text-xs bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded transition">

                    Tambah

                </button>

            </div>

        </div>

        @endforeach

    </div>

</section>

</div>

@endsection