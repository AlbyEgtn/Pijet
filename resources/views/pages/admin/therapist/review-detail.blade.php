@extends('layouts.admin')

@section('title','Detail Review Terapis')
@section('header','Detail Review Terapis')

@section('content')

<div class="p-6 space-y-6">

    <!-- ================= HEADER ================= -->
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-bold text-gray-800">
                Review Terapis
            </h1>

            <p class="text-sm text-gray-400 mt-1">
                Monitoring ulasan dan kualitas therapist
            </p>

        </div>

        <a href="{{ route('admin.therapist.review') }}"
           class="px-4 py-2 rounded-2xl border hover:bg-gray-50 transition text-sm">

            ← Kembali

        </a>

    </div>


    <!-- ================= THERAPIST PROFILE ================= -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-teal-700 to-emerald-700 p-6 text-white">

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">

                <div class="flex items-center gap-5">

                    <!-- FOTO -->
                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($therapist->name) }}"
                        class="w-24 h-24 rounded-3xl border-4 border-white/20 shadow-lg"
                    >

                    <!-- INFO -->
                    <div>

                        <h2 class="text-2xl font-bold">

                            {{ $therapist->name }}

                        </h2>

                        <p class="text-white/80 mt-1">

                            {{ $therapist->email }}

                        </p>

                        <p class="text-white/70 text-sm mt-1">

                            {{ $therapist->phone ?? '-' }}

                        </p>

                    </div>

                </div>


                <!-- AVG RATING -->
                <div class="bg-white/10 backdrop-blur rounded-3xl p-5 min-w-[220px]">

                    <p class="text-sm text-white/70">
                        Rating Rata-rata
                    </p>

                    <div class="flex items-center gap-3 mt-3">

                        <span class="text-5xl">
                            ⭐
                        </span>

                        <div>

                            <h2 class="text-4xl font-bold">

                                {{ $avgRating }}

                            </h2>

                            <p class="text-sm text-white/70 mt-1">

                                {{ $totalReview }} ulasan

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- BODY -->
        <div class="p-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

                <!-- EXPERIENCE -->
                <div class="bg-gray-50 rounded-2xl p-5">

                    <p class="text-xs uppercase tracking-wide text-gray-400">
                        Pengalaman
                    </p>

                    <h3 class="text-2xl font-bold text-gray-800 mt-2">

                        {{ $therapist->therapistProfile?->experience_years ?? 0 }}

                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Tahun
                    </p>

                </div>


                <!-- CITY -->
                <div class="bg-gray-50 rounded-2xl p-5">

                    <p class="text-xs uppercase tracking-wide text-gray-400">
                        Kota
                    </p>

                    <h3 class="text-lg font-bold text-gray-800 mt-2">

                        {{ $therapist->therapistProfile?->city?->name ?? '-' }}

                    </h3>

                </div>


                <!-- WORK DAYS -->
                <div class="bg-gray-50 rounded-2xl p-5">

                    <p class="text-xs uppercase tracking-wide text-gray-400 mb-3">
                        Hari Kerja
                    </p>

                    <div class="flex flex-wrap gap-2">

                        @forelse($therapist->therapistProfile?->work_days ?? [] as $day)

                            <span class="px-2 py-1 rounded-lg bg-white border text-xs">

                                {{ $day }}

                            </span>

                        @empty

                            <span class="text-gray-400 text-sm">
                                -
                            </span>

                        @endforelse

                    </div>

                </div>


                <!-- SHIFT -->
                <div class="bg-gray-50 rounded-2xl p-5">

                    <p class="text-xs uppercase tracking-wide text-gray-400 mb-3">
                        Shift Kerja
                    </p>

                    <div class="space-y-2">

                        @php

                            $shiftLabels = [

                                'shift_1' => '06:00 - 12:00',
                                'shift_2' => '12:00 - 18:00',
                                'shift_3' => '18:00 - 00:00',
                            ];

                        @endphp

                        @forelse($therapist->therapistProfile?->work_shifts ?? [] as $shift)

                            <div class="bg-white border rounded-xl px-3 py-2 text-sm">

                                {{ $shiftLabels[$shift] ?? '-' }}

                            </div>

                        @empty

                            <span class="text-gray-400 text-sm">
                                -
                            </span>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= RATING DISTRIBUTION ================= -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

        <h2 class="text-lg font-bold text-gray-800 mb-6">
            Distribusi Rating
        </h2>

        <div class="space-y-4">

            @for($i = 5; $i >= 1; $i--)

            @php

                $count = $ratingStats[$i] ?? 0;

                $percentage = $totalReview > 0
                    ? ($count / $totalReview) * 100
                    : 0;

            @endphp

            <div class="flex items-center gap-4">

                <!-- STAR -->
                <div class="w-16 flex items-center gap-1">

                    <span class="font-semibold text-gray-700">

                        {{ $i }}

                    </span>

                    <span class="text-yellow-500">
                        ★
                    </span>

                </div>


                <!-- BAR -->
                <div class="flex-1 bg-gray-100 rounded-full h-3 overflow-hidden">

                    <div
                        class="h-full bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-full"
                        style="width: {{ $percentage }}%"
                    ></div>

                </div>


                <!-- COUNT -->
                <div class="w-16 text-right text-sm text-gray-500">

                    {{ $count }}

                </div>

            </div>

            @endfor

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

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">

            <div class="p-6">

                <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-5">

                    <!-- ================= LEFT ================= -->
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

                                    <h3 class="font-bold text-gray-800">

                                        {{ $review->customer->name ?? '-' }}

                                    </h3>

                                    <span class="text-xs text-gray-400">

                                        memberikan ulasan

                                    </span>

                                </div>

                                <!-- EMAIL -->
                                <p class="text-sm text-gray-400 mt-1">

                                    {{ $review->customer->email ?? '-' }}

                                </p>

                                <!-- REVIEW -->
                                <div class="mt-4 bg-gray-50 rounded-2xl p-5">

                                    <p class="text-gray-700 leading-relaxed">

                                        "{{ $review->review }}"

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- ================= RIGHT ================= -->
                    <div class="lg:w-52 shrink-0">

                        <div class="flex lg:flex-col gap-4">

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

                                <p class="text-xs text-gray-400 mt-1">

                                    {{ $review->created_at->format('H:i') }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <!-- EMPTY -->
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