@extends('layouts.superadmin')

@section('title','Detail Karyawan')
@section('header','Detail Akun Administrasi')

@section('content')

<div class="space-y-6">

    <!-- BACK -->
    <a href="{{ route('superadmin.karyawan.index') }}"
       class="text-sm text-gray-500 hover:text-green-600 flex items-center gap-2">
        ← Kembali ke Karyawan
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- LEFT -->
        <div class="bg-white rounded-2xl shadow-sm p-6 text-center">

            <!-- FOTO / AVATAR -->
            <div class="w-32 h-32 mx-auto rounded-full overflow-hidden bg-green-100 flex items-center justify-center text-4xl font-bold text-green-600">

                @if($karyawan->foto)
                    <img src="{{ asset('storage/'.$karyawan->foto) }}" class="w-full h-full object-cover">
                @else
                    {{ strtoupper(substr($karyawan->name,0,1)) }}
                @endif

            </div>

            <!-- NAMA -->
            <h2 class="mt-4 text-lg font-semibold">
                {{ $karyawan->name }}
            </h2>

            <p class="text-sm text-gray-400 capitalize">
                {{ $karyawan->role }}
            </p>

            <!-- INFO AKUN -->
            <div class="mt-6 text-left space-y-3">

                <h3 class="font-semibold text-gray-700">
                    Informasi Akun
                </h3>

                <div class="flex justify-between text-sm border-b pb-2">
                    <span class="text-gray-400">Nomor ID</span>
                    <span class="font-medium">{{ $karyawan->kode }}</span>
                </div>

                <div class="flex justify-between text-sm border-b pb-2">
                    <span class="text-gray-400">Email</span>
                    <span class="font-medium">{{ $karyawan->email }}</span>
                </div>

                <div class="flex justify-between text-sm border-b pb-2">
                    <span class="text-gray-400">Ponsel</span>
                    <span class="font-medium">{{ $karyawan->phone }}</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Cabang</span>
                    <span class="font-medium">
                        {{ $karyawan->cabang->kota ?? '-' }}
                    </span>
                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h3 class="font-semibold text-gray-700 mb-4">
                Identitas Diri
            </h3>

            <div class="space-y-4 text-sm">

                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-400">Nama Lengkap</span>
                    <span class="font-medium">{{ $karyawan->name }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-400">Tempat Lahir</span>
                    <span class="font-medium">{{ $karyawan->city }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-400">Tanggal Lahir</span>
                    <span class="font-medium">
                        {{ \Carbon\Carbon::parse($karyawan->birth_date)->format('d F Y') }}
                    </span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-400">Jenis Kelamin</span>
                    <span class="font-medium">
                        {{ $karyawan->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-400">Alamat</span>
                    <span class="font-medium text-right max-w-xs">
                        {{ $karyawan->address }}
                    </span>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection