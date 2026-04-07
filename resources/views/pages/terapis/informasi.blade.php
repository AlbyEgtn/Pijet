@extends('layouts.terapis')

@section('title', 'Informasi Lainnya')
@section('header',' Informasi Lainnya ')

@section('content')

<div class="max-w-4xl mx-auto mt-10 bg-white shadow rounded-xl p-8">

    <!-- HEADER -->
    <h2 class="text-2xl font-bold mb-6 text-gray-700 flex items-center gap-2">

        <a 
            href="{{ route('terapis.profile') }}"
            class="text-gray-600 hover:text-gray-800"
        >
            ←
        </a>

        Informasi Akun

    </h2>


    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif


    <!-- FORM -->
    <form 
        action="{{ route('terapis.informasi.update') }}" 
        method="POST"
    >

        @csrf


        <div class="grid grid-cols-2 gap-6">

            <!-- TIPE PENGGUNA -->
            <div>

                <label class="block text-sm text-gray-600 mb-1">
                    Tipe Pengguna
                </label>

                <input
                    type="text"
                    value="Terapis"
                    disabled
                    class="w-full border rounded-lg p-2 bg-gray-100"
                >

            </div>


            <!-- TANGGAL BERGABUNG -->
            <div>

                <label class="block text-sm text-gray-600 mb-1">
                    Tanggal Bergabung
                </label>

                <input
                    type="text"
                    value="{{ $user->created_at->format('d M Y') }}"
                    disabled
                    class="w-full border rounded-lg p-2 bg-gray-100"
                >

            </div>


            <!-- TOTAL LAYANAN -->
            <div>

                <label class="block text-sm text-gray-600 mb-1">
                    Total Layanan Diselesaikan
                </label>

                <input
                    type="text"
                    value="{{ $terapis->total_orders ?? 0 }}"
                    disabled
                    class="w-full border rounded-lg p-2 bg-gray-100"
                >

            </div>


            <!-- STATUS -->
            <div>

                <label class="block text-sm text-gray-600 mb-1">
                    Status Terapis
                </label>

                <input
                    type="text"
                    value="{{ ($terapis->status ?? 1) == 1 ? 'Aktif' : 'Nonaktif' }}"
                    disabled
                    class="w-full border rounded-lg p-2 bg-gray-100 text-gray-700"
                >

            </div>

        </div>


        <!-- BUTTON -->
        <div class="mt-6 flex justify-end">

            <button
                type="submit"
                class="bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-teal-700 transition"
            >
                Update Informasi
            </button>

        </div>


    </form>

</div>

@endsection