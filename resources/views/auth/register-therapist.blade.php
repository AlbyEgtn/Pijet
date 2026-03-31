@extends('layouts.auth')

@section('title', 'Register Terapis')

@section('body-class', 'min-h-screen bg-gray-100')

@section('content')

<div class="flex min-h-screen">

    <!-- BANNER -->
    <div class="w-[20%] bg-teal-600 text-white flex items-center justify-center p-8">

        <div class="max-w-xs">

            <h1 class="text-2xl font-semibold mb-4">
                Daftar Sebagai Terapis
            </h1>

            <p class="text-sm opacity-90">
                Lengkapi data diri dan dokumen untuk bergabung sebagai
                terapis profesional.
            </p>

        </div>

    </div>


    <!-- FORM -->
    <div class="w-[80%] flex items-center justify-center p-10">

        <div class="w-full max-w-5xl bg-white shadow-lg rounded-xl p-10">

            <h2 class="text-2xl font-semibold mb-6">
                Form Pendaftaran Terapis
            </h2>


            @if ($errors->any())

                <div class="bg-red-100 text-red-700 p-4 rounded mb-6">

                    <ul class="list-disc ml-4 text-sm">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('register.therapist.store') }}"
                enctype="multipart/form-data"
                class="space-y-6"
            >

                @csrf

                <input type="hidden" name="role" value="terapis">


                <div class="grid grid-cols-3 gap-6">

                    <div>

                        <label class="text-sm text-gray-600">
                            NIK
                        </label>

                        <input
                            type="text"
                            name="nik"
                            value="{{ old('nik') }}"
                            required
                            class="w-full border rounded-lg px-4 py-2 mt-1"
                        >

                    </div>


                    <div>

                        <label class="text-sm text-gray-600">
                            Nama
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="w-full border rounded-lg px-4 py-2 mt-1"
                        >

                    </div>


                    <div>

                        <label class="text-sm text-gray-600">
                            Jenis Kelamin
                        </label>

                        <div class="flex gap-6 mt-2 text-sm">

                            <label class="flex items-center gap-2">
                                <input type="radio" name="gender" value="L">
                                Laki-laki
                            </label>

                            <label class="flex items-center gap-2">
                                <input type="radio" name="gender" value="P">
                                Perempuan
                            </label>

                        </div>

                    </div>


                    <div>

                        <label class="text-sm text-gray-600">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            name="birth_date"
                            value="{{ old('birth_date') }}"
                            required
                            class="w-full border rounded-lg px-4 py-2 mt-1"
                        >

                    </div>


                    <div>

                        <label class="text-sm text-gray-600">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full border rounded-lg px-4 py-2 mt-1"
                        >

                    </div>


                    <div>

                        <label class="text-sm text-gray-600">
                            No Telepon
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                            class="w-full border rounded-lg px-4 py-2 mt-1"
                        >

                    </div>


                    <div class="col-span-3">

                        <div class="col-span-3">
                            <label class="text-sm text-gray-600">
                                Area Kerja
                            </label>

                            <select
                                name="work_area"
                                required
                                class="w-full border rounded-lg px-4 py-2 mt-1"
                            >
                                <option value="">-- Pilih Kota --</option>

                                @foreach($cities as $city)
                                    <option value="{{ $city->name }}"
                                        {{ old('work_area') == $city->name ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                    </div>


                    <div>

                        <label class="text-sm text-gray-600">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full border rounded-lg px-4 py-2 mt-1"
                        >

                    </div>


                    <div>

                        <label class="text-sm text-gray-600">
                            Konfirmasi Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            class="w-full border rounded-lg px-4 py-2 mt-1"
                        >

                    </div>


                    <div></div>


                    <div>

                        <label class="text-sm text-gray-600">
                            Upload KTP
                        </label>

                        <input
                            type="file"
                            name="ktp"
                            required
                            class="w-full border rounded-lg p-2 mt-1"
                        >

                    </div>


                    <div>

                        <label class="text-sm text-gray-600">
                            Upload SKCK
                        </label>

                        <input
                            type="file"
                            name="skck"
                            required
                            class="w-full border rounded-lg p-2 mt-1"
                        >

                    </div>

                </div>


                <button
                    type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 rounded-lg"
                >
                    Daftar Terapis
                </button>


                <div class="text-center text-sm">

                    Ingin mendaftar sebagai customer?

                    <a
                        href="{{ route('register') }}"
                        class="text-teal-600 hover:underline"
                    >
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection