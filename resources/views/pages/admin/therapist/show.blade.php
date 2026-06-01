@extends('layouts.admin')

@section('title','Detail Terapis')
@section('header','Detail Terapis')

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
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <h2 class="text-sm font-semibold text-gray-500 mb-5 uppercase tracking-wide">
            Informasi Terapis
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-sm">

            <div>
                <label class="text-gray-400 text-xs uppercase">
                    Nama
                </label>

                <p class="font-semibold text-gray-800 mt-1">
                    {{ $therapist->name }}
                </p>
            </div>

            <div>
                <label class="text-gray-400 text-xs uppercase">
                    Email
                </label>

                <p class="text-gray-700 mt-1">
                    {{ $therapist->email }}
                </p>
            </div>

            <div>
                <label class="text-gray-400 text-xs uppercase">
                    No HP
                </label>

                <p class="text-gray-700 mt-1">
                    {{ $therapist->phone }}
                </p>
            </div>

            <div>
                <label class="text-gray-400 text-xs uppercase">
                    Gender
                </label>

                <p class="text-gray-700 mt-1">
                    {{ $therapist->gender ?? '-' }}
                </p>
            </div>

            <div class="md:col-span-2">
                <label class="text-gray-400 text-xs uppercase">
                    Alamat
                </label>

                <p class="text-gray-700 mt-1">
                    {{ $therapist->address ?? '-' }}
                </p>
            </div>

        </div>

    </div>


    <!-- ================= STATUS ================= -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <h2 class="text-sm font-semibold text-gray-500 mb-4 uppercase tracking-wide">
            Status Verifikasi
        </h2>

        @if($therapist->verification_status == 'approved')

            <span class="px-4 py-2 rounded-xl text-sm bg-green-100 text-green-700 font-medium">
                Approved
            </span>

        @elseif($therapist->verification_status == 'rejected')

            <span class="px-4 py-2 rounded-xl text-sm bg-red-100 text-red-700 font-medium">
                Rejected
            </span>

        @else

            <span class="px-4 py-2 rounded-xl text-sm bg-yellow-100 text-yellow-700 font-medium">
                Pending
            </span>

        @endif


        @if($therapist->reject_reason)

            <div class="mt-5">

                <label class="text-gray-400 text-xs uppercase">
                    Alasan Penolakan
                </label>

                <div class="mt-2 bg-red-50 border border-red-100 rounded-xl p-4 text-sm text-red-600">
                    {{ $therapist->reject_reason }}
                </div>

            </div>

        @endif

    </div>


    <!-- ================= PROFILE ================= -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <h2 class="text-sm font-semibold text-gray-500 mb-6 uppercase tracking-wide">
            Profil Terapis (Assessment)
        </h2>

        @if($therapist->therapistProfile)

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 text-sm">

                <!-- ================= KEMAMPUAN ================= -->
                <div class="space-y-5">

                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                        Kemampuan
                    </h3>

                    <div>
                        <label class="text-gray-400 text-xs uppercase">
                            Pengalaman
                        </label>

                        <p class="text-gray-800 font-medium mt-1">
                            {{ $therapist->therapistProfile->experience_years ?? 0 }} Tahun
                        </p>
                    </div>

                    <div>
                        <label class="text-gray-400 text-xs uppercase">
                            Teknik Pijat
                        </label>

                        <div class="mt-2 bg-gray-50 rounded-xl p-4 text-gray-700 leading-relaxed">
                            {{ $therapist->therapistProfile->skills ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <label class="text-gray-400 text-xs uppercase">
                            Sertifikasi
                        </label>

                        <div class="mt-2 bg-gray-50 rounded-xl p-4 text-gray-700 leading-relaxed">
                            {{ $therapist->therapistProfile->certifications ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <label class="text-gray-400 text-xs uppercase">
                            Handle Kondisi Khusus
                        </label>

                        <div class="mt-2">

                            @if($therapist->therapistProfile->handle_special_condition)

                                <span class="px-3 py-1 rounded-lg bg-green-100 text-green-700 text-xs font-medium">
                                    Bisa Menangani
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-lg bg-gray-100 text-gray-700 text-xs font-medium">
                                    Tidak Bisa
                                </span>

                            @endif

                        </div>
                    </div>

                </div>


                <!-- ================= KETERSEDIAAN ================= -->
                <div class="space-y-5">

                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                        Ketersediaan
                    </h3>

                    <!-- HARI KERJA -->
                    <div>

                        <label class="text-gray-400 text-xs uppercase">
                            Hari Kerja
                        </label>

                        <div class="flex flex-wrap gap-2 mt-3">

                            @forelse($therapist->therapistProfile->work_days ?? [] as $day)

                                <span class="px-3 py-1 rounded-lg bg-gray-100 text-gray-700 text-xs">
                                    {{ $day }}
                                </span>

                            @empty

                                <span class="text-gray-400 text-sm">
                                    -
                                </span>

                            @endforelse

                        </div>

                    </div>


                    <!-- SHIFT -->
                    <div>

                        <label class="text-gray-400 text-xs uppercase">
                            Shift Kerja
                        </label>

                        <div class="flex flex-col gap-3 mt-3">

                            @php
                                $shiftLabels = [

                                    'shift_1' => [
                                        'title' => 'Shift 1',
                                        'time' => '06:00 - 12:00'
                                    ],

                                    'shift_2' => [
                                        'title' => 'Shift 2',
                                        'time' => '12:00 - 18:00'
                                    ],

                                    'shift_3' => [
                                        'title' => 'Shift 3',
                                        'time' => '18:00 - 00:00'
                                    ],
                                ];
                            @endphp

                            @forelse($therapist->therapistProfile->work_shifts ?? [] as $shift)

                                <div class="border rounded-xl p-4 bg-gray-50">

                                    <div class="flex justify-between items-center">

                                        <div>

                                            <p class="font-medium text-gray-800">
                                                {{ $shiftLabels[$shift]['title'] ?? '-' }}
                                            </p>

                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $shiftLabels[$shift]['time'] ?? '-' }}
                                            </p>

                                        </div>

                                        <span class="px-3 py-1 rounded-lg bg-green-100 text-green-700 text-xs">
                                            Aktif
                                        </span>

                                    </div>

                                </div>

                            @empty

                                <p class="text-gray-400 text-sm">
                                    Shift belum dipilih
                                </p>

                            @endforelse

                        </div>

                    </div>


                    <!-- KOTA -->
                    <div>

                        <label class="text-gray-400 text-xs uppercase">
                            Kota Jangkauan
                        </label>

                        <p class="text-gray-700 mt-1">
                            {{ $therapist->therapistProfile?->city?->name ?? '-' }}
                        </p>

                    </div>

                </div>

            </div>

        @else

            <div class="text-center py-10 text-gray-400 text-sm">
                Profil assessment belum diisi
            </div>

        @endif

    </div>


    <!-- ================= ACTION ================= -->
    @if($therapist->verification_status == 'pending')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <h2 class="text-sm font-semibold text-gray-500 mb-5 uppercase tracking-wide">
            Aksi Verifikasi
        </h2>

        <div class="flex flex-col lg:flex-row gap-4">

            <!-- APPROVE -->
            <form action="{{ route('admin.therapist.verify', $therapist->id) }}"
                  method="POST">
                @csrf

                <button class="px-6 py-3 rounded-xl bg-green-500 text-white hover:bg-green-600 transition">
                    Approve Terapis
                </button>

            </form>


            <!-- REJECT -->
            <form action="{{ route('admin.therapist.reject', $therapist->id) }}"
                  method="POST"
                  class="flex flex-col md:flex-row gap-3 w-full">
                @csrf

                <input
                    type="text"
                    name="reject_reason"
                    required
                    placeholder="Masukkan alasan penolakan..."
                    class="border rounded-xl px-4 py-3 text-sm w-full"
                >

                <button class="px-6 py-3 rounded-xl bg-red-500 text-white hover:bg-red-600 transition whitespace-nowrap">
                    Reject Terapis
                </button>

            </form>

        </div>

    </div>

    @endif

</div>

@endsection
