@extends('layouts.customer')

@section('title', 'Dashboard Customer')

@section('content')

<div class="max-w-7xl mx-auto space-y-10">

    {{-- HERO / PENAWARAN --}}
    <section class="bg-teal-700 rounded-xl p-6 text-white">

        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-xl font-semibold">
                    Selamat Datang di Pijetin
                </h1>

                <p class="text-sm opacity-90 mt-1">
                    Nikmati pengalaman pijat profesional di rumah anda
                </p>
            </div>

            <a href="{{ route('customer.services') }}"
               class="bg-white text-teal-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
                Pesan Sekarang
            </a>

        </div>

    </section>



    {{-- LAYANAN --}}
    <section>

        <div class="flex justify-between items-center mb-5">

            <h2 class="text-lg font-semibold">
                Layanan
            </h2>

            <a href="{{ route('customer.services') }}"
               class="text-teal-600 text-sm hover:underline">
                Selengkapnya
            </a>

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <x-customer.service-card
                title="Full Body Massage"
                price="Rp150.000 / sesi"
                image="/images/fbm.png"
            />

            <x-customer.service-card
                title="Hot Stone Massage"
                price="Rp150.000 / sesi"
                image="/images/hsm.png"
            />

            <x-customer.service-card
                title="Thai Massage"
                price="Rp150.000 / sesi"
                image="/images/thaim.png"
            />

            <x-customer.service-card
                title="Traditional Massage"
                price="Rp150.000 / sesi"
                image="/images/tradm.png"
            />

            <x-customer.service-card
                title="Deep Tissue Massage"
                price="Rp150.000 / sesi"
                image="/images/dtm.png"
            />

            <x-customer.service-card
                title="Swedish Massage"
                price="Rp150.000 / sesi"
                image="/images/sm.png"
            />

        </div>

    </section>



    {{-- TERAKHIR DIPESAN --}}
    <section>

        <div class="flex justify-between items-center mb-5">

            <h2 class="text-lg font-semibold">
                Terakhir Dipesan
            </h2>

            <a href="{{ route('customer.orders') }}"
               class="text-teal-600 text-sm hover:underline">
                Selengkapnya
            </a>

        </div>


        <div class="bg-white rounded-xl shadow p-4">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-4">

                    <img
                        src="/images/tradm.png"
                        class="w-16 h-16 rounded-lg object-cover"
                    >

                    <div>

                        <p class="font-semibold text-sm">
                            Traditional Massage
                        </p>

                        <p class="text-xs text-gray-500">
                            12 Mei 2026
                        </p>

                    </div>

                </div>

                <span class="text-teal-600 font-semibold">
                    Rp150.000
                </span>

            </div>

        </div>

    </section>

</div>

@endsection