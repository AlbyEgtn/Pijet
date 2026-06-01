@extends('layouts.admin')

@section('title','Rating & Ulasan')
@section('header','Rating & Ulasan')

@section('content')

<div class="p-6 space-y-6">

    <!-- ================= HEADER ================= -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-2xl font-bold text-gray-800">
                Rating & Ulasan Terapis
            </h1>

            <p class="text-sm text-gray-400 mt-1">
                Monitoring kualitas therapist berdasarkan review pelanggan
            </p>

        </div>

    </div>


    <!-- ================= STATS ================= -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <!-- TOTAL -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

            <p class="text-sm text-gray-400">
                Total Review
            </p>

            <h2 class="text-3xl font-bold text-gray-800 mt-2">

                {{ $totalReview }}

            </h2>

        </div>


        <!-- AVG -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

            <p class="text-sm text-gray-400">
                Rating Rata-rata
            </p>

            <h2 class="text-3xl font-bold text-yellow-500 mt-2">

                ⭐ {{ $avgRating }}

            </h2>

        </div>


        <!-- BEST -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

            <p class="text-sm text-gray-400">
                Therapist Terbaik
            </p>

            <h2 class="text-lg font-bold text-gray-800 mt-2">

                {{ $bestTherapist?->name ?? '-' }}

            </h2>

        </div>

    </div>


    <!-- ================= FILTER ================= -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5">

        <form method="GET">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

                <!-- SEARCH -->
                <div class="lg:col-span-8">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari customer, therapist, atau ulasan..."
                        class="w-full border border-gray-200 rounded-2xl px-5 py-3
                        focus:ring-2 focus:ring-teal-500 outline-none"
                    >

                </div>


                <!-- FILTER -->
                <div class="lg:col-span-2">

                    <select
                        name="rating"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3
                        focus:ring-2 focus:ring-teal-500 outline-none"
                    >

                        <option value="">
                            Semua Rating
                        </option>

                        @for($i=5; $i>=1; $i--)

                        <option
                            value="{{ $i }}"
                            {{ request('rating') == $i ? 'selected' : '' }}
                        >

                            ⭐ {{ $i }}

                        </option>

                        @endfor

                    </select>

                </div>


                <!-- BUTTON -->
                <div class="lg:col-span-2">

                    <button
                        class="w-full bg-teal-600 hover:bg-teal-700 transition
                        text-white py-3 rounded-2xl font-medium"
                    >

                        Filter

                    </button>

                </div>

            </div>

        </form>

    </div>


    <!-- ================= REVIEW LIST ================= -->
    <div class="space-y-5">

        @forelse($reviews as $review)

        @php

            $badge = match(true){

                $review->rating >= 4 =>
                    'bg-green-100 text-green-700 border-green-200',

                $review->rating >= 3 =>
                    'bg-yellow-100 text-yellow-700 border-yellow-200',

                default =>
                    'bg-red-100 text-red-700 border-red-200'
            };

        @endphp

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">

            <div class="p-6">

                <div class="flex flex-col xl:flex-row xl:items-start justify-between gap-6">

                    <!-- LEFT -->
                    <div class="flex-1">

                        <div class="flex items-start gap-4">

                            <!-- AVATAR -->
                            <img
                                src="https://ui-avatars.com/api/?name={{ urlencode($review->customer->name ?? 'User') }}"
                                class="w-14 h-14 rounded-2xl border"
                            >

                            <div class="flex-1">

                                <!-- CUSTOMER -->
                                <div class="flex flex-wrap items-center gap-2">

                                    <h3 class="font-bold text-gray-800 text-lg">

                                        {{ $review->customer->name ?? '-' }}

                                    </h3>

                                    <span class="text-xs text-gray-400">
                                        memberi ulasan kepada
                                    </span>

                                    <span class="font-semibold text-teal-700">

                                        {{ $review->therapist->name ?? '-' }}

                                    </span>

                                </div>

                                <!-- EMAIL -->
                                <p class="text-sm text-gray-400 mt-1">

                                    {{ $review->customer->email ?? '-' }}

                                </p>

                                <!-- REVIEW -->
                                <div class="mt-4 bg-gray-50 rounded-2xl p-4">

                                    <p class="text-gray-700 leading-relaxed">

                                        "{{ $review->review }}"

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- RIGHT -->
                    <div class="xl:w-52 shrink-0">

                        <div class="flex xl:flex-col gap-4">

                            <!-- RATING -->
                            <div class="flex-1 border rounded-2xl p-4 {{ $badge }}">

                                <p class="text-xs uppercase tracking-wide opacity-70">
                                    Rating
                                </p>

                                <div class="flex items-center gap-2 mt-2">

                                    <span class="text-2xl">
                                        ⭐
                                    </span>

                                    <span class="text-2xl font-bold">

                                        {{ $review->rating }}

                                    </span>

                                    <span class="text-sm">
                                        / 5
                                    </span>

                                </div>

                            </div>


                            <!-- DATE -->
                            <div class="flex-1 bg-gray-50 rounded-2xl p-4">

                                <p class="text-xs uppercase tracking-wide text-gray-400">
                                    Tanggal
                                </p>

                                <p class="font-semibold text-gray-700 mt-2">

                                    {{ $review->created_at->format('d M Y') }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-16 text-center">

            <div class="text-6xl mb-5">
                ⭐
            </div>

            <h3 class="text-xl font-semibold text-gray-700">
                Belum Ada Review
            </h3>

            <p class="text-gray-400 mt-2">
                Review therapist dari pelanggan akan muncul di sini
            </p>

        </div>

        @endforelse

    </div>


    <!-- ================= PAGINATION ================= -->
    @if($reviews->hasPages())

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5">

        {{ $reviews->links() }}

    </div>

    @endif

</div>

@endsection