@extends('layouts.auth')

@section('title', 'Reset Password')

@section('body-class', 'bg-gray-100 flex items-center justify-center min-h-screen')

@section('content')

<div class="w-[420px] bg-white rounded-2xl shadow-xl p-10 text-center">

    <h1 class="text-xl font-semibold mb-6">
        Buat Password Baru
    </h1>

    <form method="POST" action="{{ route('forgot.reset') }}">
        @csrf

        <div class="mb-4">

            <input
                type="password"
                name="password"
                placeholder="Password Baru"
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-teal-500"
            >

        </div>

        <div class="mb-6">

            <input
                type="password"
                name="password_confirmation"
                placeholder="Konfirmasi Password"
                class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-teal-500"
            >

        </div>

        <button
            class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 rounded-xl">

            Simpan Password

        </button>

    </form>

</div>

@endsection