@extends('layouts.terapis')

@section('title', 'Ganti Password')
@section('header',' Ganti Password ')

@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-white shadow rounded-xl p-8">

    <!-- HEADER -->
    <h2 class="text-2xl font-bold text-gray-700 mb-6 flex items-center gap-2">

        <a 
            href="{{ route('terapis.profile') }}"
            class="text-gray-600 hover:text-gray-800"
        >
            ←
        </a>

        Ganti Password

    </h2>


    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif


    <!-- ERROR MESSAGE -->
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif


    <!-- FORM -->
    <form 
        action="{{ route('terapis.password.update') }}" 
        method="POST"
    >

        @csrf


        <!-- PASSWORD LAMA -->
        <div class="mb-5">

            <label class="block text-sm font-medium text-gray-600 mb-1">
                Password Saat Ini
            </label>

            <input
                type="password"
                name="current_password"
                required
                class="w-full border rounded-lg p-3 focus:ring focus:ring-teal-200 focus:outline-none"
                placeholder="Masukkan password saat ini"
            >

        </div>


        <!-- PASSWORD BARU -->
        <div class="mb-5">

            <label class="block text-sm font-medium text-gray-600 mb-1">
                Password Baru
            </label>

            <input
                type="password"
                name="new_password"
                required
                class="w-full border rounded-lg p-3 focus:ring focus:ring-teal-200 focus:outline-none"
                placeholder="Masukkan password baru"
            >

        </div>


        <!-- KONFIRMASI PASSWORD -->
        <div class="mb-6">

            <label class="block text-sm font-medium text-gray-600 mb-1">
                Konfirmasi Password Baru
            </label>

            <input
                type="password"
                name="new_password_confirmation"
                required
                class="w-full border rounded-lg p-3 focus:ring focus:ring-teal-200 focus:outline-none"
                placeholder="Ulangi password baru"
            >

        </div>


        <!-- BUTTON -->
        <div class="flex justify-end">

            <button
                type="submit"
                class="bg-teal-600 text-white px-6 py-3 rounded-lg hover:bg-teal-700 transition"
            >
                Update Password
            </button>

        </div>

    </form>

</div>

@endsection