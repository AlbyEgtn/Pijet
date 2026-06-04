@extends('layouts.superadmin')

@section('title','Detail Cabang')
@section('header','Detail Cabang')

@section('content')

<div class="space-y-6">

    <!-- ================= HEADER ================= -->
    <div class="
        flex flex-col md:flex-row
        md:items-center
        md:justify-between
        gap-4
    ">

        <!-- LEFT -->
        <div class="
            flex items-center
            gap-4
        ">

            <!-- BACK -->
            <a href="{{ route('superadmin.cabang.index') }}"
               class="
                    w-11 h-11
                    rounded-2xl
                    bg-white
                    border border-gray-100
                    shadow-sm
                    flex items-center justify-center
                    text-gray-600
                    hover:bg-gray-50
                    transition
               ">

                ←

            </a>


            <!-- TITLE -->
            <div>

                <p class="
                    text-sm
                    text-gray-400
                    mb-1
                ">
                    Detail Cabang
                </p>

                <h1 class="
                    text-2xl md:text-3xl
                    font-bold
                    text-gray-800
                ">

                    {{ $cabang->kota }}

                </h1>

            </div>

        </div>


        <!-- BUTTON -->
        <a href="{{ route('superadmin.cabang.edit', $cabang->id) }}"
           class="
                inline-flex items-center justify-center
                bg-blue-600
                hover:bg-blue-700
                text-white
                px-5 py-3
                rounded-2xl
                text-sm font-semibold
                transition
                shadow-sm
           ">

            Edit Cabang

        </a>

    </div>


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


        <div class="relative z-10">

            <div class="
                flex flex-col md:flex-row
                md:items-center
                md:justify-between
                gap-5
            ">

                <!-- INFO -->
                <div>

                    <p class="
                        text-sm
                        text-teal-100
                        mb-2
                    ">
                        Informasi Cabang
                    </p>

                    <h2 class="
                        text-2xl md:text-4xl
                        font-bold
                    ">

                        {{ $cabang->kota }}

                    </h2>

                    <p class="
                        text-sm md:text-base
                        text-teal-100
                        mt-3
                        max-w-2xl
                    ">

                        Cabang aktif yang terdaftar di sistem PijatJogja.com.

                    </p>

                </div>


                <!-- STATUS -->
                <div>

                    <span class="
                        inline-flex items-center
                        gap-2
                        px-4 py-2
                        rounded-2xl
                        bg-white/15
                        backdrop-blur
                        text-sm font-semibold
                    ">

                        <span class="
                            w-2.5 h-2.5
                            rounded-full
                            {{
                                strtolower($cabang->status) == 'aktif'
                                ? 'bg-green-400'
                                : 'bg-red-400'
                            }}
                        "></span>

                        {{ $cabang->status }}

                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= INFO GRID ================= -->
    <div class="
        grid grid-cols-1
        xl:grid-cols-2
        gap-6
    ">

        <!-- ================= CABANG INFO ================= -->
        <div class="
            bg-white
            rounded-3xl
            border border-gray-100
            shadow-sm
            p-6
        ">

            <!-- HEADER -->
            <div class="
                flex items-center justify-between
                mb-6
            ">

                <div>

                    <h3 class="
                        text-lg
                        font-semibold
                        text-gray-800
                    ">
                        Informasi Cabang
                    </h3>

                    <p class="
                        text-sm
                        text-gray-400
                        mt-1
                    ">
                        Detail informasi utama cabang
                    </p>

                </div>

            </div>


            <!-- CONTENT -->
            <div class="
                grid grid-cols-1
                sm:grid-cols-2
                gap-5
                text-sm
            ">

                <!-- ID -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-gray-400
                        mb-1
                    ">
                        ID Cabang
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">
                        {{ $cabang->kode_cabang }}
                    </p>

                </div>


                <!-- STATUS -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-gray-400
                        mb-1
                    ">
                        Status Cabang
                    </p>

                    <p class="
                        font-semibold
                        text-green-600
                    ">
                        {{ $cabang->status }}
                    </p>

                </div>


                <!-- KOTA -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-gray-400
                        mb-1
                    ">
                        Kota
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">
                        {{ $cabang->kota }}
                    </p>

                </div>


                <!-- PROVINSI -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-gray-400
                        mb-1
                    ">
                        Provinsi
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">
                        {{ $cabang->provinsi }}
                    </p>

                </div>


                <!-- EMAIL -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                    sm:col-span-2
                ">

                    <p class="
                        text-gray-400
                        mb-1
                    ">
                        Email Cabang
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                        break-all
                    ">
                        {{ $cabang->email }}
                    </p>

                </div>


                <!-- LOKASI -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                    sm:col-span-2
                ">

                    <p class="
                        text-gray-400
                        mb-1
                    ">
                        Lokasi Cabang
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">

                        Karangjambe, Gg. Arjuna No.59, Bantul

                    </p>

                </div>

            </div>

        </div>


        <!-- ================= STATISTIC ================= -->
        <div class="
            grid grid-cols-1
            gap-6
        ">

            <!-- USER -->
            <div class="
                bg-white
                rounded-3xl
                border border-gray-100
                shadow-sm
                p-6
            ">

                <div class="
                    flex items-center justify-between
                    mb-5
                ">

                    <div>

                        <h3 class="
                            text-lg
                            font-semibold
                            text-gray-800
                        ">
                            Pengguna
                        </h3>

                        <p class="
                            text-sm
                            text-gray-400
                            mt-1
                        ">
                            Statistik pengguna cabang
                        </p>

                    </div>

                </div>


                <!-- GRID -->
                <div class="
                    grid grid-cols-1
                    sm:grid-cols-2
                    gap-4
                ">

                    <!-- TOTAL -->
                    <div class="
                        bg-teal-50
                        rounded-2xl
                        p-5
                    ">

                        <p class="
                            text-sm
                            text-teal-600
                        ">
                            Total Pengguna
                        </p>

                        <h2 class="
                            text-2xl
                            font-bold
                            text-teal-700
                            mt-2
                        ">
                            100
                        </h2>

                    </div>


                    <!-- TERAPIS -->
                    <div class="
                        bg-blue-50
                        rounded-2xl
                        p-5
                    ">

                        <p class="
                            text-sm
                            text-blue-600
                        ">
                            Terapis
                        </p>

                        <h2 class="
                            text-2xl
                            font-bold
                            text-blue-700
                            mt-2
                        ">
                            45
                        </h2>

                    </div>


                    <!-- CUSTOMER -->
                    <div class="
                        bg-green-50
                        rounded-2xl
                        p-5
                    ">

                        <p class="
                            text-sm
                            text-green-600
                        ">
                            Customer
                        </p>

                        <h2 class="
                            text-2xl
                            font-bold
                            text-green-700
                            mt-2
                        ">
                            55
                        </h2>

                    </div>


                    <!-- PEGAWAI -->
                    <div class="
                        bg-orange-50
                        rounded-2xl
                        p-5
                    ">

                        <p class="
                            text-sm
                            text-orange-600
                        ">
                            Total Pegawai
                        </p>

                        <h2 class="
                            text-2xl
                            font-bold
                            text-orange-700
                            mt-2
                        ">
                            3
                        </h2>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= SERVICE & TRANSACTION ================= -->
    <div class="
        grid grid-cols-1
        xl:grid-cols-2
        gap-6
    ">

        <!-- ================= LAYANAN ================= -->
        <div class="
            bg-white
            rounded-3xl
            border border-gray-100
            shadow-sm
            p-6
        ">

            <div class="
                flex items-center justify-between
                mb-6
            ">

                <div>

                    <h3 class="
                        text-lg
                        font-semibold
                        text-gray-800
                    ">
                        Statistik Layanan
                    </h3>

                    <p class="
                        text-sm
                        text-gray-400
                        mt-1
                    ">
                        Ringkasan aktivitas layanan
                    </p>

                </div>

            </div>


            <!-- GRID -->
            <div class="
                grid grid-cols-1
                sm:grid-cols-2
                gap-4
            ">

                <!-- SELESAI -->
                <div class="
                    bg-green-50
                    rounded-2xl
                    p-5
                ">

                    <p class="
                        text-sm
                        text-green-600
                    ">
                        Layanan Selesai
                    </p>

                    <h2 class="
                        text-3xl
                        font-bold
                        text-green-700
                        mt-2
                    ">
                        70
                    </h2>

                </div>


                <!-- CANCEL -->
                <div class="
                    bg-red-50
                    rounded-2xl
                    p-5
                ">

                    <p class="
                        text-sm
                        text-red-600
                    ">
                        Layanan Dibatalkan
                    </p>

                    <h2 class="
                        text-3xl
                        font-bold
                        text-red-700
                        mt-2
                    ">
                        15
                    </h2>

                </div>

            </div>

        </div>


        <!-- ================= TRANSACTION ================= -->
        <div class="
            bg-white
            rounded-3xl
            border border-gray-100
            shadow-sm
            p-6
        ">

            <div class="
                flex items-center justify-between
                mb-6
            ">

                <div>

                    <h3 class="
                        text-lg
                        font-semibold
                        text-gray-800
                    ">
                        Statistik Transaksi
                    </h3>

                    <p class="
                        text-sm
                        text-gray-400
                        mt-1
                    ">
                        Ringkasan transaksi cabang
                    </p>

                </div>

            </div>


            <!-- LIST -->
            <div class="
                space-y-4
            ">

                <!-- MASUK -->
                <div class="
                    bg-teal-50
                    rounded-2xl
                    p-5
                    flex items-center justify-between
                    gap-4
                ">

                    <div>

                        <p class="
                            text-sm
                            text-teal-600
                        ">
                            Transaksi Masuk
                        </p>

                        <h2 class="
                            text-2xl
                            font-bold
                            text-teal-700
                            mt-2
                        ">
                            Rp 200.000.000
                        </h2>

                    </div>

                </div>


                <!-- KELUAR -->
                <div class="
                    bg-red-50
                    rounded-2xl
                    p-5
                    flex items-center justify-between
                    gap-4
                ">

                    <div>

                        <p class="
                            text-sm
                            text-red-600
                        ">
                            Transaksi Keluar
                        </p>

                        <h2 class="
                            text-2xl
                            font-bold
                            text-red-700
                            mt-2
                        ">
                            Rp 30.000.000
                        </h2>

                    </div>

                </div>


                <!-- BULANAN -->
                <div class="
                    bg-blue-50
                    rounded-2xl
                    p-5
                    flex items-center justify-between
                    gap-4
                ">

                    <div>

                        <p class="
                            text-sm
                            text-blue-600
                        ">
                            Pemasukan Bulanan
                        </p>

                        <h2 class="
                            text-2xl
                            font-bold
                            text-blue-700
                            mt-2
                        ">
                            Rp 25.000.000
                        </h2>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection