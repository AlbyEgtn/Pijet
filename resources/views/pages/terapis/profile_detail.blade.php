@extends('layouts.terapis')

@section('title','Data Profile')

@section('content')

<div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8">
    
    <h2 class="text-2xl font-bold mb-6 text-gray-700">
        <a href="{{ route('terapis.profile') }}"
           class="text-gray-600">

            ←

        </a>
        Profil Terapis
    </h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('terapis.update') }}" method="POST">

        @csrf

        <div class="grid grid-cols-2 gap-6">

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Nama
                </label>

                <input 
                    type="text"
                    value="{{ $user->name }}"
                    disabled
                    class="w-full border rounded-lg p-2 bg-gray-100"
                >
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Email
                </label>

                <input 
                    type="email"
                    value="{{ $user->email }}"
                    disabled
                    class="w-full border rounded-lg p-2 bg-gray-100"
                >
            </div>

            <!-- NIK -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    NIK
                </label>

                <input 
                    type="text"
                    name="nik"
                    value="{{ $terapis->nik ?? '' }}"
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200"
                >
            </div>

            <!-- Gender -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Gender
                </label>

                <select 
                    name="gender"
                    class="w-full border rounded-lg p-2"
                >
                    <option value="">Pilih Gender</option>

                    <option value="L"
                        {{ ($terapis->gender ?? '') == 'L' ? 'selected' : '' }}>
                        Laki-laki
                    </option>

                    <option value="P"
                        {{ ($terapis->gender ?? '') == 'P' ? 'selected' : '' }}>
                        Perempuan
                    </option>

                </select>
            </div>

            <!-- Whatsapp -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Nomor Whatsapp
                </label>

                <input 
                    type="text"
                    name="whatsapp"
                    value="{{ $terapis->whatsapp ?? '' }}"
                    class="w-full border rounded-lg p-2"
                >
            </div>

            <div class="grid grid-cols-2 gap-6">

                <!-- BANK -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Bank
                    </label>

                    <select
                        name="bank_name"
                        class="w-full border rounded-lg p-2"
                    >
                        <option value="">Pilih Bank</option>

                        <option value="BCA"
                            {{ ($terapis->bank_name ?? '') == 'BCA' ? 'selected' : '' }}>
                            BCA
                        </option>

                        <option value="BRI"
                            {{ ($terapis->bank_name ?? '') == 'BRI' ? 'selected' : '' }}>
                            BRI
                        </option>

                        <option value="BNI"
                            {{ ($terapis->bank_name ?? '') == 'BNI' ? 'selected' : '' }}>
                            BNI
                        </option>

                        <option value="Mandiri"
                            {{ ($terapis->bank_name ?? '') == 'Mandiri' ? 'selected' : '' }}>
                            Mandiri
                        </option>

                    </select>
                </div>

                <!-- NOMOR REKENING -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Nomor Rekening
                    </label>

                    <input
                        type="text"
                        name="bank_number"
                        value="{{ $terapis->bank_number ?? '' }}"
                        class="w-full border rounded-lg p-2"
                    >
                </div>

            </div>

        </div>

        <!-- Address -->
        <div class="mt-6">

            <label class="block text-sm font-medium text-gray-600 mb-1">
                Alamat
            </label>

            <textarea 
                name="address"
                rows="3"
                class="w-full border rounded-lg p-2"
            >{{ $terapis->address ?? '' }}</textarea>

        </div>

        <!-- Button -->
        <div class="mt-6 flex justify-end">

            <button 
                type="submit"
                class="bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-teal-700 transition"
            >
                Update Profil
            </button>

        </div>

    </form>

</div>

@endsection