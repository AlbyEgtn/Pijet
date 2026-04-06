@extends('layouts.superadmin')

@section('title','Detail Aduan')
@section('header','Detail Aduan Pengguna')

@section('content')

<div class="space-y-6">

    <!-- BREADCRUMB -->
    <div class="text-sm text-gray-400">
        Penangguhan > Aduan Pengguna > 
        <span class="text-green-600">Detail Aduan Pengguna</span>
    </div>

    <!-- HEADER USER -->
    <div class="bg-white p-4 rounded-xl shadow-sm flex justify-between items-center">

        <div class="flex items-center gap-4">
            <img src="{{ asset('storage/'.$report->user->foto) }}" 
                 class="w-14 h-14 rounded-full object-cover">

            <div>
                <div class="font-semibold">{{ $report->user->name }}</div>
                <div class="text-xs text-gray-400">
                    {{ strtoupper(substr($report->user->role,0,3)) }}{{ $report->user->id }}
                </div>
                <div class="text-xs text-gray-500 capitalize">
                    {{ $report->user->role }}
                </div>
            </div>
        </div>

        <div class="text-right text-xs text-gray-400">
            {{ $report->created_at->format('H:i, d F Y') }} <br>
            {{ $report->user->city }}
        </div>

    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-2 gap-4">

        <!-- ISI ADUAN -->
        <div class="bg-white p-4 rounded-xl shadow-sm">

            <h3 class="font-semibold mb-3">Isi Aduan Pengguna</h3>

            <div class="text-sm space-y-3">

                <div class="flex justify-between">
                    <span class="text-gray-400">Pelapor</span>
                    <span>{{ $report->user->name }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-400">Alasan Aduan</span>
                    <span>{{ $report->reason }}</span>
                </div>

                <div>
                    <span class="text-gray-400 text-xs">Detail Aduan</span>
                    <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                        {{ $report->description }}
                    </p>
                </div>

            </div>

        </div>

        <!-- DATA TERLAPOR -->
        <div class="bg-white p-4 rounded-xl shadow-sm">

            <h3 class="font-semibold mb-3">Data Terlapor</h3>

            <div class="text-sm space-y-3">

                <div class="flex justify-between">
                    <span class="text-gray-400">Nomor ID</span>
                    <span>TR{{ $report->reportedUser->id }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-400">Nama Lengkap</span>
                    <span>{{ $report->reportedUser->name }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-400">Area Kerja</span>
                    <span>{{ $report->reportedUser->work_area }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-400">Jenis Kelamin</span>
                    <span>{{ $report->reportedUser->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                </div>

                <div>
                    <span class="text-gray-400 text-xs">Alamat</span>
                    <p class="text-sm text-gray-600">
                        {{ $report->reportedUser->address }}
                    </p>
                </div>

            </div>

            <!-- ACTION -->
            <div class="flex gap-2 mt-4">

                <form action="{{ route('superadmin.pengguna.suspend', $report->reportedUser->id) }}" method="POST">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-2 rounded-lg text-xs">
                        Tangguhkan Akun
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

@endsection