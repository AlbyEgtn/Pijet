@extends('layouts.terapis')

@section('title', 'Bantuan')

@section('content')

<div class="max-w-4xl mx-auto mt-10 bg-white shadow rounded-xl p-8">

    <!-- HEADER -->
    <h2 class="text-2xl font-bold text-gray-700 mb-6 flex items-center gap-2">

        <a 
            href="{{ route('terapis.profile') }}"
            class="text-gray-600 hover:text-gray-800"
        >
            ←
        </a>

        Bantuan & Kontak

    </h2>


    <p class="text-gray-600 mb-8">
        Jika mengalami kendala saat menggunakan sistem, silakan hubungi kami melalui kontak berikut.
    </p>


    <!-- CONTACT LIST -->
    <div class="grid grid-cols-3 gap-6">

        <!-- WHATSAPP -->
        <a 
            href="https://wa.me/6281234567890"
            target="_blank"
            class="flex flex-col items-center justify-center bg-green-50 hover:bg-green-100 rounded-xl p-6 transition"
        >

            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="w-10 h-10 text-green-600 mb-2"
                 fill="currentColor"
                 viewBox="0 0 24 24">

                <path d="M20.52 3.48A11.87 11.87 0 0012.02 0C5.39 0 .03 5.36.03 12c0 2.11.55 4.18 1.59 6.01L0 24l6.18-1.6A11.94 11.94 0 0012.02 24c6.63 0 11.99-5.36 11.99-12 0-3.2-1.25-6.22-3.49-8.52zM12.02 21.8c-1.86 0-3.69-.5-5.29-1.45l-.38-.23-3.67.95.98-3.58-.25-.37a9.75 9.75 0 01-1.5-5.12c0-5.4 4.39-9.79 9.8-9.79 2.62 0 5.09 1.02 6.94 2.88a9.74 9.74 0 012.86 6.91c0 5.4-4.39 9.8-9.79 9.8zm5.39-7.32c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.47-2.4-1.5-.88-.78-1.47-1.75-1.64-2.05-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.57-.49-.49-.67-.5h-.57c-.2 0-.52.07-.8.37-.27.3-1.05 1.02-1.05 2.5s1.08 2.9 1.23 3.1c.15.2 2.12 3.24 5.14 4.54.72.31 1.28.49 1.72.63.72.23 1.38.2 1.9.12.58-.09 1.76-.72 2.01-1.42.25-.7.25-1.3.17-1.42-.07-.12-.27-.2-.57-.35z"/>

            </svg>

            <span class="font-medium text-gray-700">
                WhatsApp
            </span>

        </a>


        <!-- INSTAGRAM -->
        <a 
            href="https://instagram.com/"
            target="_blank"
            class="flex flex-col items-center justify-center bg-pink-50 hover:bg-pink-100 rounded-xl p-6 transition"
        >

            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="w-10 h-10 text-pink-600 mb-2"
                 fill="currentColor"
                 viewBox="0 0 24 24">

                <path d="M7.75 2C4.57 2 2 4.57 2 7.75v8.5C2 19.43 4.57 22 7.75 22h8.5C19.43 22 22 19.43 22 16.25v-8.5C22 4.57 19.43 2 16.25 2h-8.5zm4.25 5.5a4.5 4.5 0 110 9 4.5 4.5 0 010-9zm6-1.25a1.25 1.25 0 110 2.5 1.25 1.25 0 010-2.5z"/>

            </svg>

            <span class="font-medium text-gray-700">
                Instagram
            </span>

        </a>


        <!-- EMAIL -->
        <a 
            href="mailto:support@pijetin.com"
            class="flex flex-col items-center justify-center bg-blue-50 hover:bg-blue-100 rounded-xl p-6 transition"
        >

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-10 h-10 text-blue-600 mb-2"
                 fill="currentColor"
                 viewBox="0 0 24 24">

                <path d="M20 4H4C2.9 4 2 4.9 2 6v12c0 1.1.9 2 
                2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 
                4l-8 5-8-5V6l8 5 8-5v2z"/>

            </svg>

            <span class="font-medium text-gray-700">
                Email
            </span>

        </a>

    </div>

</div>

@endsection