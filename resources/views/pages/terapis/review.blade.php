@extends('layouts.terapis')

@section('title','Rating & Ulasan')

@section('content')

<div class="space-y-6">

    <!-- ================= HEADER ================= -->
    <div>

        <h1 class="text-2xl font-bold text-gray-800">
            Rating & Ulasan
        </h1>

        <p class="text-gray-400 mt-1">
            Lihat penilaian dan ulasan dari customer
        </p>

    </div>


    <!-- ================= STATS ================= -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <!-- AVG -->
        <div class="bg-gradient-to-r from-teal-700 to-emerald-700 rounded-3xl p-6 text-white shadow-lg">

            <p class="text-white/70 text-sm">
                Rating Rata-rata
            </p>

            <div class="flex items-center gap-4 mt-4">

                <div class="text-6xl">
                    ⭐
                </div>

                <div>

                    <h2 class="text-5xl font-bold">

                        {{ $avgRating }}

                    </h2>

                    <p class="text-white/70 mt-1">

                        {{ $totalReview }} ulasan

                    </p>

                </div>

            </div>

        </div>


        <!-- DISTRIBUTION -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

            <h2 class="font-bold text-gray-800 mb-5">
                Distribusi Rating
            </h2>

            <div class="space-y-3">

                @for($i=5; $i>=1; $i--)

                @php

                    $count = $ratingStats[$i] ?? 0;

                    $percentage = $totalReview > 0
                        ? ($count / $totalReview) * 100
                        : 0;

                @endphp

                <div class="flex items-center gap-3">

                    <div class="w-12 text-sm font-medium text-gray-700">

                        {{ $i }} ⭐

                    </div>

                    <div class="flex-1 bg-gray-100 rounded-full h-2 overflow-hidden">

                        <div
                            class="bg-yellow-400 h-full rounded-full"
                            style="width: {{ $percentage }}%"
                        ></div>

                    </div>

                    <div class="w-10 text-xs text-gray-500 text-right">

                        {{ $count }}

                    </div>

                </div>

                @endfor

            </div>

        </div>

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

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="p-6">

                <div class="flex flex-col lg:flex-row justify-between gap-5">

                    <!-- LEFT -->
                    <div class="flex items-start gap-4 flex-1">

                        <!-- AVATAR -->
                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode($review->customer->name ?? 'User') }}"
                            class="w-14 h-14 rounded-2xl border"
                        >

                        <div class="flex-1">

                            <h3 class="font-bold text-gray-800">

                                {{ $review->customer->name ?? '-' }}

                            </h3>

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


                    <!-- RIGHT -->
                    <div class="lg:w-48">

                        <div class="flex lg:flex-col gap-4">

                            <!-- RATING -->
                            <div class="border rounded-2xl p-4 {{ $badge }}">

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
                            <div class="bg-gray-50 rounded-2xl p-4">

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
                Review dari customer akan muncul di sini
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