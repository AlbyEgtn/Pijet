@props([
    'therapists',
    'mode' => 'list'
])

<div class="
    bg-white
    rounded-3xl
    shadow-sm
    border border-gray-100
    overflow-hidden
">

    <!-- ================= HEADER ================= -->
    <div class="
        px-5 md:px-6
        py-5
        border-b border-gray-100
    ">

        <div class="
            flex flex-col lg:flex-row
            lg:items-center
            lg:justify-between
            gap-4
        ">

            <!-- TITLE -->
            <div>

                <h2 class="text-lg font-semibold text-gray-800">

                    @if($mode == 'review')
                        Rating & Ulasan Terapis
                    @elseif($mode == 'verify')
                        Verifikasi Terapis
                    @else
                        Data Terapis
                    @endif

                </h2>

                <p class="text-sm text-gray-400 mt-1">

                    @if($mode == 'review')
                        Monitoring rating dan ulasan therapist
                    @elseif($mode == 'verify')
                        Monitoring status verifikasi therapist
                    @else
                        Monitoring seluruh data therapist
                    @endif

                </p>

            </div>


            <!-- SEARCH -->
            <form
                method="GET"
                class="
                    flex flex-col sm:flex-row
                    gap-3
                    w-full lg:w-auto
                "
            >

                <!-- INPUT -->
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama, email, no hp..."
                    value="{{ request('search') }}"
                    class="
                        w-full lg:w-80
                        px-4 py-3
                        rounded-2xl
                        border border-gray-200
                        text-sm
                        focus:ring-2 focus:ring-teal-500
                        focus:border-transparent
                        outline-none
                    "
                >


                <!-- BUTTON -->
                <button
                    type="submit"
                    class="
                        bg-teal-600
                        hover:bg-teal-700
                        transition
                        text-white
                        px-5 py-3
                        rounded-2xl
                        text-sm font-medium
                        shadow-sm
                    "
                >

                    Cari

                </button>

            </form>

        </div>

    </div>


    @php

        $shiftLabels = [

            'shift_1' => [
                'title' => 'Shift 1',
                'time' => '06:00 - 12:00'
            ],

            'shift_2' => [
                'title' => 'Shift 2',
                'time' => '12:00 - 18:00'
            ],

            'shift_3' => [
                'title' => 'Shift 3',
                'time' => '18:00 - 00:00'
            ],
        ];

    @endphp


    <!-- ================= MOBILE VIEW ================= -->
    <div class="block md:hidden">

        @forelse($therapists as $item)

        <div class="
            p-5
            border-b border-gray-100
            space-y-5
        ">

            <!-- TOP -->
            <div class="
                flex items-start justify-between
                gap-3
            ">

                <!-- PROFILE -->
                <div class="
                    flex items-center gap-4
                    min-w-0
                ">

                    <!-- AVATAR -->
                    <div class="
                        w-14 h-14
                        rounded-2xl
                        bg-teal-600
                        text-white
                        flex items-center justify-center
                        font-semibold text-lg
                        shrink-0
                    ">

                        {{ strtoupper(substr($item->name,0,1)) }}

                    </div>


                    <!-- INFO -->
                    <div class="min-w-0">

                        <p class="
                            font-semibold
                            text-gray-800
                            truncate
                        ">
                            {{ $item->name }}
                        </p>

                        <p class="
                            text-sm
                            text-gray-400
                            truncate mt-1
                        ">
                            {{ $item->email }}
                        </p>

                        <p class="
                            text-sm
                            text-gray-400
                            truncate
                        ">
                            {{ $item->phone }}
                        </p>

                    </div>

                </div>


                <!-- STATUS -->
                @if($mode == 'verify')

                    @if($item->verification_status == 'approved')

                        <span class="
                            px-3 py-1.5
                            rounded-full
                            bg-green-100
                            text-green-700
                            text-xs font-semibold
                            whitespace-nowrap
                        ">

                            Verified

                        </span>

                    @elseif($item->verification_status == 'rejected')

                        <span class="
                            px-3 py-1.5
                            rounded-full
                            bg-red-100
                            text-red-700
                            text-xs font-semibold
                            whitespace-nowrap
                        ">

                            Rejected

                        </span>

                    @else

                        <span class="
                            px-3 py-1.5
                            rounded-full
                            bg-yellow-100
                            text-yellow-700
                            text-xs font-semibold
                            whitespace-nowrap
                        ">

                            Pending

                        </span>

                    @endif

                @endif

            </div>


            <!-- DETAIL -->
            <div class="
                grid grid-cols-2
                gap-4
                text-sm
            ">

                <!-- EXPERIENCE -->
                <div>

                    <p class="text-gray-400 text-xs mb-1">
                        Pengalaman
                    </p>

                    <p class="font-medium text-gray-700">
                        {{ $item->therapistProfile?->experience_years ?? 0 }} Tahun
                    </p>

                </div>


                <!-- CITY -->
                <div>

                    <p class="text-gray-400 text-xs mb-1">
                        Kota
                    </p>

                    <p class="font-medium text-gray-700">
                        {{ $item->therapistProfile?->city?->name ?? '-' }}
                    </p>

                </div>

            </div>


            <!-- WORK DAYS -->
            <div>

                <p class="text-gray-400 text-xs mb-2">
                    Hari Kerja
                </p>

                <div class="flex flex-wrap gap-2">

                    @forelse($item->therapistProfile?->work_days ?? [] as $day)

                        <span class="
                            px-3 py-1.5
                            rounded-xl
                            bg-gray-100
                            text-gray-700
                            text-xs
                        ">

                            {{ $day }}

                        </span>

                    @empty

                        <span class="text-gray-400 text-xs">
                            -
                        </span>

                    @endforelse

                </div>

            </div>


            <!-- SHIFT -->
            <div>

                <p class="text-gray-400 text-xs mb-2">
                    Shift Kerja
                </p>

                <div class="space-y-2">

                    @forelse($item->therapistProfile?->work_shifts ?? [] as $shift)

                    <div class="
                        bg-teal-50
                        border border-teal-100
                        rounded-2xl
                        p-3
                    ">

                        <div class="
                            flex items-center justify-between
                        ">

                            <div>

                                <p class="
                                    text-sm
                                    font-semibold
                                    text-teal-700
                                ">

                                    {{ $shiftLabels[$shift]['title'] ?? '-' }}

                                </p>

                                <p class="
                                    text-xs
                                    text-teal-600
                                    mt-1
                                ">

                                    {{ $shiftLabels[$shift]['time'] ?? '-' }}

                                </p>

                            </div>


                            <div class="
                                w-2 h-2
                                rounded-full
                                bg-teal-500
                            "></div>

                        </div>

                    </div>

                    @empty

                    <div class="
                        text-sm text-gray-400
                    ">
                        -
                    </div>

                    @endforelse

                </div>

            </div>


            <!-- RATING -->
            @if($mode == 'review')

            @php

                $avgRating = round(
                    $item->reviewsReceived_avg_rating ?? 0,
                    1
                );

                $totalReview = $item->reviewsReceived_count ?? 0;

            @endphp

            <div class="
                flex items-center justify-between
                bg-yellow-50
                rounded-2xl
                p-4
            ">

                <div>

                    <p class="text-yellow-700 font-semibold">
                        Rating
                    </p>

                    <p class="text-xs text-yellow-600 mt-1">
                        {{ $totalReview }} ulasan
                    </p>

                </div>


                <div class="
                    flex items-center gap-2
                ">

                    <span class="text-xl">
                        ⭐
                    </span>

                    <span class="
                        text-2xl
                        font-bold
                        text-gray-800
                    ">

                        {{ $avgRating }}

                    </span>

                </div>

            </div>

            @endif


            <!-- ACTION -->
            <div class="pt-2">

                @if($mode == 'review')

                <a href="{{ route('admin.therapist.review.detail', $item->id) }}"
                    class="
                        block
                        w-full
                        text-center
                        bg-yellow-50
                        text-yellow-700
                        hover:bg-yellow-100
                        transition
                        py-3
                        rounded-2xl
                        text-sm font-medium
                    ">

                    Review

                </a>

                @else

                <a href="{{ route('admin.therapist.show', $item->id) }}"
                    class="
                        block
                        w-full
                        text-center
                        bg-blue-50
                        text-blue-600
                        hover:bg-blue-100
                        transition
                        py-3
                        rounded-2xl
                        text-sm font-medium
                    ">

                    Detail

                </a>

                @endif

            </div>

        </div>

        @empty

        <!-- EMPTY -->
        <div class="
            p-10
            text-center
        ">

            <div class="text-5xl mb-3">
                💆
            </div>

            <p class="text-gray-500 font-medium">
                Data therapist tidak ditemukan
            </p>

        </div>

        @endforelse

    </div>


    <!-- ================= DESKTOP TABLE ================= -->
    <div class="hidden md:block overflow-x-auto">

        <table class="min-w-full text-sm">

            <!-- HEADER -->
            <thead class="
                bg-gray-50
                text-gray-500
                text-xs
                uppercase
            ">

                <tr>

                    <th class="px-6 py-4 text-left font-medium">
                        Terapis
                    </th>

                    <th class="px-6 py-4 text-center font-medium">
                        Pengalaman
                    </th>

                    <th class="px-6 py-4 text-center font-medium">
                        Kota
                    </th>

                    <th class="px-6 py-4 text-center font-medium">
                        Hari Kerja
                    </th>

                    <th class="px-6 py-4 text-center font-medium">
                        Shift Kerja
                    </th>

                    @if($mode == 'review')

                    <th class="px-6 py-4 text-center font-medium">
                        Rating
                    </th>

                    @endif

                    @if($mode == 'verify')

                    <th class="px-6 py-4 text-center font-medium">
                        Status
                    </th>

                    @endif

                    <th class="px-6 py-4 text-center font-medium">
                        Aksi
                    </th>

                </tr>

            </thead>


            <!-- BODY -->
            <tbody class="divide-y divide-gray-100">

                @forelse($therapists as $item)

                <tr class="hover:bg-gray-50 transition">

                    <!-- THERAPIST -->
                    <td class="px-6 py-5">

                        <div class="flex items-center gap-4">

                            <!-- AVATAR -->
                            <div class="
                                w-12 h-12
                                rounded-2xl
                                bg-teal-600
                                text-white
                                flex items-center justify-center
                                font-semibold
                                shrink-0
                            ">

                                {{ strtoupper(substr($item->name,0,1)) }}

                            </div>


                            <!-- INFO -->
                            <div class="min-w-0">

                                <p class="
                                    font-semibold
                                    text-gray-800
                                    truncate
                                ">
                                    {{ $item->name }}
                                </p>

                                <p class="
                                    text-xs
                                    text-gray-400
                                    mt-1
                                ">
                                    {{ $item->email }}
                                </p>

                                <p class="
                                    text-xs
                                    text-gray-400
                                ">
                                    {{ $item->phone }}
                                </p>

                            </div>

                        </div>

                    </td>


                    <!-- EXPERIENCE -->
                    <td class="
                        px-6 py-5
                        text-center
                    ">

                        <span class="
                            inline-flex items-center
                            px-3 py-1.5
                            rounded-full
                            bg-blue-50
                            text-blue-600
                            text-xs font-semibold
                        ">

                            {{ $item->therapistProfile?->experience_years ?? 0 }} Tahun

                        </span>

                    </td>


                    <!-- CITY -->
                    <td class="
                        px-6 py-5
                        text-center
                        text-gray-700
                    ">

                        {{ $item->therapistProfile?->city?->name ?? '-' }}

                    </td>


                    <!-- WORK DAYS -->
                    <td class="px-6 py-5">

                        <div class="
                            flex flex-wrap
                            justify-center
                            gap-2
                        ">

                            @forelse($item->therapistProfile?->work_days ?? [] as $day)

                            <span class="
                                px-3 py-1
                                rounded-xl
                                bg-gray-100
                                text-gray-700
                                text-xs
                            ">

                                {{ $day }}

                            </span>

                            @empty

                            <span class="text-gray-400 text-xs">
                                -
                            </span>

                            @endforelse

                        </div>

                    </td>


                    <!-- SHIFT -->
                    <td class="px-6 py-5">

                        <div class="space-y-2">

                            @forelse($item->therapistProfile?->work_shifts ?? [] as $shift)

                            <div class="
                                bg-teal-50
                                border border-teal-100
                                rounded-2xl
                                px-3 py-2
                            ">

                                <div class="
                                    flex items-center justify-between
                                ">

                                    <div>

                                        <p class="
                                            text-xs
                                            font-semibold
                                            text-teal-700
                                        ">

                                            {{ $shiftLabels[$shift]['title'] ?? '-' }}

                                        </p>

                                        <p class="
                                            text-[11px]
                                            text-teal-600
                                            mt-0.5
                                        ">

                                            {{ $shiftLabels[$shift]['time'] ?? '-' }}

                                        </p>

                                    </div>


                                    <span class="
                                        w-2 h-2
                                        rounded-full
                                        bg-teal-500
                                    "></span>

                                </div>

                            </div>

                            @empty

                            <div class="
                                text-center
                                text-gray-400
                                text-xs
                            ">

                                -

                            </div>

                            @endforelse

                        </div>

                    </td>


                    <!-- RATING -->
                    @if($mode == 'review')

                    @php

                        $avgRating = round(
                            $item->reviewsReceived_avg_rating ?? 0,
                            1
                        );

                        $totalReview = $item->reviewsReceived_count ?? 0;

                    @endphp

                    <td class="px-6 py-5">

                        <div class="
                            flex flex-col
                            items-center
                        ">

                            <div class="
                                flex items-center gap-2
                            ">

                                <span class="text-yellow-500 text-lg">
                                    ⭐
                                </span>

                                <span class="
                                    font-bold
                                    text-gray-800
                                    text-lg
                                ">

                                    {{ $avgRating }}

                                </span>

                            </div>

                            <span class="
                                text-xs
                                text-gray-400
                                mt-1
                            ">

                                {{ $totalReview }} ulasan

                            </span>

                        </div>

                    </td>

                    @endif


                    <!-- STATUS -->
                    @if($mode == 'verify')

                    <td class="
                        px-6 py-5
                        text-center
                    ">

                        @if($item->verification_status == 'approved')

                            <span class="
                                px-3 py-1.5
                                rounded-full
                                bg-green-100
                                text-green-700
                                text-xs font-semibold
                            ">

                                Verified

                            </span>

                        @elseif($item->verification_status == 'rejected')

                            <span class="
                                px-3 py-1.5
                                rounded-full
                                bg-red-100
                                text-red-700
                                text-xs font-semibold
                            ">

                                Rejected

                            </span>

                        @else

                            <span class="
                                px-3 py-1.5
                                rounded-full
                                bg-yellow-100
                                text-yellow-700
                                text-xs font-semibold
                            ">

                                Pending

                            </span>

                        @endif

                    </td>

                    @endif


                    <!-- ACTION -->
                    <td class="
                        px-6 py-5
                        text-center
                    ">

                        @if($mode == 'review')

                        <a href="{{ route('admin.therapist.review.detail', $item->id) }}"
                            class="
                                inline-flex items-center justify-center
                                px-4 py-2
                                rounded-xl
                                bg-yellow-50
                                text-yellow-700
                                hover:bg-yellow-100
                                transition
                                text-xs font-medium
                            ">

                            Review

                        </a>

                        @else

                        <a href="{{ route('admin.therapist.show', $item->id) }}"
                            class="
                                inline-flex items-center justify-center
                                px-4 py-2
                                rounded-xl
                                bg-blue-50
                                text-blue-600
                                hover:bg-blue-100
                                transition
                                text-xs font-medium
                            ">

                            Detail

                        </a>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8"
                        class="
                            text-center
                            p-10
                            text-gray-400
                        ">

                        Data therapist tidak ditemukan

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <!-- ================= FOOTER ================= -->
    <div class="
        flex flex-col md:flex-row
        items-center justify-between
        gap-4
        px-5 md:px-6
        py-4
        border-t border-gray-100
        bg-white
    ">

        <span class="text-sm text-gray-500">

            Menampilkan {{ $therapists->count() }} data

        </span>


        <div>

            {{ $therapists->links() }}

        </div>

    </div>

</div>