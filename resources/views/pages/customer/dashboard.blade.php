@extends('layouts.customer')

@section('title','Dashboard  ')

@section('content')
<br>
<div class="max-w-7xl mx-auto space-y-12">

    {{-- HERO --}}
    <section class="bg-gradient-to-r from-teal-700 to-teal-600 rounded-2xl p-8 text-white shadow-lg">

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-2xl font-semibold">
                    Selamat Datang di Pijat.in
                </h1>

                <p class="text-sm opacity-90 mt-2">
                    Nikmati pengalaman pijat profesional langsung di rumah Anda.
                </p>

            </div>

            <a href="{{ route('customer.services') }}"
               class="bg-white text-teal-700 px-5 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition shadow">

                Pesan Sekarang

            </a>

        </div>

    </section>



    {{-- LAYANAN --}}
    <section>

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-xl font-semibold">
                Layanan Populer
            </h2>

            <a href="{{ route('customer.services') }}"
               class="text-teal-600 text-sm hover:underline">

                Lihat Semua

            </a>

        </div>


        @if($services->count())

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($services as $service)

                <x-customer.service-card
                    :title="$service->name"
                    :price="'Rp '.number_format($service->price,0,',','.')"
                    :image="$service->image_url"
                />

            @endforeach

        </div>

        @else

        <div class="bg-white rounded-xl shadow p-6 text-center text-gray-500">

            Belum ada layanan tersedia.

        </div>

        @endif

    </section>



    {{-- LAYANAN TAMBAHAN --}}
    <section>

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-xl font-semibold">
                Layanan Tambahan
            </h2>

        </div>


        @if(isset($additionalServices) && $additionalServices->count())

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($additionalServices as $service)

            <div class="bg-white rounded-xl shadow hover:shadow-md transition p-4 flex items-center gap-4">

                <img
                    src="{{ $service->image_url }}"
                    loading="lazy"
                    class="w-14 h-14 rounded-lg object-cover"
                />

                <div class="flex-1">

                    <p class="font-semibold text-sm">
                        {{ $service->name }}
                    </p>

                    <p class="text-xs text-gray-500">
                        {{ $service->description }}
                    </p>

                </div>

                <span class="text-teal-600 font-semibold text-sm">

                    Rp {{ number_format($service->price,0,',','.') }}

                </span>

            </div>

            @endforeach

        </div>

        @else

        <div class="bg-white rounded-xl shadow p-6 text-center text-gray-500">

            Belum ada layanan tambahan tersedia.

        </div>

        @endif

    </section>

</div>

@endsection