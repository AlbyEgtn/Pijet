@extends('layouts.superadmin')

@section('title','Cabang')
@section('header','Cabang')

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
        flex flex-col lg:flex-row
        lg:items-center
        lg:justify-between
        gap-5
    ">

        <!-- BG -->
        <div class="
            absolute -top-10 -right-10
            w-52 h-52
            bg-white/10
            rounded-full
            blur-3xl
        "></div>


        <div class="relative z-10">

            <p class="
                text-sm
                text-teal-100
                mb-2
            ">
                Kelola Cabang
            </p>

            <h2 class="
                text-2xl md:text-4xl
                font-bold
            ">
                Data Cabang
            </h2>

            <p class="
                text-sm md:text-base
                text-teal-100
                mt-3
                max-w-2xl
            ">
                Kelola seluruh data cabang yang terdaftar dalam sistem.
            </p>

        </div>


        <!-- BUTTON -->
        <a href="{{ route('superadmin.cabang.create') }}"
           class="
                relative z-10
                inline-flex items-center justify-center
                bg-white
                hover:bg-gray-100
                text-teal-700
                px-5 py-3
                rounded-2xl
                text-sm font-semibold
                transition
                shadow-sm
           ">

            + Tambah Cabang

        </a>

    </div>


    <!-- ================= MAIN CARD ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        overflow-hidden
    ">

        <!-- ================= SEARCH ================= -->
        <div class="
            p-5 md:p-6
            border-b border-gray-100
        ">

            <div class="
                flex flex-col lg:flex-row
                lg:items-center
                justify-between
                gap-4
            ">

                <!-- SEARCH -->
                <form method="GET"
                      class="
                        flex flex-col sm:flex-row
                        gap-3
                        w-full lg:w-auto
                      ">

                    <div class="relative w-full sm:w-96">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari kode, kota, provinsi..."
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
                            px-5 py-3
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

            @forelse($cabangs as $cabang)

            <div class="
                p-5
                border-b border-gray-100
                space-y-4
            ">

                <!-- HEADER -->
                <div class="
                    flex items-start justify-between
                    gap-4
                ">

                    <div>

                        <h3 class="
                            text-lg
                            font-semibold
                            text-gray-800
                        ">
                            {{ $cabang->kota }}
                        </h3>

                        <p class="
                            text-sm
                            text-gray-400
                            mt-1
                        ">
                            {{ $cabang->kode_cabang }}
                        </p>

                    </div>


                    <!-- STATUS -->
                    <span class="
                        px-3 py-1.5
                        rounded-full
                        text-xs font-semibold
                        {{
                            strtolower($cabang->status) == 'aktif'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-600'
                        }}
                    ">

                        {{ $cabang->status }}

                    </span>

                </div>


                <!-- INFO -->
                <div class="
                    grid grid-cols-1
                    gap-3
                    text-sm
                ">

                    <div>

                        <p class="text-gray-400">
                            Provinsi
                        </p>

                        <p class="
                            text-gray-700
                            font-medium
                        ">
                            {{ $cabang->provinsi }}
                        </p>

                    </div>


                    <div>

                        <p class="text-gray-400">
                            Email
                        </p>

                        <p class="
                            text-gray-700
                            break-all
                        ">
                            {{ $cabang->email }}
                        </p>

                    </div>


                    <div>

                        <p class="text-gray-400">
                            Tanggal Peresmian
                        </p>

                        <p class="
                            text-gray-700
                        ">
                            {{ $cabang->tanggal_peresmian }}
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
                    <a href="{{ route('superadmin.cabang.show', $cabang->id) }}"
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


                    <!-- DELETE -->
                    <form action="{{ route('superadmin.cabang.delete', $cabang->id) }}"
                          method="POST"
                          class="flex-1">

                        @csrf
                        @method('DELETE')

                        <button class="
                            w-full
                            bg-red-50
                            hover:bg-red-100
                            text-red-600
                            py-3
                            rounded-2xl
                            text-sm font-medium
                            transition
                        ">

                            Hapus

                        </button>

                    </form>

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
                    Data cabang tidak ditemukan
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
                            ID Cabang
                        </th>

                        <th class="px-6 py-4 text-left">
                            Kota
                        </th>

                        <th class="px-6 py-4 text-left">
                            Provinsi
                        </th>

                        <th class="px-6 py-4 text-left">
                            Peresmian
                        </th>

                        <th class="px-6 py-4 text-left">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left">
                            Email
                        </th>

                        <th class="px-6 py-4 text-right">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <!-- BODY -->
                <tbody class="divide-y divide-gray-100">

                    @forelse($cabangs as $cabang)

                    <tr class="
                        hover:bg-gray-50
                        transition
                    ">

                        <!-- KODE -->
                        <td class="
                            px-6 py-5
                            font-medium
                            text-gray-700
                        ">

                            {{ $cabang->kode_cabang }}

                        </td>


                        <!-- KOTA -->
                        <td class="
                            px-6 py-5
                            text-gray-700
                        ">

                            {{ $cabang->kota }}

                        </td>


                        <!-- PROVINSI -->
                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            {{ $cabang->provinsi }}

                        </td>


                        <!-- TANGGAL -->
                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            {{ $cabang->tanggal_peresmian }}

                        </td>


                        <!-- STATUS -->
                        <td class="px-6 py-5">

                            <span class="
                                px-3 py-1.5
                                rounded-full
                                text-xs font-semibold
                                {{
                                    strtolower($cabang->status) == 'aktif'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-600'
                                }}
                            ">

                                {{ $cabang->status }}

                            </span>

                        </td>


                        <!-- EMAIL -->
                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            {{ $cabang->email }}

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
                                <a href="{{ route('superadmin.cabang.show', $cabang->id) }}"
                                   class="
                                        px-4 py-2
                                        rounded-xl
                                        bg-blue-50
                                        hover:bg-blue-100
                                        text-blue-600
                                        text-sm
                                        transition
                                   ">

                                    Detail

                                </a>


                                <!-- DELETE -->
                                <form action="{{ route('superadmin.cabang.delete', $cabang->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="
                                        px-4 py-2
                                        rounded-xl
                                        bg-red-50
                                        hover:bg-red-100
                                        text-red-600
                                        text-sm
                                        transition
                                    ">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7"
                            class="
                                text-center
                                py-12
                                text-gray-400
                            ">

                            Data cabang tidak ditemukan

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- ================= FOOTER ================= -->
        <div class="
            px-5 md:px-6
            py-5
            border-t border-gray-100
            flex flex-col md:flex-row
            items-center justify-between
            gap-4
        ">

            <p class="
                text-sm
                text-gray-400
            ">

                Halaman
                {{ $cabangs->currentPage() }}
                dari
                {{ $cabangs->lastPage() }}

            </p>


            <div>

                {{ $cabangs->links() }}

            </div>

        </div>

    </div>

</div>

@endsection