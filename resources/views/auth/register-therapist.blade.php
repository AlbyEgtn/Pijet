@extends('layouts.auth')

@section('title', 'Register Terapis')

@section('body-class', 'min-h-screen bg-gray-100')

@section('content')

<div class="min-h-screen flex flex-col md:flex-row">

    <!-- ================= LEFT (DESKTOP ONLY) ================= -->
    <div class="hidden md:flex w-[25%] bg-teal-600 text-white items-center justify-center p-8">

        <div class="max-w-xs text-center">

            <h1 class="text-2xl font-semibold mb-4">
                Daftar Sebagai Terapis
            </h1>

            <p class="text-sm opacity-90">
                Lengkapi data diri dan dokumen untuk bergabung sebagai
                terapis profesional.
            </p>

        </div>

    </div>


    <!-- ================= RIGHT ================= -->
    <div class="w-full md:w-[75%] flex flex-col items-center justify-start md:justify-center relative">

        <!-- ================= MOBILE HEADER ================= -->
        <div class="md:hidden w-full bg-gradient-to-br from-teal-600 to-teal-500 text-white text-center pt-10 pb-20 rounded-b-[60px] shadow-md">

            <img src="{{ asset('images/logo.png') }}" class="mx-auto w-12 mb-2">

            <h1 class="text-lg font-semibold">
                Daftar Terapis
            </h1>

            <p class="text-xs opacity-80 mt-1">
                Lengkapi data & dokumen Anda
            </p>

        </div>


        <!-- ================= CARD ================= -->
        <div class="
            bg-white shadow-xl rounded-2xl
            px-6 py-8 md:p-10
            w-[92%] max-w-5xl
            -mt-16 md:mt-0
            relative z-10
        ">

            <!-- TITLE -->
            <h2 class="text-xl md:text-2xl font-semibold mb-6 text-center md:text-left">
                Form Pendaftaran Terapis
            </h2>

            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                    {{ session('error') }}
                </div>
            @endif


            {{-- ERROR --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-6 text-sm">
                    <ul class="list-disc ml-4">
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


                <!-- ================= GRID ================= -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">

                    <!-- NIK -->
                    <div>
                        <label class="text-sm text-gray-600">NIK</label>

                        <input
                            type="text"
                            name="nik"
                            value="{{ old('nik') }}"
                            required
                            maxlength="16"
                            pattern="[0-9]{16}"
                            inputmode="numeric"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                            class="w-full border rounded-lg px-4 py-3 mt-1 text-sm @error('nik') border-red-500 @enderror"
                        >

                        @error('nik')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- NAMA -->
                    <div>
                        <label class="text-sm text-gray-600">Nama</label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="w-full border rounded-lg px-4 py-3 mt-1 text-sm @error('name') border-red-500 @enderror"
                        >

                        @error('name')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- GENDER -->
                    <div>
                        <label class="text-sm text-gray-600">Jenis Kelamin</label>

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

                    <!-- TANGGAL -->
                    <div>
                        <label class="text-sm text-gray-600">Tanggal Lahir</label>
                        <input type="date" name="birth_date"
                               value="{{ old('birth_date') }}"
                               required
                               class="w-full border rounded-lg px-4 py-3 mt-1 text-sm">
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="text-sm text-gray-600">Email</label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full border rounded-lg px-4 py-3 mt-1 text-sm @error('email') border-red-500 @enderror"
                        >

                        @error('email')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- PHONE -->
                    <div>
                        <label class="text-sm text-gray-600">No Telepon</label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                            class="w-full border rounded-lg px-4 py-3 mt-1 text-sm @error('phone') border-red-500 @enderror"
                        >

                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- AREA -->
                    <div class="md:col-span-2 lg:col-span-3">
                        <label class="text-sm text-gray-600">Area Kerja</label>

                        <select name="city_id"
                                required
                                class="w-full border rounded-lg px-4 py-3 mt-1 text-sm">

                            <option value="">-- Pilih Kota --</option>

                            @foreach($cities as $city)
                                <option value="{{ $city->id }}"
                                    {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="text-sm text-gray-600">Password</label>

                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full border rounded-lg px-4 py-3 mt-1 text-sm @error('password') border-red-500 @enderror"
                        >

                        @error('password')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- CONFIRM -->
                    <div>
                        <label class="text-sm text-gray-600">
                            Konfirmasi Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            class="w-full border rounded-lg px-4 py-3 mt-1 text-sm"
                        >
                    </div>

                    <!-- FILE -->
                    <div>
                        <label class="text-sm text-gray-600">Upload KTP</label>

                        <input
                            type="file"
                            name="ktp"
                            accept=".jpg,.jpeg,.png,.pdf"
                            onchange="validateImage(this)"
                            required
                            class="w-full border rounded-lg p-2 mt-1 text-sm @error('ktp') border-red-500 @enderror"
                        >

                        @error('ktp')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Upload SKCK</label>

                        <input
                            type="file"
                            name="skck"
                            accept=".jpg,.jpeg,.png,.pdf"
                            onchange="validateImage(this)"
                            required
                            class="w-full border rounded-lg p-2 mt-1 text-sm @error('skck') border-red-500 @enderror"
                        >

                        @error('skck')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>


                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-teal-500 to-teal-600
                    hover:from-teal-600 hover:to-teal-700
                    text-white py-3 rounded-lg text-sm font-medium shadow-md"
                >
                    Daftar Terapis
                </button>


                <!-- LINK -->
                <div class="text-center text-sm">

                    Ingin mendaftar sebagai customer?

                    <a href="{{ route('register') }}"
                       class="text-teal-600 hover:underline">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
function showToast(message) {
    const toast = document.createElement('div');

    toast.innerText = message;
    toast.className = `
        fixed top-5 right-5 z-50
        bg-red-500 text-white px-4 py-2
        rounded-lg shadow-lg text-sm
        animate-fade-in
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000);
}

function validateImage(input) {
    const file = input.files[0];

    if (!file) return;

    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];

    if (!allowedTypes.includes(file.type)) {
        showToast('Hanya file gambar (JPG, JPEG, PNG) atau PDF yang diperbolehkan');

        input.value = ''; // reset file
    }
}
</script>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px);}
    to { opacity: 1; transform: translateY(0);}
}

.animate-fade-in {
    animation: fade-in 0.3s ease;
}
</style>

@endsection