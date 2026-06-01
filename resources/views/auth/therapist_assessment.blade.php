@extends('layouts.auth')

@section('title', 'Pertanyaan Registrasi')

@section('body-class', 'bg-gray-100 flex items-center justify-center min-h-screen')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">

    <form method="POST" action="{{ route('terapis.assessment.store') }}"
        class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-8 space-y-8">
        @csrf

        <!-- HEADER -->
        <div class="text-center">
            <div class="w-14 h-14 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-3">
                <span class="text-green-600 text-xl">📝</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Form Assessment Terapis</h1>
            <p class="text-sm text-gray-500">
                Lengkapi data kemampuan dan ketersediaan secara detail
            </p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- KEMAMPUAN -->
        <div>
            <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">
                Kemampuan Terapis
            </h2>

            <div class="grid md:grid-cols-2 gap-4">

                <!-- Pengalaman -->
                <div>
                    <label class="text-sm text-gray-600">Pengalaman (tahun)</label>
                    <input
                        type="number"
                        name="experience_years"
                        value="{{ old('experience_years') }}"
                        min="0"
                        max="60"
                        required
                        class="mt-1 w-full border rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-green-500
                        @error('experience_years') border-red-500 @enderror"
                        placeholder="Contoh: 3">
                    @error('experience_years')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Kondisi Khusus -->
                <div>

                    <label class="text-sm text-gray-600">
                        Kondisi Khusus
                    </label>

                    <select
                        name="handle_special_condition"
                        required
                        class="mt-1 w-full border rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-green-500
                        @error('handle_special_condition') border-red-500 @enderror"
                    >

                        <option value="">
                            -- Pilih --
                        </option>

                        <option value="1"
                            {{ old('handle_special_condition') == '1' ? 'selected' : '' }}>
                            Bisa menangani
                        </option>

                        <option value="0"
                            {{ old('handle_special_condition') == '0' ? 'selected' : '' }}>
                            Tidak bisa
                        </option>

                    </select>

                    @error('handle_special_condition')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

            <!-- Skill -->
            <div class="mt-4">
                <label class="text-sm text-gray-600">Teknik Pijat</label>
                <textarea
                    name="skills"
                    rows="3"
                    required
                    maxlength="500"
                    oninput="this.value=this.value.replace(/[^A-Za-z\s,.\-]/g,'')"
                    class="mt-1 w-full border rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-green-500
                    @error('skills') border-red-500 @enderror"
                    placeholder="Refleksi, Shiatsu, Deep Tissue">{{ old('skills') }}</textarea>
                    @error('skills')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
            </div>

            <!-- Sertifikasi -->
            <div>
                <label class="text-sm text-gray-600">Sertifikasi / Pelatihan</label>
                <textarea
                    name="certifications"
                    rows="3"
                    required
                    maxlength="500"
                    oninput="this.value=this.value.replace(/[^A-Za-z\s,.\-]/g,'')"
                    class="mt-1 w-full border rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-green-500
                    @error('certifications') border-red-500 @enderror"
                    placeholder="Sertifikat SPA Nasional">{{ old('certifications') }}</textarea>
                    @error('certifications')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
            </div>
        </div>

        <!-- KETERSEDIAAN -->
        <div>
            <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">
                Ketersediaan
            </h2>

            <div class="grid md:grid-cols-2 gap-4">

                <!-- Hari Kerja -->
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600">
                        Hari Kerja
                    </label>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-2">

                        @php
                            $days = [
                                'Senin',
                                'Selasa',
                                'Rabu',
                                'Kamis',
                                'Jumat',
                                'Sabtu',
                                'Minggu'
                            ];
                        @endphp

                        @foreach($days as $day)
                            <label class="flex items-center gap-2 border rounded-lg px-3 py-2">
                                <input type="checkbox"
                                    name="work_days[]"
                                    value="{{ $day }}">

                                <span>{{ $day }}</span>
                            </label>
                        @endforeach

                        @error('work_days')
                            <p class="text-red-500 text-xs mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>
                </div>

                <!-- Shift Kerja -->
                <div class="md:col-span-2">

                    <label class="text-sm text-gray-600">
                        Shift Kerja
                    </label>

                    <div class="grid md:grid-cols-3 gap-3 mt-2">

                        <!-- SHIFT 1 -->
                        <label class="border rounded-xl p-4 flex items-start gap-3 hover:border-green-500 cursor-pointer">

                            <input
                                type="checkbox"
                                name="work_shifts[]"
                                value="shift_1"
                                class="mt-1"
                                {{ in_array('shift_1', old('work_shifts', [])) ? 'checked' : '' }}

                            >

                            <div>
                                <p class="font-medium text-sm text-gray-800">
                                    Shift 1
                                </p>

                                <p class="text-xs text-gray-500">
                                    06:00 pagi - 12:00 siang
                                </p>
                            </div>

                        </label>

                        <!-- SHIFT 2 -->
                        <label class="border rounded-xl p-4 flex items-start gap-3 hover:border-green-500 cursor-pointer">

                            <input
                                type="checkbox"
                                name="work_shifts[]"
                                value="shift_2"
                                class="mt-1"
                                {{ in_array('shift_2', old('work_shifts', [])) ? 'checked' : '' }}

                            >

                            <div>
                                <p class="font-medium text-sm text-gray-800">
                                    Shift 2
                                </p>

                                <p class="text-xs text-gray-500">
                                    12:00 siang - 18:00 sore
                                </p>
                            </div>

                        </label>

                        <!-- SHIFT 3 -->
                        <label class="border rounded-xl p-4 flex items-start gap-3 hover:border-green-500 cursor-pointer">

                            <input
                                type="checkbox"
                                name="work_shifts[]"
                                value="shift_3"
                                class="mt-1"
                                {{ in_array('shift_3', old('work_shifts', [])) ? 'checked' : '' }}

                            >

                            <div>
                                <p class="font-medium text-sm text-gray-800">
                                    Shift 3
                                </p>

                                <p class="text-xs text-gray-500">
                                    18:00 sore - 00:00 malam
                                </p>
                            </div>

                        </label>

                    </div>

                    @error('work_shifts')
                        <p class="text-red-500 text-xs mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <!-- Kota -->
                <div>

                    <label class="text-sm text-gray-600">
                        Kota Jangkauan
                    </label>

                    <select
                        name="city_id"
                        required
                        class="mt-1 w-full border rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-green-500
                        @error('city_id') border-red-500 @enderror"
                    >

                        <option value="">
                            -- Pilih Kota --
                        </option>

                        @foreach($cities as $city)

                            <option
                                value="{{ $city->id }}"
                                {{ old('city_id') == $city->id ? 'selected' : '' }}
                            >
                                {{ $city->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('city_id')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>
                
            </div>
        </div>

        <!-- BUTTON -->
        <div class="pt-4">
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition shadow-md">
                Simpan Assessment
            </button>
        </div>

    </form>
</div>

@endsection
