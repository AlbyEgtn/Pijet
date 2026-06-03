@extends('layouts.terapis')

@section('title','Menunggu Verifikasi')
@section('header','Verifikasi Terapis')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- ALERT --}}
    <div class="
        relative overflow-hidden
        bg-gradient-to-r from-amber-500 to-orange-500
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
                    ⏳
                </div>

                <div>

                    <h1 class="text-2xl font-bold">
                        Verifikasi Sedang Diproses
                    </h1>

                    <p class="text-amber-100 mt-1">
                        Halo {{ auth()->user()->name }}, data dan dokumen Anda sedang diperiksa oleh admin.
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

                <h2 class="font-semibold text-lg text-gray-800 mb-4">
                    Status Pendaftaran
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
                                Akun Berhasil Dibuat
                            </p>

                            <p class="text-sm text-gray-500">
                                Registrasi akun telah berhasil dilakukan.
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
                                Dokumen Berhasil Diunggah
                            </p>

                            <p class="text-sm text-gray-500">
                                KTP dan SKCK telah diterima sistem.
                            </p>
                        </div>

                    </div>

                    <div class="flex items-center gap-4">

                        <div class="
                            w-12 h-12
                            rounded-full
                            bg-yellow-100
                            text-yellow-600
                            flex items-center justify-center
                            animate-pulse
                        ">
                            ⏳
                        </div>

                        <div>
                            <p class="font-medium">
                                Sedang Diverifikasi Admin
                            </p>

                            <p class="text-sm text-gray-500">
                                Mohon tunggu proses pengecekan dokumen.
                            </p>
                        </div>

                    </div>

                    <div class="flex items-center gap-4 opacity-50">

                        <div class="
                            w-12 h-12
                            rounded-full
                            bg-gray-100
                            text-gray-500
                            flex items-center justify-center
                        ">
                            4
                        </div>

                        <div>
                            <p class="font-medium">
                                Aktivasi Akun Terapis
                            </p>

                            <p class="text-sm text-gray-500">
                                Menunggu persetujuan admin.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

            {{-- INFO --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

                <h2 class="font-semibold text-lg text-gray-800 mb-4">
                    Informasi Verifikasi
                </h2>

                <div class="space-y-4 text-sm text-gray-600">

                    <div>
                        <strong>Estimasi Review:</strong>
                        1 - 3 Hari Kerja
                    </div>

                    <div>
                        <strong>Status Saat Ini:</strong>
                        <span class="text-yellow-600 font-semibold">
                            Menunggu Verifikasi
                        </span>
                    </div>

                    <div>
                        <strong>Email:</strong>
                        {{ auth()->user()->email }}
                    </div>

                    <div>
                        Setelah verifikasi selesai, Anda akan dapat:
                        <ul class="list-disc ml-6 mt-2 space-y-1">
                            <li>Menerima pesanan</li>
                            <li>Mengelola profil terapis</li>
                            <li>Mengakses dashboard penuh</li>
                            <li>Menerima pembayaran jasa</li>
                        </ul>
                    </div>

                </div>

            </div>

        </div>

        {{-- KANAN --}}
        <div class="space-y-6">

            {{-- CARD STATUS --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

                <div class="text-center">

                    <div class="text-6xl mb-4">
                        ⏳
                    </div>

                    <h3 class="font-semibold text-gray-800">
                        Pending Review
                    </h3>

                    <p class="text-sm text-gray-500 mt-2">
                        Admin sedang memeriksa data Anda.
                    </p>

                </div>

            </div>

            {{-- FAQ --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

                <h3 class="font-semibold text-gray-800 mb-4">
                    FAQ
                </h3>

                <div class="space-y-4 text-sm">

                    <div>
                        <p class="font-medium">
                            Kenapa belum disetujui?
                        </p>

                        <p class="text-gray-500">
                            Admin sedang memeriksa keaslian dokumen.
                        </p>
                    </div>

                    <div>
                        <p class="font-medium">
                            Berapa lama proses verifikasi?
                        </p>

                        <p class="text-gray-500">
                            Biasanya 1-3 hari kerja.
                        </p>
                    </div>

                    <div>
                        <p class="font-medium">
                            Apakah saya bisa menerima order?
                        </p>

                        <p class="text-gray-500">
                            Belum. Fitur akan aktif setelah akun disetujui.
                        </p>
                    </div>

                </div>

            </div>

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">

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