@extends('layouts.superadmin')

@section('title','Pengguna')
@section('header','Pengguna')

@section('content')

<div class="space-y-6">

    <!-- ================= HERO ================= -->
    <div class="
        relative overflow-hidden
        bg-gradient-to-r from-teal-600 via-teal-700 to-teal-800
        rounded-3xl
        p-6 md:p-8
        text-white
        shadow-xl
    ">

        <!-- BG -->
        <div class="
            absolute -top-10 -right-10
            w-56 h-56
            bg-white/10
            rounded-full
            blur-3xl
        "></div>


        <div class="
            relative z-10
            flex flex-col lg:flex-row
            lg:items-center
            lg:justify-between
            gap-6
        ">

            <!-- LEFT -->
            <div>

                <p class="
                    text-sm
                    text-teal-100
                    mb-2
                ">
                    Kelola Pengguna
                </p>

                <h2 class="
                    text-2xl md:text-4xl
                    font-bold
                ">
                    Data Pelanggan
                </h2>

                <p class="
                    text-sm md:text-base
                    text-teal-100
                    mt-3
                    max-w-2xl
                ">
                    Kelola seluruh akun pelanggan yang terdaftar di sistem.
                </p>

            </div>


            <!-- STATS -->
            <div class="
                flex flex-wrap
                gap-4
            ">

                <!-- TOTAL -->
                <div class="
                    bg-white/10
                    backdrop-blur
                    rounded-2xl
                    px-5 py-4
                    min-w-[140px]
                ">

                    <p class="
                        text-xs
                        text-teal-100
                    ">
                        Total Pengguna
                    </p>

                    <h3 class="
                        text-2xl
                        font-bold
                        mt-1
                    ">
                        {{ $users->total() }}
                    </h3>

                </div>


                <!-- ACTIVE -->
                <div class="
                    bg-white/10
                    backdrop-blur
                    rounded-2xl
                    px-5 py-4
                    min-w-[140px]
                ">

                    <p class="
                        text-xs
                        text-teal-100
                    ">
                        Akun Aktif
                    </p>

                    <h3 class="
                        text-2xl
                        font-bold
                        mt-1
                    ">
                        {{ $users->where('is_suspended', false)->count() }}
                    </h3>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= MAIN CARD ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        overflow-hidden
    ">

        <!-- HEADER -->
        <div class="
            p-5 md:p-6
            border-b border-gray-100
            space-y-5
        ">

            <!-- BREADCRUMB -->
            <div class="
                text-sm
                text-gray-400
            ">

                Pengguna
                <span class="mx-2">/</span>

                <span class="
                    text-teal-600
                    font-medium
                ">
                    Pelanggan
                </span>

            </div>


            <!-- TOP -->
            <div class="
                flex flex-col lg:flex-row
                lg:items-center
                lg:justify-between
                gap-4
            ">

                <!-- SEARCH -->
                <form method="GET"
                      class="
                        flex flex-col sm:flex-row
                        gap-3
                        w-full lg:w-auto
                      ">

                    <div class="
                        relative
                        w-full sm:w-96
                    ">

                        <input
                            type="text"
                            name="search"
                            placeholder="Cari nomor id, nama, kota..."
                            value="{{ request('search') }}"
                            class="
                                w-full
                                border border-gray-200
                                rounded-2xl
                                px-5 py-3
                                pr-12
                                text-sm
                                focus:ring-2 focus:ring-teal-500
                                outline-none
                            "
                        >

                        <!-- ICON -->
                        <div class="
                            absolute right-4 top-1/2
                            -translate-y-1/2
                            text-gray-400
                        ">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>

                            </svg>

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="
                            bg-teal-600
                            hover:bg-teal-700
                            text-white
                            px-6 py-3
                            rounded-2xl
                            text-sm font-semibold
                            transition
                        "
                    >

                        Cari

                    </button>

                </form>


                <!-- FILTER -->
                <button class="
                    border border-gray-200
                    hover:bg-gray-50
                    px-5 py-3
                    rounded-2xl
                    text-sm
                    text-gray-600
                    transition
                ">

                    Filter

                </button>

            </div>

        </div>


        <!-- ================= MOBILE CARD ================= -->
        <div class="block md:hidden">

            @forelse($users as $user)

            <div class="
                p-5
                border-b border-gray-100
                space-y-4
            ">

                <!-- TOP -->
                <div class="
                    flex items-start justify-between
                    gap-4
                ">

                    <!-- USER -->
                    <div class="
                        flex items-center
                        gap-3
                    ">

                        <!-- AVATAR -->
                        <div class="
                            w-12 h-12
                            rounded-2xl
                            bg-teal-100
                            text-teal-700
                            flex items-center justify-center
                            font-bold
                        ">

                            {{ strtoupper(substr($user->name,0,1)) }}

                        </div>


                        <!-- INFO -->
                        <div>

                            <h3 class="
                                font-semibold
                                text-gray-800
                            ">
                                {{ $user->name }}
                            </h3>

                            <p class="
                                text-sm
                                text-gray-400
                            ">
                                {{ $user->kode }}
                            </p>

                        </div>

                    </div>


                    <!-- STATUS -->
                    @if($user->is_suspended)

                        <span class="
                            px-3 py-1.5
                            rounded-full
                            text-xs font-semibold
                            bg-red-100
                            text-red-600
                        ">

                            Ditangguhkan

                        </span>

                    @else

                        <span class="
                            px-3 py-1.5
                            rounded-full
                            text-xs font-semibold
                            bg-green-100
                            text-green-600
                        ">

                            Aktif

                        </span>

                    @endif

                </div>


                <!-- DETAIL -->
                <div class="
                    grid grid-cols-1
                    gap-3
                    text-sm
                ">

                    <div>

                        <p class="text-gray-400">
                            Email
                        </p>

                        <p class="
                            text-gray-700
                            font-medium
                            break-all
                        ">
                            {{ $user->email }}
                        </p>

                    </div>


                    <div>

                        <p class="text-gray-400">
                            Kota / Kabupaten
                        </p>

                        <p class="
                            text-gray-700
                            font-medium
                        ">
                            {{ $user->city ?? '-' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-gray-400">
                            Jenis Kelamin
                        </p>

                        <p class="
                            text-gray-700
                            font-medium
                        ">

                            {{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}

                        </p>

                    </div>

                </div>


                <!-- ACTION -->
                <div class="
                    flex items-center
                    gap-3
                    pt-2
                ">

                    <!-- DETAIL -->
                    <a href="{{ route('superadmin.pengguna.detail', [$type, $user->id]) }}"
                       class="
                            flex-1
                            text-center
                            bg-blue-50
                            hover:bg-blue-100
                            text-blue-600
                            py-3
                            rounded-2xl
                            text-sm font-medium
                            transition
                       ">

                        Detail

                    </a>


                    <!-- WARNING -->
                    <button class="
                        px-4
                        bg-yellow-50
                        hover:bg-yellow-100
                        text-yellow-600
                        py-3
                        rounded-2xl
                        transition
                    ">

                        ⚠

                    </button>


                    <!-- STATUS -->
                    @if($user->is_suspended)

                        <button class="
                            px-4
                            bg-green-50
                            hover:bg-green-100
                            text-green-600
                            py-3
                            rounded-2xl
                            transition
                        ">

                            🔒

                        </button>

                    @else

                        <button class="
                            px-4
                            bg-red-50
                            hover:bg-red-100
                            text-red-600
                            py-3
                            rounded-2xl
                            transition
                        ">

                            ⛔

                        </button>

                    @endif

                </div>

            </div>

            @empty

            <div class="
                p-10
                text-center
            ">

                <p class="
                    text-gray-400
                ">
                    Data pengguna tidak ditemukan
                </p>

            </div>

            @endforelse

        </div>


        <!-- ================= DESKTOP TABLE ================= -->
        <div class="
            hidden md:block
            overflow-x-auto
        ">

            <table class="min-w-full text-sm">

                <!-- HEADER -->
                <thead class="
                    bg-gray-50
                    text-xs uppercase
                    text-gray-500
                ">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            Nama Lengkap
                        </th>

                        <th class="px-6 py-4 text-left">
                            Tanggal Lahir
                        </th>

                        <th class="px-6 py-4 text-left">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left">
                            Gender
                        </th>

                        <th class="px-6 py-4 text-left">
                            Kota
                        </th>

                        <th class="px-6 py-4 text-left">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <!-- BODY -->
                <tbody class="divide-y divide-gray-100">

                    @foreach($users as $user)

                    <tr class="
                        hover:bg-gray-50
                        transition
                    ">

                        <!-- NAME -->
                        <td class="px-6 py-5">

                            <div class="
                                flex items-center
                                gap-3
                            ">

                                <!-- AVATAR -->
                                <div class="
                                    w-11 h-11
                                    rounded-2xl
                                    bg-teal-100
                                    text-teal-700
                                    flex items-center justify-center
                                    font-bold
                                ">

                                    {{ strtoupper(substr($user->name,0,1)) }}

                                </div>


                                <div>

                                    <p class="
                                        font-semibold
                                        text-gray-800
                                    ">
                                        {{ $user->name }}
                                    </p>

                                </div>

                            </div>

                        </td>


                        <!-- BIRTH -->
                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            {{ $user->birth_date
                                ? \Carbon\Carbon::parse($user->birth_date)->format('d M Y')
                                : '-'
                            }}

                        </td>


                        <!-- EMAIL -->
                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            {{ $user->email }}

                        </td>


                        <!-- GENDER -->
                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            {{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}

                        </td>


                        <!-- CITY -->
                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            {{ $user->city ?? '-' }}

                        </td>


                        <!-- STATUS -->
                        <td class="px-6 py-5">

                            @if($user->is_suspended)

                                <span class="
                                    px-3 py-1.5
                                    rounded-full
                                    text-xs font-semibold
                                    bg-red-100
                                    text-red-600
                                ">

                                    Ditangguhkan

                                </span>

                            @else

                                <span class="
                                    px-3 py-1.5
                                    rounded-full
                                    text-xs font-semibold
                                    bg-green-100
                                    text-green-600
                                ">

                                    Aktif

                                </span>

                            @endif

                        </td>


                        <!-- ACTION -->
                        <td class="
                            px-6 py-5
                            text-right
                        ">

                            <div class="
                                flex items-center justify-end
                                gap-3
                            ">

                                <!-- DETAIL -->
                                <a href="{{ route('superadmin.pengguna.detail', [$type, $user->id]) }}"
                                   class="
                                        w-10 h-10
                                        rounded-xl
                                        bg-blue-50
                                        hover:bg-blue-100
                                        text-blue-600
                                        flex items-center justify-center
                                        transition
                                   ">

                                    👁

                                </a>


                                <!-- WARNING -->
                                <button class="
                                    w-10 h-10
                                    rounded-xl
                                    bg-yellow-50
                                    hover:bg-yellow-100
                                    text-yellow-600
                                    flex items-center justify-center
                                    transition
                                ">

                                    ⚠

                                </button>


                                <!-- STATUS -->
                                @if($user->is_suspended)

                                    <button class="
                                        w-10 h-10
                                        rounded-xl
                                        bg-green-50
                                        hover:bg-green-100
                                        text-green-600
                                        flex items-center justify-center
                                        transition
                                    ">

                                        🔒

                                    </button>

                                @else

                                    <button class="
                                        w-10 h-10
                                        rounded-xl
                                        bg-red-50
                                        hover:bg-red-100
                                        text-red-600
                                        flex items-center justify-center
                                        transition
                                    ">

                                        ⛔

                                    </button>

                                @endif

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        <!-- ================= PAGINATION ================= -->
        <div class="
            px-6 py-5
            border-t border-gray-100
        ">

            {{ $users->links() }}

        </div>

    </div>

</div>

@endsection