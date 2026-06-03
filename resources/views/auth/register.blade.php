@extends('layouts.auth')

@section('title', 'Register')

@section('body-class', 'min-h-screen bg-gray-100')

@section('content')

<div class="min-h-screen flex flex-col md:flex-row">

    <!-- ================= LEFT (DESKTOP ONLY) ================= -->
    <div class="hidden md:flex w-[25%] bg-teal-600 text-white items-center justify-center p-8">

        <div class="max-w-xs text-center">

            <h1 class="text-2xl font-semibold mb-4">
                Selamat Bergabung
            </h1>

            <p class="text-sm leading-relaxed opacity-90">
                Silakan masukkan data diri anda untuk membuat akun
                dan mulai menggunakan layanan pijat profesional kami.
            </p>

        </div>

    </div>


    <!-- ================= RIGHT ================= -->
    <div class="w-full md:w-[75%] flex flex-col items-center justify-start md:justify-center relative">

        <!-- ================= MOBILE HEADER ================= -->
        <div class="md:hidden w-full bg-gradient-to-br from-teal-600 to-teal-500 text-white text-center pt-10 pb-20 rounded-b-[60px] shadow-md">

            <img src="{{ asset('images/logo.png') }}" class="mx-auto w-12 mb-2">

            <h1 class="text-lg font-semibold">Daftar Akun</h1>

            <p class="text-xs opacity-80 mt-1">
                Buat akun baru dengan mudah
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

            <!-- TITLE DESKTOP -->
            <h2 class="text-xl md:text-2xl font-semibold mb-6 text-center md:text-left">
                Daftar Akun Customer
            </h2>

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


            <form method="POST"
                  action="{{ route('register.store') }}"
                  class="space-y-6">

                @csrf
                <input type="hidden" name="role" value="customer">


                <!-- ================= GRID ================= -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">

                    <!-- NIK -->
                    <div>
                        <label class="text-sm text-gray-600">NIK</label>
                        <input type="text" name="nik"
                               value="{{ old('nik') }}"
                               required
                               class="w-full border rounded-lg px-4 py-3 mt-1 text-sm">
                    </div>

                    <!-- NAMA -->
                    <div>
                        <label class="text-sm text-gray-600">Nama Lengkap</label>
                        <input type="text" name="name"
                               value="{{ old('name') }}"
                               required
                               class="w-full border rounded-lg px-4 py-3 mt-1 text-sm">
                    </div>

                    <!-- GENDER -->
                    <div>
                        <label class="text-sm text-gray-600">Jenis Kelamin</label>

                        <div class="flex gap-6 mt-2 text-sm">

                            <label class="flex items-center gap-2">
                                <input type="radio" name="gender" value="L"
                                    {{ old('gender') == 'L' ? 'checked' : '' }}>
                                Laki-laki
                            </label>

                            <label class="flex items-center gap-2">
                                <input type="radio" name="gender" value="P"
                                    {{ old('gender') == 'P' ? 'checked' : '' }}>
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
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               required
                               class="w-full border rounded-lg px-4 py-3 mt-1 text-sm">
                    </div>

                    <!-- PHONE -->
                    <div>
                        <label class="text-sm text-gray-600">No Telepon</label>
                        <input type="text" name="phone"
                               value="{{ old('phone') }}"
                               required
                               class="w-full border rounded-lg px-4 py-3 mt-1 text-sm">
                    </div>

                    <!-- KOTA -->
                    <div>
                        <label class="text-sm text-gray-600">Kota</label>
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

                    <!-- ALAMAT -->
                    <div class="md:col-span-2 lg:col-span-3">
                        <label class="text-sm text-gray-600">Alamat Lengkap</label>
                        <textarea name="address" rows="2"
                                  required
                                  class="w-full border rounded-lg px-4 py-3 mt-1 text-sm">{{ old('address') }}</textarea>
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="text-sm text-gray-600">Password</label>
                        <input type="password" name="password"
                               required
                               class="w-full border rounded-lg px-4 py-3 mt-1 text-sm">
                    </div>

                    <!-- CONFIRM -->
                    <div>
                        <label class="text-sm text-gray-600">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                               required
                               class="w-full border rounded-lg px-4 py-3 mt-1 text-sm">
                    </div>

                </div>


                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-teal-500 to-teal-600
                    hover:from-teal-600 hover:to-teal-700
                    text-white py-3 rounded-lg text-sm font-medium shadow-md"
                >
                    Daftar
                </button>


                <!-- LINKS -->
                <div class="text-center text-sm text-gray-600">

                    Ingin menjadi <span class="font-semibold">Terapis</span>?

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

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('form');

    function setError(field, message) {

        field.classList.add('border-red-500');

        let error = field.parentElement.querySelector('.js-error');

        if (!error) {

            error = document.createElement('p');
            error.className = 'js-error text-red-500 text-xs mt-1';

            field.parentElement.appendChild(error);
        }

        error.textContent = message;
    }

    function clearError(field) {

        field.classList.remove('border-red-500');

        const error = field.parentElement.querySelector('.js-error');

        if (error) {
            error.remove();
        }
    }

    // ========================
    // NIK
    // ========================

    const nik = document.querySelector('[name="nik"]');

    nik.setAttribute('maxlength', '16');

    nik.addEventListener('input', function () {

        this.value = this.value.replace(/\D/g, '');

        validateNik();
    });

    function validateNik() {

        if (nik.value.trim() === '') {

            setError(nik, 'NIK wajib diisi');
            return false;
        }

        if (nik.value.length !== 16) {

            setError(nik, 'NIK harus 16 digit');
            return false;
        }

        clearError(nik);
        return true;
    }

    // ========================
    // NAMA
    // ========================

    const name = document.querySelector('[name="name"]');

    name.addEventListener('input', validateName);

    function validateName() {

        if (name.value.trim() === '') {

            setError(name, 'Nama wajib diisi');
            return false;
        }

        clearError(name);
        return true;
    }

    // ========================
    // EMAIL
    // ========================

    const email = document.querySelector('[name="email"]');

    email.addEventListener('input', validateEmail);

    function validateEmail() {

        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email.value.trim() === '') {

            setError(email, 'Email wajib diisi');
            return false;
        }

        if (!regex.test(email.value)) {

            setError(email, 'Format email tidak valid');
            return false;
        }

        clearError(email);
        return true;
    }

    // ========================
    // PHONE
    // ========================

    const phone = document.querySelector('[name="phone"]');

    phone.addEventListener('input', function () {

        this.value = this.value.replace(/[^\d]/g, '');

        validatePhone();
    });

    function validatePhone() {

        if (phone.value.trim() === '') {

            setError(phone, 'Nomor telepon wajib diisi');
            return false;
        }

        if (phone.value.length < 10) {

            setError(phone, 'Nomor telepon tidak valid');
            return false;
        }

        clearError(phone);
        return true;
    }

    // ========================
    // GENDER
    // ========================

    function validateGender() {

        const gender =
            document.querySelector('input[name="gender"]:checked');

        if (!gender) {

            const container =
                document.querySelector('input[name="gender"]').closest('div');

            let error = container.querySelector('.gender-error');

            if (!error) {

                error = document.createElement('p');
                error.className =
                    'gender-error text-red-500 text-xs mt-2';

                container.appendChild(error);
            }

            error.textContent =
                'Jenis kelamin wajib dipilih';

            return false;
        }

        const oldError =
            document.querySelector('.gender-error');

        if (oldError) {
            oldError.remove();
        }

        return true;
    }

    // ========================
    // TANGGAL LAHIR
    // ========================

    const birthDate =
        document.querySelector('[name="birth_date"]');

    birthDate.addEventListener('change', validateBirthDate);

    function validateBirthDate() {

        if (birthDate.value === '') {

            setError(
                birthDate,
                'Tanggal lahir wajib diisi'
            );

            return false;
        }

        clearError(birthDate);

        return true;
    }

    // ========================
    // KOTA
    // ========================

    const city =
        document.querySelector('[name="city_id"]');

    city.addEventListener('change', validateCity);

    function validateCity() {

        if (city.value === '') {

            setError(city, 'Kota wajib dipilih');
            return false;
        }

        clearError(city);

        return true;
    }

    // ========================
    // ALAMAT
    // ========================

    const address =
        document.querySelector('[name="address"]');

    address.addEventListener('input', validateAddress);

    function validateAddress() {

        if (address.value.trim() === '') {

            setError(
                address,
                'Alamat wajib diisi'
            );

            return false;
        }

        clearError(address);

        return true;
    }

    // ========================
    // PASSWORD
    // ========================

    const password =
        document.querySelector('[name="password"]');

    password.addEventListener('input', validatePassword);

    function validatePassword() {

        if (password.value === '') {

            setError(
                password,
                'Password wajib diisi'
            );

            return false;
        }

        if (password.value.length < 6) {

            setError(
                password,
                'Password minimal 6 karakter'
            );

            return false;
        }

        clearError(password);

        return true;
    }

    // ========================
    // CONFIRM PASSWORD
    // ========================

    const confirmPassword =
        document.querySelector(
            '[name="password_confirmation"]'
        );

    confirmPassword.addEventListener(
        'input',
        validateConfirmPassword
    );

    function validateConfirmPassword() {

        if (confirmPassword.value === '') {

            setError(
                confirmPassword,
                'Konfirmasi password wajib diisi'
            );

            return false;
        }

        if (
            password.value !==
            confirmPassword.value
        ) {

            setError(
                confirmPassword,
                'Konfirmasi password tidak cocok'
            );

            return false;
        }

        clearError(confirmPassword);

        return true;
    }

    // ========================
    // SUBMIT
    // ========================

    form.addEventListener('submit', function (e) {

        const valid =
            validateNik() &&
            validateName() &&
            validateEmail() &&
            validatePhone() &&
            validateGender() &&
            validateBirthDate() &&
            validateCity() &&
            validateAddress() &&
            validatePassword() &&
            validateConfirmPassword();

        if (!valid) {

            e.preventDefault();

        }

    });

});

</script>

@endpush

@endsection