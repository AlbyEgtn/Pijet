@extends('layouts.superadmin')

@section('title','Detail Akun')
@section('header','Detail Akun Ditangguhkan')

@section('content')

<div class="space-y-6">

    <!-- BREADCRUMB -->
    <div class="text-sm text-gray-400">
        Pengguna > Ditangguhkan > 
        <span class="text-green-600">Detail Akun</span>
    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-2 gap-6">

        <!-- LEFT -->
        <div class="space-y-4">

            <!-- PROFILE -->
            <div class="bg-white rounded-2xl shadow-sm p-6 text-center">

                <img src="{{ asset('storage/'.$report->reportedUser->foto) }}" 
                     class="w-32 h-32 mx-auto rounded-full object-cover mb-4">

                <h2 class="font-semibold text-lg">
                    {{ $report->reportedUser->name }}
                </h2>

                <p class="text-sm text-gray-400 capitalize">
                    {{ $report->reportedUser->role }}
                </p>

            </div>

            <!-- INFORMASI AKUN -->
            <div class="bg-white rounded-2xl shadow-sm p-6">

                <h3 class="font-semibold mb-4">Informasi Akun</h3>

                <div class="text-sm space-y-3">

                    <div class="flex justify-between">
                        <span class="text-gray-400">Nomor ID</span>
                        <span>TRS00{{ $report->reportedUser->id }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Status Akun</span>
                        <span class="text-orange-500 font-medium">
                            Penangguhan Sementara
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Alamat Email</span>
                        <span>{{ $report->reportedUser->email }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Ponsel</span>
                        <span>{{ $report->reportedUser->phone }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Area Kerja</span>
                        <span>{{ $report->reportedUser->work_area }}</span>
                    </div>

                </div>

                <!-- ACTION -->
                <div class="flex gap-2 mt-4">

                    <a href="#" class="bg-blue-500 text-white px-3 py-2 rounded-lg text-xs">
                        Lihat Aduan
                    </a>

                    <form action="{{ route('superadmin.pengguna.suspend', $report->reportedUser->id) }}" method="POST">
                        @csrf
                        <button class="bg-green-500 text-white px-3 py-2 rounded-lg text-xs">
                            Pulihkan Akun
                        </button>
                    </form>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="space-y-4">

            <!-- IDENTITAS DIRI -->
            <div class="bg-white rounded-2xl shadow-sm p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold">Identitas Diri</h3>

                    <div class="flex gap-2">
                        <a href="{{ asset('storage/'.$report->reportedUser->ktp) }}" 
                           target="_blank"
                           class="border px-3 py-1 rounded text-xs">
                            Lihat Foto KTP
                        </a>

                        <a href="{{ asset('storage/'.$report->reportedUser->skck) }}" 
                           target="_blank"
                           class="border px-3 py-1 rounded text-xs">
                            Lihat SKCK
                        </a>
                    </div>
                </div>

                <div class="text-sm space-y-3">

                    <div class="flex justify-between">
                        <span class="text-gray-400">NIK</span>
                        <span>{{ $report->reportedUser->nik }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Nama Lengkap</span>
                        <span>{{ $report->reportedUser->name }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Tanggal Lahir</span>
                        <span>{{ $report->reportedUser->birth_date }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Jenis Kelamin</span>
                        <span>
                            {{ $report->reportedUser->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </span>
                    </div>

                    <div>
                        <span class="text-gray-400 text-xs">Alamat</span>
                        <p class="text-sm text-gray-600">
                            {{ $report->reportedUser->address }}
                        </p>
                    </div>

                </div>

            </div>

            <!-- INFORMASI PENANGGUHAN -->
            <div class="bg-white rounded-2xl shadow-sm p-6">

                <h3 class="font-semibold mb-4">Informasi Penangguhan</h3>

                <div class="text-sm space-y-3">

                    <div class="flex justify-between">
                        <span class="text-gray-400">Tipe Pengguna</span>
                        <span class="capitalize">{{ $report->reportedUser->role }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Tanggal Ditangguhkan</span>
                        <span>{{ $report->created_at->format('d F Y') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Durasi Penangguhan</span>
                        <span>14 Hari</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Sisa Durasi</span>
                        <span class="text-orange-500">8 Hari</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection