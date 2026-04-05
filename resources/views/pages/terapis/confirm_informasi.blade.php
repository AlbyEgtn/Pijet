@extends('layouts.terapis')

@section('title', 'Konfirmasi Password')
@section('header','Konfirmasi Password ')

@section('content')

<div class="max-w-md mx-auto mt-20 bg-white shadow rounded-xl p-8">

    <!-- HEADER -->
    <h2 class="text-xl font-semibold text-gray-700 mb-2">
        Konfirmasi Password
    </h2>

    <p class="text-sm text-gray-500 mb-6">
        Demi keamanan akun, silakan masukkan password Anda untuk membuka halaman informasi akun.
    </p>


    <!-- ERROR MESSAGE -->
    @if(session('error'))
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif


    <!-- FORM -->
    <form
        action="{{ route('terapis.informasi.check') }}"
        method="POST"
    >

        @csrf


        <!-- PASSWORD -->
        <div class="mb-5">

            <label class="block text-sm text-gray-600 mb-1">
                Password
            </label>

            <input
                type="password"
                name="password"
                required
                class="w-full border rounded-lg p-3 focus:ring focus:ring-teal-200 focus:outline-none"
                placeholder="Masukkan password"
            >

        </div>


        <!-- BUTTON -->
        <button
            type="submit"
            class="w-full bg-teal-600 text-white py-3 rounded-lg hover:bg-teal-700 transition"
        >
            Konfirmasi
        </button>

    </form>

</div>

@endsection