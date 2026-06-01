@extends('layouts.superadmin')

@section('title','Detail Karyawan')
@section('header','Detail Akun Administrasi')

@section('content')

<div class="space-y-6">

    <!-- ================= BACK ================= -->
    <div class="
        flex items-center justify-between
        gap-4
        flex-wrap
    ">

        <a href="{{ route('superadmin.karyawan.index') }}"
           class="
                inline-flex items-center
                gap-2
                text-sm
                text-gray-500
                hover:text-teal-600
                transition
           ">

            ← Kembali ke Karyawan

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


        <div class="
            relative z-10
            flex flex-col md:flex-row
            md:items-center
            gap-6
        ">

            <!-- AVATAR -->
            <div class="
                w-28 h-28 md:w-32 md:h-32
                rounded-3xl
                overflow-hidden
                bg-white/10
                backdrop-blur
                border border-white/20
                flex items-center justify-center
                text-4xl font-bold
            ">

                @if($karyawan->foto)

                    <img src="{{ asset('storage/'.$karyawan->foto) }}"
                         class="w-full h-full object-cover">

                @else

                    {{ strtoupper(substr($karyawan->name,0,1)) }}

                @endif

            </div>


            <!-- INFO -->
            <div class="flex-1">

                <p class="
                    text-sm
                    text-teal-100
                    mb-2
                ">
                    Detail Akun Karyawan
                </p>

                <h1 class="
                    text-2xl md:text-4xl
                    font-bold
                ">

                    {{ $karyawan->name }}

                </h1>

                <div class="
                    flex flex-wrap items-center
                    gap-3
                    mt-4
                ">

                    <!-- ROLE -->
                    <span class="
                        px-4 py-2
                        rounded-2xl
                        text-sm font-semibold
                        {{
                            $karyawan->role == 'admin'
                            ? 'bg-blue-100 text-blue-700'
                            : 'bg-purple-100 text-purple-700'
                        }}
                    ">

                        {{ ucfirst($karyawan->role) }}

                    </span>


                    <!-- KODE -->
                    <span class="
                        px-4 py-2
                        rounded-2xl
                        bg-white/10
                        backdrop-blur
                        text-sm
                    ">

                        ID:
                        {{ $karyawan->kode }}

                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= CONTENT ================= -->
    <div class="
        grid grid-cols-1
        xl:grid-cols-2
        gap-6
    ">

        <!-- ================= LEFT ================= -->
        <div class="
            bg-white
            rounded-3xl
            border border-gray-100
            shadow-sm
            p-6
        ">

            <!-- HEADER -->
            <div class="mb-6">

                <h2 class="
                    text-lg
                    font-semibold
                    text-gray-800
                ">
                    Informasi Akun
                </h2>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Informasi login dan akun administrasi
                </p>

            </div>


            <!-- LIST -->
            <div class="space-y-4">

                <!-- EMAIL -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Email
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                        break-all
                    ">
                        {{ $karyawan->email }}
                    </p>

                </div>


                <!-- PHONE -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Nomor Ponsel
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">
                        {{ $karyawan->phone ?? '-' }}
                    </p>

                </div>


                <!-- CABANG -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Cabang
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">
                        {{ $karyawan->cabang->kota ?? '-' }}
                    </p>

                </div>


                <!-- CREATED -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Tanggal Dibuat
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">
                        {{ $karyawan->created_at->format('d F Y') }}
                    </p>

                </div>

            </div>

        </div>


        <!-- ================= RIGHT ================= -->
        <div class="
            bg-white
            rounded-3xl
            border border-gray-100
            shadow-sm
            p-6
        ">

            <!-- HEADER -->
            <div class="mb-6">

                <h2 class="
                    text-lg
                    font-semibold
                    text-gray-800
                ">
                    Identitas Diri
                </h2>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Informasi pribadi karyawan
                </p>

            </div>


            <!-- LIST -->
            <div class="space-y-4">

                <!-- NAMA -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Nama Lengkap
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">
                        {{ $karyawan->name }}
                    </p>

                </div>


                <!-- TEMPAT LAHIR -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Tempat Lahir
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">
                        {{ $karyawan->city ?? '-' }}
                    </p>

                </div>


                <!-- TANGGAL -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Tanggal Lahir
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">

                        {{ $karyawan->birth_date
                            ? \Carbon\Carbon::parse($karyawan->birth_date)->format('d F Y')
                            : '-'
                        }}

                    </p>

                </div>


                <!-- GENDER -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Jenis Kelamin
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                    ">

                        {{
                            $karyawan->gender == 'L'
                            ? 'Laki-laki'
                            : 'Perempuan'
                        }}

                    </p>

                </div>


                <!-- ADDRESS -->
                <div class="
                    bg-gray-50
                    rounded-2xl
                    p-4
                ">

                    <p class="
                        text-sm
                        text-gray-400
                        mb-1
                    ">
                        Alamat
                    </p>

                    <p class="
                        font-semibold
                        text-gray-800
                        leading-relaxed
                    ">
                        {{ $karyawan->address ?? '-' }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection