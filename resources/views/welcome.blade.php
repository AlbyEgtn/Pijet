<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pijat.in</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;400;500&display=swap"
        rel="stylesheet"
    >

    <style>

        body {
            font-family: 'Poppins', sans-serif;
        }

        .heading {
            font-family: 'Playfair Display', serif;
        }

        .hero-overlay {
            background: linear-gradient(
                90deg,
                rgba(0,40,30,0.85) 0%,
                rgba(0,40,30,0.55) 40%,
                rgba(0,0,0,0.1) 80%
            );
        }

        .container-custom {
            max-width: 1200px;
            margin: auto;
        }

    </style>

</head>

<body class="bg-white antialiased">


<!-- HERO SECTION -->
<section
    class="relative h-screen bg-cover bg-center"
    style="background-image:url('{{ asset('images/'.$page->hero_image) }}')"
>

    <div class="hero-overlay absolute inset-0"></div>


    <!-- NAVBAR -->
    <nav class="absolute w-full z-20">

        <div class="max-w-7xl mx-auto flex items-center justify-between px-10 py-6 text-white">

            <div class="flex items-center gap-3">

                <img
                    src="{{ asset('images/logo-pth.png') }}"
                    alt="Pijat.in Logo"
                    class="h-10 w-auto"
                >

                <span class="font-semibold text-xl tracking-tight">
                    Pijat.in
                </span>

            </div>


            <div class="hidden md:flex gap-8 text-sm font-medium">

                <a href="#about" class="hover:text-emerald-400 transition">
                    Tentang Kami
                </a>

                <a href="#services" class="hover:text-emerald-400 transition">
                    Layanan
                </a>

                <a href="#benefit" class="hover:text-emerald-400 transition">
                    FAQ
                </a>

            </div>


            <div class="flex items-center gap-4">

                <a
                    href="{{ $page->app_button_link }}"
                    class="bg-white/20 backdrop-blur-md hover:bg-white/30 border border-white/30 transition px-5 py-2 rounded-lg text-sm font-medium"
                >
                    {{ $page->app_button_text }}
                </a>

                <a href="{{ route('login') }}">

                    <button
                        class="bg-emerald-400 hover:bg-emerald-500 transition px-5 py-2 rounded-lg text-sm font-medium shadow-lg"
                    >
                        Login
                    </button>

                </a>

            </div>

        </div>

    </nav>


    <!-- HERO CONTENT -->
    <div class="relative z-10 flex flex-col items-center justify-center text-center h-full text-white px-6">

        <h1 class="heading text-4xl md:text-5xl max-w-3xl leading-tight mb-6">
            {{ $page->hero_title }}
        </h1>

        <p class="max-w-2xl mb-8 opacity-90 text-lg leading-relaxed">
            {{ $page->hero_subtitle }}
        </p>


        <div class="flex flex-wrap justify-center gap-4">

            <a
                href="{{ $page->hero_button_link }}"
                class="border-2 border-white hover:bg-white hover:text-emerald-900 transition px-8 py-3 rounded-lg font-medium"
            >
                {{ $page->hero_button_text }}
            </a>


            <a
                href="{{ $page->app_button_link }}"
                class="bg-emerald-400 hover:bg-emerald-500 transition px-8 py-3 rounded-lg font-medium shadow-xl"
            >
                {{ $page->app_button_text }}
            </a>

        </div>

    </div>

</section>

