@extends('layouts.auth')

@section('title', 'Register')

@section('body-class', 'min-h-screen bg-gray-100')

@section('content')

<div class="flex min-h-screen">

    <!-- LEFT BANNER -->
    <div class="w-[20%] bg-teal-600 text-white flex items-center justify-center p-8">

        <div class="max-w-xs">

            <h1 class="text-2xl font-semibold mb-4">
                Selamat Bergabung
            </h1>

            <p class="text-sm leading-relaxed opacity-90">
                Silakan masukkan data diri anda untuk membuat akun
                dan mulai menggunakan layanan pijat profesional kami.
            </p>

        </div>

    </div>


    <!-- FORM AREA -->
    <div class="w-[80%] flex items-center justify-center p-10">

        <div class="w-full max-w-4xl bg-white shadow-lg rounded-xl p-10">

            <h2 class="text-2xl font-semibold mb-6">
                Daftar Akun Customer
            </h2>

            {{-- ERROR VALIDATION --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                    <ul class="list-disc ml-4 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="POST"
                  action="{{ route('register.store') }}"
                  class="space-y-6">

                @csrf

                <input type="hidden" name="role" value="customer">

                <div class="grid grid-cols-3 gap-6">

                    <div>
                        <label class="text-sm text-gray-600">NIK KTP</label>
                        <input type="text" name="nik"
                               value="{{ old('nik') }}"
                               required
                               class="w-full border rounded-lg px-4 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Nama Lengkap</label>
                        <input type="text" name="name"
                               value="{{ old('name') }}"
                               required
                               class="w-full border rounded-lg px-4 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Jenis Kelamin</label>

                        <div class="flex gap-6 mt-2 text-sm">

                            <label class="flex items-center gap-2">
                                <input type="radio"
                                       name="gender"
                                       value="L"
                                       {{ old('gender') == 'L' ? 'checked' : '' }}>
                                Laki-laki
                            </label>

                            <label class="flex items-center gap-2">
                                <input type="radio"
                                       name="gender"
                                       value="P"
                                       {{ old('gender') == 'P' ? 'checked' : '' }}>
                                Perempuan
                            </label>

                        </div>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Tanggal Lahir</label>
                        <input type="date"
                               name="birth_date"
                               value="{{ old('birth_date') }}"
                               required
                               class="w-full border rounded-lg px-4 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               class="w-full border rounded-lg px-4 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">No Telepon</label>
                        <input type="text"
                               name="phone"
                               value="{{ old('phone') }}"
                               required
                               class="w-full border rounded-lg px-4 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Password</label>
                        <input type="password"
                               name="password"
                               required
                               class="w-full border rounded-lg px-4 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Konfirmasi Password</label>
                        <input type="password"
                               name="password_confirmation"
                               required
                               class="w-full border rounded-lg px-4 py-2 mt-1">
                    </div>

                </div>


                <button
                    type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 rounded-lg"
                >
                    Daftar
                </button>


                <div class="text-center text-sm text-gray-600">

                    Ingin menjadi
                    <span class="font-semibold">Terapis</span>?

                    <a href="{{ route('register.therapist') }}"
                       class="text-teal-600 hover:underline">
                        Daftar sebagai terapis
                    </a>

                </div>


                <div class="text-center text-sm">

                    Sudah punya akun?

                    <a href="{{ route('login') }}"
                       class="text-teal-600 hover:underline">
                        Login
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection