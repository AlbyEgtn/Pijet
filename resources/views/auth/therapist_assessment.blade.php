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

        <!-- KEMAMPUAN -->
        <div>
            <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">
                Kemampuan Terapis
            </h2>

            <div class="grid md:grid-cols-2 gap-4">

                <!-- Pengalaman -->
                <div>
                    <label class="text-sm text-gray-600">Pengalaman (tahun)</label>
                    <input type="number" name="experience_years"
                        class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500"
                        placeholder="Contoh: 3">
                </div>

                <!-- Kondisi Khusus -->
                <div>
                    <label class="text-sm text-gray-600">Kondisi Khusus</label>
                    <select name="handle_special_condition"
                        class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500">
                        <option value="1">Bisa menangani</option>
                        <option value="0">Tidak bisa</option>
                    </select>
                </div>

            </div>

            <!-- Skill -->
            <div class="mt-4">
                <label class="text-sm text-gray-600">Teknik Pijat</label>
                <textarea name="skills" rows="3"
                    class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500"
                    placeholder="Refleksi, Shiatsu, Deep Tissue"></textarea>
            </div>

            <!-- Sertifikasi -->
            <div>
                <label class="text-sm text-gray-600">Sertifikasi / Pelatihan</label>
                <textarea name="certifications" rows="3"
                    class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500"
                    placeholder="Sertifikat SPA Nasional"></textarea>
            </div>
        </div>

        <!-- KETERSEDIAAN -->
        <div>
            <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">
                Ketersediaan
            </h2>

            <div class="grid md:grid-cols-2 gap-4">

                <div>
                    <label class="text-sm text-gray-600">Hari Kerja</label>
                    <input type="text" name="work_days"
                        class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500"
                        placeholder="Senin - Jumat">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Jam Kerja</label>
                    <input type="text" name="work_hours"
                        class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500"
                        placeholder="09.00 - 17.00">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Layanan Panggilan</label>
                    <select name="is_mobile"
                        class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500">
                        <option value="1">Bisa</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600">Area Jangkauan</label>
                    <input type="text" name="coverage_area"
                        class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500"
                        placeholder="Surabaya Timur">
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