{{-- about --}}
<section id="about" class="relative bg-[#E7F3EF] py-24 px-6 overflow-hidden">

    {{-- LEAF DECORATION TOP RIGHT --}}
    <div class="absolute top-10 right-10 opacity-20 pointer-events-none">
        <svg width="180" height="180" viewBox="0 0 200 200" fill="none">
            <path d="M100 10C140 40 170 80 160 120C150 160 110 190 70 170C30 150 20 110 40 70C60 30 80 20 100 10Z"
                fill="#10B981"/>
            <path d="M100 20C110 60 110 100 100 150" stroke="#059669" stroke-width="4"/>
        </svg>
    </div>

    {{-- LEAF DECORATION BOTTOM LEFT --}}
    <div class="absolute bottom-10 left-10 opacity-15 pointer-events-none">
        <svg width="160" height="160" viewBox="0 0 200 200" fill="none">
            <path d="M20 120C60 60 120 20 170 40C200 70 180 120 140 150C100 180 50 170 30 150C10 130 10 130 20 120Z"
                fill="#34D399"/>
            <path d="M60 140C80 110 110 90 150 60" stroke="#059669" stroke-width="3"/>
        </svg>
    </div>


    <div class="container-custom grid lg:grid-cols-2 gap-16 items-center relative z-10">

        {{-- TEXT --}}
        <div class="space-y-8">

            <h2 class="text-4xl font-bold text-emerald-600">
                {{ $page->about_title }}
            </h2>

            <p class="text-gray-600 text-lg leading-relaxed">
                {{ $page->about_description }}
            </p>

            {{-- STATISTICS --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                @foreach($statistics as $stat)

                    <div class="bg-white p-6 rounded-xl shadow-sm text-center">

                        <p class="text-3xl font-bold text-emerald-700">
                            {{ $stat->value }}
                        </p>

                        <p class="text-xs text-gray-500 uppercase tracking-widest mt-2">
                            {{ $stat->title }}
                        </p>

                    </div>

                @endforeach

            </div>

        </div>


        {{-- IMAGE --}}
        <div class="flex justify-center">

            <img
                src="{{ asset('images/'.$page->about_image) }}"
                class="rounded-2xl shadow-xl w-full max-w-lg object-cover"
            >

        </div>

    </div>

</section>

<!-- SERVICES -->
<section id="services" class="relative bg-[#BFE3DB] py-28 px-6 overflow-hidden">

    <!-- DECORATION LEAF LEFT -->
    <div class="absolute -left-20 top-20 opacity-20 pointer-events-none">
        <svg width="300" height="300" viewBox="0 0 200 200" fill="none">
            <path d="M20 150C40 40 160 20 180 140C120 160 60 180 20 150Z"
                fill="#2F8F7B"/>
        </svg>
    </div>

    <!-- DECORATION LEAF RIGHT -->
    <div class="absolute -right-20 bottom-10 opacity-20 pointer-events-none">
        <svg width="320" height="320" viewBox="0 0 200 200" fill="none">
            <path d="M180 50C160 160 40 180 20 60C80 30 120 10 180 50Z"
                fill="#2F8F7B"/>
        </svg>
    </div>


    <!-- TITLE -->
    <div class="container-custom text-center mb-20 relative z-10">

        <h2 class="text-4xl md:text-5xl font-bold text-emerald-700 mb-5">
            {{ $page->service_title }}
        </h2>

        <p class="text-gray-700 max-w-2xl mx-auto text-lg leading-relaxed">
            {{ $page->service_description }}
        </p>

    </div>


    <!-- SERVICES GRID -->
    <div class="container-custom grid md:grid-cols-2 lg:grid-cols-3 gap-12 relative z-10">

        @foreach($services as $service)

        <div class="group bg-white rounded-2xl shadow-lg overflow-hidden
                    hover:-translate-y-3 transition duration-300">

            <!-- IMAGE -->
            <div class="overflow-hidden">
                <img
                    src="{{ asset('storage/'.$service->image) }}"
                    alt="{{ $service->name }}"
                    class="w-full h-60 object-cover group-hover:scale-110 transition duration-500"
                >
            </div>

            <!-- CONTENT -->
            <div class="p-6 text-center">

                <h3 class="text-xl font-bold text-emerald-600 mb-3">
                    {{ $service->name }}
                </h3>

                <p class="text-gray-600 text-sm leading-relaxed">
                    {{ $service->description }}
                </p>

            </div>

        </div>

        @endforeach

    </div>

</section>


<!-- BENEFITS -->
<section id="benefit" class="bg-[#E7F3EF] py-24 px-6">

    <div class="container-custom">

        <div class="text-center mb-16">

            <h2 class="text-4xl text-emerald-700 mb-4">
                {{ $page->therapist_title }}
            </h2>

            <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                {{ $page->therapist_description }}
            </p>

        </div>


        <div class="grid md:grid-cols-3 gap-8">

            @foreach($benefits as $benefit)

            <div class="bg-white rounded-2xl shadow-lg p-10 text-center">

                @if($benefit->icon)
                    <img src="{{ asset('images/'.$benefit->icon) }}"
                        class="w-14 h-14 mx-auto mb-4">
                @endif

                <h3 class="text-emerald-700 font-bold text-xl mb-3">
                    {{ $benefit->title }}
                </h3>

                <p class="text-sm text-gray-600 leading-relaxed">
                    {{ $benefit->description }}
                </p>

            </div>

            @endforeach

        </div>

    </div>
    

</section>

{{-- ================= JOIN THERAPIST ================= --}}
<section class="relative py-28 bg-linear-to-r from-teal-50 to-emerald-50 overflow-hidden">

    {{-- SOFT BACKGROUND SHAPES --}}
    <div class="absolute -top-32 -left-32 w-100 h-100 bg-emerald-200 rounded-full blur-3xl opacity-40"></div>
    <div class="absolute -bottom-32 -right-32 w-100 h-100 bg-teal-200 rounded-full blur-3xl opacity-40"></div>

    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center">

        {{-- IMAGE --}}
        <div class="relative flex justify-center">

            <div class="absolute -z-10 w-[90%] h-[90%] bg-emerald-200 rounded-3xl blur-2xl opacity-50"></div>

            <img
                src="{{ asset('images/'.$page->join_image) }}"
                class="relative rounded-3xl shadow-2xl object-cover w-full max-w-md h-105 transition duration-500 hover:scale-105"
            >

        </div>


        {{-- TEXT --}}
        <div class="max-w-xl">

            <h2 class="text-4xl lg:text-5xl font-bold text-teal-800 leading-tight mb-6">
                {{ $page->join_title }}
            </h2>

            <p class="text-gray-600 leading-relaxed text-lg mb-10">
                {{ $page->join_description }}
            </p>

            <a
                href="#"
                class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-4 rounded-xl shadow-lg transition duration-300"
            >
                Selengkapnya →
            </a>

        </div>

    </div>

</section>



{{-- ================= DOWNLOAD APP ================= --}}
<section class="relative py-28 bg-white overflow-hidden">

    {{-- BACKGROUND SHAPES --}}
    <div class="absolute -top-40 -right-32 w-105 h-105 bg-emerald-100 rounded-full blur-3xl opacity-40"></div>
    <div class="absolute -bottom-40 -left-32 w-105 h-105 bg-teal-100 rounded-full blur-3xl opacity-40"></div>

    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center">

        {{-- TEXT --}}
        <div class="max-w-xl">

            <h2 class="text-4xl lg:text-5xl font-bold text-teal-800 leading-tight mb-6">
                {{ $page->download_title }}
            </h2>

            <p class="text-gray-600 text-lg leading-relaxed mb-10">
                {{ $page->download_description }}
            </p>

            <div class="flex gap-4 flex-wrap">

                <a
                    href="#"
                    class="flex items-center gap-2 bg-black hover:bg-gray-900 text-white px-6 py-3 rounded-xl shadow transition"
                >
                     App Store
                </a>

                <a
                    href="#"
                    class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl shadow transition"
                >
                    ▶ Play Store
                </a>

            </div>

        </div>


        {{-- IMAGE --}}
        <div class="flex justify-center">

            <img
                src="{{ asset('images/'.$page->download_image) }}"
                class="w-full max-w-md rounded-3xl shadow-2xl transition duration-500 hover:scale-105"
            >

        </div>

    </div>

</section>




<!-- FOOTER -->
<footer class="bg-emerald-900 text-white py-20 px-6">

    <div class="container-custom grid md:grid-cols-4 gap-12">

        <div>

            <h3 class="font-bold text-2xl">
                Pijat.in
            </h3>

            <p class="text-sm opacity-70 mt-4">
                Platform layanan pijat profesional yang menghubungkan pelanggan dengan terapis terpercaya.
            </p>

        </div>


        <div>

            <h4 class="font-semibold text-lg mb-6">
                Hubungi Kami
            </h4>

            <ul class="text-sm opacity-80 space-y-3">

                <li>📍 Yogyakarta, Indonesia</li>
                <li>📞 +62 812 3456 7890</li>
                <li>✉️ info@pijat.in</li>

            </ul>

        </div>


        <div>

            <h4 class="font-semibold text-lg mb-6">
                Eksplorasi
            </h4>

            <ul class="text-sm opacity-80 space-y-3">

                <li>Tentang Kami</li>
                <li>Layanan</li>
                <li>FAQ</li>

            </ul>

        </div>

    </div>


    <div class="container-custom text-center text-xs opacity-40 mt-16 pt-8 border-t border-emerald-800">

        Copyright © {{ date('Y') }} Pijat.in

    </div>

</footer>


</body>
</html>