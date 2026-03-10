@extends('layouts.auth')

@section('title', 'Email Verification')

@section('body-class', 'bg-gray-100 flex items-center justify-center min-h-screen')

@section('content')

<div class="w-[420px] bg-white rounded-2xl shadow-xl p-10 text-center">

    <!-- HEADER -->
    <div class="mb-8">

        <div class="flex justify-center mb-4">

            <div class="w-14 h-14 bg-teal-100 text-teal-600 rounded-full flex items-center justify-center text-xl font-bold">
                ✉
            </div>

        </div>

        <h1 class="text-xl font-semibold text-gray-800">
            Verifikasi Email
        </h1>

        <p class="text-gray-500 text-sm mt-2">
            Masukkan kode OTP yang telah dikirim ke email kamu
        </p>

    </div>


    <form method="POST" action="{{ route('verify.process') }}">

        @csrf

        <!-- OTP INPUT -->
        <div class="flex justify-center gap-3 mb-6">

            <input class="otp-input" maxlength="1">
            <input class="otp-input" maxlength="1">
            <input class="otp-input" maxlength="1">
            <input class="otp-input" maxlength="1">
            <input class="otp-input" maxlength="1">
            <input class="otp-input" maxlength="1">

        </div>

        <input type="hidden" name="otp" id="otp">


        <button
            class="w-full bg-teal-600 hover:bg-teal-700 transition text-white py-3 rounded-xl font-medium">

            Verifikasi

        </button>

    </form>

    <p class="text-xs text-gray-400 mt-6">
        Tidak menerima kode? cek folder spam email kamu
    </p>

</div>

@endsection


@push('scripts')

<script>

const inputs = document.querySelectorAll(".otp-input");

inputs.forEach((input, index) => {

    input.classList.add(
        "w-12",
        "h-12",
        "border",
        "rounded-lg",
        "text-center",
        "text-lg",
        "font-semibold",
        "focus:outline-none",
        "focus:ring-2",
        "focus:ring-teal-500"
    );

    input.addEventListener("input", (e) => {

        e.target.value = e.target.value.replace(/[^0-9]/g, '');

        if (e.target.value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }

    });

    input.addEventListener("keydown", (e) => {

        if (e.key === "Backspace" && !input.value && index > 0) {
            inputs[index - 1].focus();
        }

    });

});

document.querySelector("form").addEventListener("submit", function () {

    let otp = "";

    inputs.forEach(input => {
        otp += input.value;
    });

    document.getElementById("otp").value = otp;

});

inputs[0].focus();

document.addEventListener("paste", function(e){

    const paste = e.clipboardData.getData("text").trim();

    if(paste.length === 6){

        inputs.forEach((input, i) => {
            input.value = paste[i];
        });

    }

});

</script>

@endpush