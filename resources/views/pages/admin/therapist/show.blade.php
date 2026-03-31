@extends('layouts.admin')

@section('title', 'Detail Terapis')

@section('content')

<div class="p-6 space-y-6">

    <!-- ================= HEADER ================= -->
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-semibold text-gray-800">
            Detail Verifikasi Terapis
        </h1>

        <a href="{{ route('admin.therapist.index') }}"
           class="text-sm text-gray-500 hover:underline">
            ← Kembali
        </a>
    </div>


    <!-- ================= CARD: DATA TERAPIS ================= -->
    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-sm font-semibold text-gray-500 mb-4">
            Informasi Terapis
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

            <div>
                <label class="text-gray-400">Nama</label>
                <p class="font-medium text-gray-800">{{ $therapist->name }}</p>
            </div>

            <div>
                <label class="text-gray-400">Email</label>
                <p class="text-gray-700">{{ $therapist->email }}</p>
            </div>

            <div>
                <label class="text-gray-400">No HP</label>
                <p class="text-gray-700">{{ $therapist->phone }}</p>
            </div>

            <div>
                <label class="text-gray-400">Gender</label>
                <p class="text-gray-700">{{ $therapist->gender ?? '-' }}</p>
            </div>

            <div>
                <label class="text-gray-400">Alamat</label>
                <p class="text-gray-700">{{ $therapist->address ?? '-' }}</p>
            </div>

            <div>
                <label class="text-gray-400">Pengalaman</label>
                <p class="text-gray-700">
                    {{ $therapist->experience ?? '-' }} tahun
                </p>
            </div>

        </div>
    </div>


    <!-- ================= CARD: STATUS ================= -->
    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-sm font-semibold text-gray-500 mb-4">
            Status Verifikasi
        </h2>

        <div class="flex items-center gap-3">

            @if($therapist->verification_status == 'approved')
                <span class="px-3 py-1 text-sm rounded bg-green-100 text-green-600">
                    Approved
                </span>
            @elseif($therapist->verification_status == 'rejected')
                <span class="px-3 py-1 text-sm rounded bg-red-100 text-red-600">
                    Rejected
                </span>
            @else
                <span class="px-3 py-1 text-sm rounded bg-yellow-100 text-yellow-600">
                    Pending
                </span>
            @endif

        </div>

        @if($therapist->reject_reason)
            <div class="mt-4 text-sm">
                <label class="text-gray-400">Alasan Penolakan</label>
                <p class="text-red-600">{{ $therapist->reject_reason }}</p>
            </div>
        @endif

    </div>


    <!-- ================= CARD: PROFILE / ASSESSMENT ================= -->
    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-sm font-semibold text-gray-500 mb-4">
            Profil Terapis (Assessment)
        </h2>

        @if($therapist->therapistProfile)

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">

                <!-- ================= KEMAMPUAN ================= -->
                <div class="space-y-3">

                    <h3 class="text-xs font-semibold text-gray-400 uppercase">
                        Kemampuan
                    </h3>

                    <div>
                        <label class="text-gray-400">Pengalaman</label>
                        <p class="font-medium text-gray-800">
                            {{ $therapist->therapistProfile->experience_years ?? 0 }} tahun
                        </p>
                    </div>

                    <div>
                        <label class="text-gray-400">Skill</label>
                        <p class="text-gray-700">
                            {{ $therapist->therapistProfile->skills ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="text-gray-400">Sertifikasi</label>
                        <p class="text-gray-700">
                            {{ $therapist->therapistProfile->certifications ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="text-gray-400">Handle Kondisi Khusus</label>
                        <p>
                            @if($therapist->therapistProfile->handle_special_condition)
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-600">
                                    Ya
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-600">
                                    Tidak
                                </span>
                            @endif
                        </p>
                    </div>

                </div>


                <!-- ================= KETERSEDIAAN ================= -->
                <div class="space-y-3">

                    <h3 class="text-xs font-semibold text-gray-400 uppercase">
                        Ketersediaan
                    </h3>

                    <div>
                        <label class="text-gray-400">Hari Kerja</label>
                        <p class="text-gray-700">
                            {{ $therapist->therapistProfile->work_days ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="text-gray-400">Jam Kerja</label>
                        <p class="text-gray-700">
                            {{ $therapist->therapistProfile->work_hours ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="text-gray-400">Mobile Service</label>
                        <p>
                            @if($therapist->therapistProfile->is_mobile)
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-600">
                                    Ya
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-600">
                                    Tidak
                                </span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <label class="text-gray-400">Area Layanan</label>
                        <p class="text-gray-700">
                            {{ $therapist->therapistProfile->coverage_area ?? '-' }}
                        </p>
                    </div>

                </div>

            </div>

        @else

            <div class="text-center py-6 text-gray-400 text-sm">
                Profil terapis belum diisi
            </div>

        @endif

    </div>


    <!-- ================= ACTION ================= -->
    @if($therapist->verification_status == 'pending')

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-sm font-semibold text-gray-500 mb-4">
            Aksi Verifikasi
        </h2>

        <div class="flex flex-col md:flex-row gap-4">

            <!-- APPROVE -->
            <form action="{{ route('admin.therapist.verify', $therapist->id) }}" method="POST">
                @csrf
                <button class="px-5 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600">
                    Approve Terapis
                </button>
            </form>


            <!-- REJECT -->
            <form action="{{ route('admin.therapist.reject', $therapist->id) }}" method="POST" class="flex flex-col gap-2">
                @csrf

                <input type="text"
                       name="reject_reason"
                       required
                       placeholder="Masukkan alasan penolakan..."
                       class="border px-3 py-2 rounded-lg text-sm w-full md:w-80">

                <button class="px-5 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600">
                    Reject Terapis
                </button>

            </form>

        </div>

    </div>

    @endif

</div>

@endsection