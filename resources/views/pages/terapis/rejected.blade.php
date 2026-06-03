@extends('layouts.terapis')

@section('title','Verifikasi Ditolak')
@section('header','Verifikasi Ditolak')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="
        relative overflow-hidden
        bg-gradient-to-r from-red-500 via-red-600 to-red-700
        text-white
        rounded-3xl
        p-8
        shadow-lg
        mb-6
    ">

        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative z-10">

            <div class="flex items-center gap-4">

                <div class="
                    w-16 h-16
                    rounded-2xl
                    bg-white/20
                    flex items-center justify-center
                    text-3xl
                ">
                    ❌
                </div>

                <div>

                    <h1 class="text-2xl font-bold">
                        Verifikasi Ditolak
                    </h1>

                    <p class="text-red-100 mt-1">
                        Mohon periksa alasan penolakan dan lakukan perbaikan data.
                    </p>

                </div>

            </div>

        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KIRI --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- STATUS --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

                <h2 class="font-semibold text-lg text-gray-800 mb-5">
                    Status Verifikasi
                </h2>

                <div class="space-y-6">

                    <div class="flex items-center gap-4">

                        <div class="
                            w-12 h-12
                            rounded-full
                            bg-green-100
                            text-green-600
                            flex items-center justify-center
                            font-bold
                        ">
                            ✓
                        </div>

                        <div>
                            <p class="font-medium">
                                Registrasi Berhasil
                            </p>

                            <p class="text-sm text-gray-500">
                                Akun berhasil dibuat.
                            </p>
                        </div>

                    </div>

                    <div class="flex items-center gap-4">

                        <div class="
                            w-12 h-12
                            rounded-full
                            bg-green-100
                            text-green-600
                            flex items-center justify-center
                            font-bold
                        ">
                            ✓
                        </div>

                        <div>
                            <p class="font-medium">
                                Dokumen Berhasil Dikirim
                            </p>

                            <p class="text-sm text-gray-500">
                                Dokumen telah diterima sistem.
                            </p>
                        </div>

                    </div>

                    <div class="flex items-center gap-4">

                        <div class="
                            w-12 h-12
                            rounded-full
                            bg-red-100
                            text-red-600
                            flex items-center justify-center
                            font-bold
                        ">
                            ✕
                        </div>

                        <div>
                            <p class="font-medium text-red-600">
                                Verifikasi Ditolak
                            </p>

                            <p class="text-sm text-gray-500">
                                Admin menemukan masalah pada data atau dokumen.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

            {{-- ALASAN PENOLAKAN --}}
            <div class="
                bg-red-50
                border border-red-200
                rounded-3xl
                p-6
            ">

                <div class="flex items-start gap-4">

                    <div class="text-3xl">
                        ⚠️
                    </div>

                    <div>

                        <h3 class="font-semibold text-red-700 mb-3">
                            Alasan Penolakan
                        </h3>

                        <div class="
                            bg-white
                            border border-red-100
                            rounded-2xl
                            p-4
                            text-gray-700
                        ">

                            {{ auth()->user()->reject_reason ?? 'Tidak ada alasan yang diberikan admin.' }}

                        </div>

                    </div>

                </div>

            </div>

            

            {{-- SARAN --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

                <h3 class="font-semibold text-gray-800 mb-4">
                    Yang Perlu Anda Lakukan
                </h3>

                <ul class="space-y-3 text-sm text-gray-600">

                    <li>
                        ✓ Periksa kembali dokumen KTP yang diunggah
                    </li>

                    <li>
                        ✓ Pastikan data identitas sesuai dokumen resmi
                    </li>

                    <li>
                        ✓ Upload ulang dokumen yang kurang jelas
                    </li>

                    <li>
                        ✓ Ajukan verifikasi ulang setelah perbaikan selesai
                    </li>

                </ul>

            </div>

        </div>

        {{-- KANAN --}}
        <div class="space-y-6">

            {{-- STATUS --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

                <div class="text-center">

                    <div class="text-6xl mb-4">
                        ❌
                    </div>

                    <h3 class="font-semibold text-red-600">
                        Ditolak
                    </h3>

                    <p class="text-sm text-gray-500 mt-2">
                        Silakan lakukan perbaikan dan ajukan ulang.
                    </p>

                </div>

            </div>

            {{-- INFO AKUN --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

                <h3 class="font-semibold text-gray-800 mb-4">
                    Informasi Akun
                </h3>

                <div class="space-y-3 text-sm">

                    <div>
                        <span class="text-gray-500">Nama</span>
                        <p class="font-medium">
                            {{ auth()->user()->name }}
                        </p>
                    </div>

                    <div>
                        <span class="text-gray-500">Email</span>
                        <p class="font-medium">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <div>
                        <span class="text-gray-500">Status</span>
                        <p class="font-medium text-red-600">
                            Ditolak
                        </p>
                    </div>

                </div>

            </div>

            {{-- PERBAIKI DATA --}}
            <a href="{{ route('terapis.informasi') }}"
            class="
                    block
                    w-full
                    text-center
                    bg-teal-600
                    hover:bg-teal-700
                    text-white
                    py-3
                    rounded-2xl
                    font-medium
                    shadow
                    transition
            ">
                Perbaiki Data
            </a>

            {{-- LOGOUT --}}
            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button
                    class="
                        w-full
                        bg-red-500
                        hover:bg-red-600
                        text-white
                        py-3
                        rounded-2xl
                        font-medium
                        transition
                    "
                >
                    Logout
                </button>

            </form>

        </div>

    </div>

</div>

@endsection