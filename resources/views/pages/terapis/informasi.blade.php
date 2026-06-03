@extends('layouts.terapis')

@section('title','Perbaiki Data Verifikasi')
@section('header','Perbaiki Data Verifikasi')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

    {{-- ALERT REJECT --}}
    @if(auth()->user()->verification_status === 'rejected')

    <div class="
        bg-red-50
        border border-red-200
        rounded-3xl
        p-6
    ">

        <div class="flex gap-4">

            <div class="text-4xl">
                ⚠️
            </div>

            <div>

                <h3 class="text-lg font-semibold text-red-700">
                    Verifikasi Ditolak
                </h3>

                <p class="mt-2 text-red-600">
                    {{ auth()->user()->reject_reason }}
                </p>

                <p class="mt-3 text-sm text-red-500">
                    Silakan perbaiki data yang diperlukan lalu simpan kembali untuk mengajukan verifikasi ulang.
                </p>

            </div>

        </div>

    </div>

    @endif


    <form
        action="{{ route('terapis.informasi.update') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6">

        @csrf

        {{-- DATA PRIBADI --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

            <h2 class="font-semibold text-lg mb-5">
                Data Pribadi
            </h2>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name',$user->name) }}"
                        class="w-full border rounded-xl p-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Email
                    </label>

                    <input
                        type="email"
                        value="{{ $user->email }}"
                        disabled
                        class="w-full border rounded-xl p-3 bg-gray-100">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        NIK
                    </label>

                    <input
                        type="text"
                        name="nik"
                        value="{{ old('nik',$user->nik) }}"
                        class="w-full border rounded-xl p-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone',$user->phone) }}"
                        class="w-full border rounded-xl p-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Jenis Kelamin
                    </label>

                    <select
                        name="gender"
                        class="w-full border rounded-xl p-3">

                        <option value="L"
                            {{ $user->gender == 'L' ? 'selected' : '' }}>
                            Laki-laki
                        </option>

                        <option value="P"
                            {{ $user->gender == 'P' ? 'selected' : '' }}>
                            Perempuan
                        </option>

                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Tanggal Lahir
                    </label>

                    <input
                        type="date"
                        name="birth_date"
                        value="{{ $user->birth_date }}"
                        class="w-full border rounded-xl p-3">
                </div>

            </div>

            <div class="mt-5">

                <label class="block mb-2 text-sm font-medium">
                    Alamat
                </label>

                <textarea
                    name="address"
                    rows="4"
                    class="w-full border rounded-xl p-3">{{ old('address',$user->address) }}</textarea>

            </div>

        </div>


        {{-- DATA TERAPIS --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

            <h2 class="font-semibold text-lg mb-5">
                Data Terapis
            </h2>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Pengalaman (Tahun)
                    </label>

                    <input
                        type="number"
                        name="experience_years"
                        value="{{ old('experience_years',$profile->experience_years ?? '') }}"
                        class="w-full border rounded-xl p-3">
                </div>

            </div>

            <div class="mt-5">

                <label class="block mb-2 text-sm font-medium">
                    Keahlian
                </label>

                <textarea
                    name="skills"
                    rows="4"
                    class="w-full border rounded-xl p-3">{{ old('skills',$profile->skills ?? '') }}</textarea>

            </div>

            <div class="mt-5">

                <label class="block mb-2 text-sm font-medium">
                    Sertifikasi
                </label>

                <textarea
                    name="certifications"
                    rows="4"
                    class="w-full border rounded-xl p-3">{{ old('certifications',$profile->certifications ?? '') }}</textarea>

            </div>

        </div>


        {{-- DOKUMEN --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

            <h2 class="font-semibold text-lg mb-5">
                Dokumen Verifikasi
            </h2>

            <div class="grid md:grid-cols-3 gap-6">

                <div>

                    <label class="block mb-2 font-medium">
                        KTP
                    </label>

                    @if($user->ktp)
                        <img
                            src="{{ asset('storage/'.$user->ktp) }}"
                            class="w-full h-48 object-cover rounded-2xl border mb-3">
                    @endif

                    <input
                        type="file"
                        name="ktp"
                        class="w-full border rounded-xl p-3">

                </div>

                <div>

                    <label class="block mb-2 font-medium">
                        SKCK
                    </label>

                    @if($user->skck)
                        <img
                            src="{{ asset('storage/'.$user->skck) }}"
                            class="w-full h-48 object-cover rounded-2xl border mb-3">
                    @endif

                    <input
                        type="file"
                        name="skck"
                        class="w-full border rounded-xl p-3">

                </div>

            </div>

        </div>


        {{-- BUTTON --}}
        <div class="flex justify-end">

            <button
                type="submit"
                class="
                    bg-teal-600
                    hover:bg-teal-700
                    text-white
                    px-8 py-3
                    rounded-2xl
                    font-semibold
                    shadow
                ">

                Simpan Perubahan & Ajukan Ulang

            </button>

        </div>

    </form>

</div>

@endsection