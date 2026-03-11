@extends('layouts.superadmin')

@section('title', 'Edit Cabang')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">

        <h2 class="text-lg font-semibold">
            Edit Data Cabang
        </h2>

        <a href="{{ route('superadmin.cabang.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded-lg text-sm">
            Kembali
        </a>

    </div>


    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- FORM EDIT --}}
    <form action="{{ route('superadmin.cabang.update', $cabang->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- KODE CABANG --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    ID Cabang
                </label>
                <input
                    type="text"
                    name="kode_cabang"
                    value="{{ old('kode_cabang', $cabang->kode_cabang) }}"
                    class="w-full border rounded-lg px-3 py-2"
                >
            </div>


            {{-- KOTA --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Kota
                </label>
                <input
                    type="text"
                    name="kota"
                    value="{{ old('kota', $cabang->kota) }}"
                    class="w-full border rounded-lg px-3 py-2"
                >
            </div>


            {{-- PROVINSI --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Provinsi
                </label>
                <input
                    type="text"
                    name="provinsi"
                    value="{{ old('provinsi', $cabang->provinsi) }}"
                    class="w-full border rounded-lg px-3 py-2"
                >
            </div>


            {{-- TANGGAL PERESMIAN --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Tanggal Peresmian
                </label>
                <input
                    type="date"
                    name="tanggal_peresmian"
                    value="{{ old('tanggal_peresmian', $cabang->tanggal_peresmian) }}"
                    class="w-full border rounded-lg px-3 py-2"
                >
            </div>


            {{-- STATUS --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Status Cabang
                </label>
                <select
                    name="status"
                    class="w-full border rounded-lg px-3 py-2"
                >
                    <option value="Aktif"
                        {{ $cabang->status == 'Aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="Nonaktif"
                        {{ $cabang->status == 'Nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>


            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Email Cabang
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $cabang->email) }}"
                    class="w-full border rounded-lg px-3 py-2"
                >
            </div>

        </div>


        {{-- BUTTON --}}
        <div class="mt-6 flex gap-3">

            <button
                type="submit"
                class="bg-blue-500 text-white px-5 py-2 rounded-lg">
                Update Cabang
            </button>

            <a href="{{ route('superadmin.cabang.index') }}"
               class="bg-gray-400 text-white px-5 py-2 rounded-lg">
                Batal
            </a>

        </div>

    </form>

</div>

@endsection