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

                    <!-- LIHAT ADUAN -->
                    <button
                        onclick="openReportModal()"
                        class="bg-blue-500 text-white px-3 py-2 rounded-lg text-xs">
                        Lihat Aduan
                    </button>

                    <!-- SUSPEND / PULIHKAN -->
                    <form
                        action="{{ route('superadmin.pengguna.suspend', $report->reportedUser->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin mengubah status akun ini?')">

                        @csrf

                        <button
                            class="{{ $report->reportedUser->is_suspended ? 'bg-green-500' : 'bg-red-500' }} text-white px-3 py-2 rounded-lg text-xs">

                            {{ $report->reportedUser->is_suspended ? 'Pulihkan Akun' : 'Suspend Akun' }}

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

<!-- MODAL ADUAN -->
<div
    id="reportModal"
    class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl w-full max-w-xl shadow-xl">

        <!-- HEADER -->
        <div class="flex justify-between items-center p-5 border-b">

            <h3 class="font-semibold text-lg">
                Detail Aduan
            </h3>

            <button
                onclick="closeReportModal()"
                class="text-gray-400 hover:text-gray-600 text-xl">
                &times;
            </button>

        </div>

        <!-- BODY -->
        <div class="p-5 space-y-5">

            <div>
                <label class="block text-xs text-gray-400 mb-1">
                    Pelapor
                </label>

                <div class="font-medium">
                    {{ $report->user->name }}
                </div>
            </div>

            <div>
                <label class="block text-xs text-gray-400 mb-1">
                    Alasan Aduan
                </label>

                <div class="bg-gray-50 border rounded-lg p-3">
                    {{ $report->reason }}
                </div>
            </div>

            <div>
                <label class="block text-xs text-gray-400 mb-1">
                    Deskripsi Aduan
                </label>

                <div class="bg-gray-50 border rounded-lg p-3 whitespace-pre-line">
                    {{ $report->description }}
                </div>
            </div>

            <div>
                <label class="block text-xs text-gray-400 mb-1">
                    Tanggal Aduan
                </label>

                <div>
                    {{ $report->created_at->format('d F Y H:i') }}
                </div>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="flex justify-end gap-2 p-5 border-t">

            <button
                onclick="closeReportModal()"
                class="px-4 py-2 border rounded-lg text-sm">
                Tutup
            </button>

        </div>

    </div>

</div>

<script>

function openReportModal()
{
    document
        .getElementById('reportModal')
        .classList.remove('hidden');
}

function closeReportModal()
{
    document
        .getElementById('reportModal')
        .classList.add('hidden');
}

</script>

@endsection