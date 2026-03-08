<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pijat.in</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .heading {
            font-family: 'Playfair Display', serif;
        }

        .hero-overlay {
            background: linear-gradient(90deg,
                    rgba(0, 40, 30, 0.85) 0%,
                    rgba(0, 40, 30, 0.55) 40%,
                    rgba(0, 0, 0, 0.1) 80%);
        }

        .container-custom {
            max-width: 1200px;
            margin: auto;
        }
    </style>
</head>

<body class="bg-white antialiased">

    <section class="relative h-screen bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=1920&q=80&auto=format')">
        <div class="hero-overlay absolute inset-0"></div>

        <nav class="absolute w-full z-20">
            <div class="max-w-7xl mx-auto flex items-center justify-between px-10 py-6 text-white">

                <!-- LOGO -->
                <div class="font-semibold text-xl tracking-tight">
                    Pijat.in
                </div>

                <!-- MENU -->
                <div class="hidden md:flex gap-8 text-sm font-medium">
                    <a href="#" class="hover:text-emerald-400 transition">Tentang Kami</a>
                    <a href="#" class="hover:text-emerald-400 transition">Layanan</a>
                    <a href="#" class="hover:text-emerald-400 transition">FAQ</a>
                </div>

                <!-- ACTION BUTTON -->
                <div class="flex items-center gap-4">

                    <button
                        class="bg-white/20 backdrop-blur-md hover:bg-white/30 border border-white/30 
                            transition px-5 py-2 rounded-lg text-sm font-medium">
                        Download App
                    </button>

                    <a href="{{ route('login') }}">
                        <button
                            class="bg-emerald-400 hover:bg-emerald-500 transition px-5 py-2 rounded-lg text-sm font-medium shadow-lg">
                            Login
                        </button>
                    </a>

                </div>

            </div>
        </nav>

        <div class="relative z-10 flex flex-col items-center justify-center text-center h-full text-white px-6">
            <h1 class="heading text-4xl md:text-5xl max-w-3xl leading-tight mb-6">
                Bergabung menjadi mitra kami dan dapatkan penghasilan dari menyembuhkan orang.
            </h1>
            <p class="max-w-2xl mb-8 opacity-90 text-lg leading-relaxed">
                Pijat.in mengingatkan agar selalu menjaga kesehatan pada tubuh kita sendiri dengan cara yang sangat mudah, yaitu dengan metode Massage, Spa & Pijat.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <button class="border-2 border-white hover:bg-white hover:text-emerald-900 transition px-8 py-3 rounded-lg font-medium">
                    Gabung Terapis
                </button>
                <button class="bg-emerald-400 hover:bg-emerald-500 transition px-8 py-3 rounded-lg font-medium shadow-xl">
                    Download Aplikasi
                </button>
            </div>
        </div>
    </section>

    <section class="bg-[#E7F3EF] py-24 px-6">
        <div class="container-custom grid md:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="heading text-4xl text-emerald-600 mb-6">
                    Kenapa harus Pijat.in?
                </h2>
                <p class="text-gray-600 mb-10 leading-relaxed text-lg">
                    Selamat datang di Pijat.in sebagai kebanggaan nasional dengan pusat operasi utama di Yogyakarta. Kami memiliki satu tujuan yaitu memberikan pengalaman pijat yang luar biasa.
                </p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center mb-10">
                    <div class="bg-white p-4 rounded-xl shadow-sm">
                        <p class="text-3xl font-bold text-emerald-700">200+</p>
                        <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Customer</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm">
                        <p class="text-3xl font-bold text-emerald-700">82</p>
                        <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Terapis</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm">
                        <p class="text-3xl font-bold text-emerald-700">6</p>
                        <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Layanan</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm">
                        <p class="text-3xl font-bold text-emerald-700">95%</p>
                        <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Kepuasan</p>
                    </div>
                </div>

                <button class="bg-emerald-500 hover:bg-emerald-600 transition text-white px-8 py-4 rounded-lg shadow-lg font-medium">
                    Download Aplikasi Sekarang
                </button>
            </div>

            <div class="relative group">
                <div class="absolute -inset-4 bg-emerald-200/50 rounded-2xl blur-lg group-hover:bg-emerald-300/50 transition"></div>
                <img loading="lazy" src="https://images.unsplash.com/photo-1552693673-1bf958298935?w=700&q=80&auto=format" class="relative rounded-2xl shadow-2xl transform transition group-hover:scale-[1.01]" alt="Pijat Pelayanan">
            </div>
        </div>
    </section>

    <section class="bg-[#BFE3DB] py-24 px-6">
        <div class="container-custom text-center mb-16">
            <h2 class="heading text-4xl text-emerald-700 mb-4">Layanan Kami</h2>
            <p class="text-gray-700 max-w-xl mx-auto text-lg leading-relaxed">
                Kami berkomitmen memberikan layanan pijat terpercaya dan memberdayakan UMKM lokal.
            </p>
        </div>

        <div class="container-custom grid md:grid-cols-3 gap-10">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:-translate-y-3 transition duration-300">
                <div class="overflow-hidden">
                    <img loading="lazy" src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=600&q=80&auto=format" class="w-full h-56 object-cover group-hover:scale-110 transition duration-500" alt="Full Body Massage">
                </div>
                <div class="p-6">
                    <h3 class="text-emerald-600 text-xl font-bold mb-3">Full Body Massage</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Relaxing massage untuk mengurangi stres dan meningkatkan sirkulasi darah ke seluruh tubuh.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:-translate-y-3 transition duration-300">
                <div class="overflow-hidden">
                    <img loading="lazy" src="https://images.unsplash.com/photo-1600334089648-b0d9d3028eb2?w=600&q=80&auto=format" class="w-full h-56 object-cover group-hover:scale-110 transition duration-500" alt="Hot Stone Massage">
                </div>
                <div class="p-6">
                    <h3 class="text-emerald-600 text-xl font-bold mb-3">Hot Stone Massage</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Massage menggunakan batu panas alami untuk merelaksasi otot yang tegang dan kaku.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:-translate-y-3 transition duration-300">
                <div class="overflow-hidden">
                    <img loading="lazy" src="https://images.unsplash.com/photo-1519823551278-64ac92734fb1?w=600&q=80&auto=format" class="w-full h-56 object-cover group-hover:scale-110 transition duration-500" alt="Thai Massage">
                </div>
                <div class="p-6">
                    <h3 class="text-emerald-600 text-xl font-bold mb-3">Thai Massage</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Teknik peregangan khas Thailand yang fokus pada kelenturan dan kesehatan tubuh.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:-translate-y-3 transition duration-300">
                <div class="overflow-hidden">
                    <img loading="lazy" src="https://images.unsplash.com/photo-1556228720-195a672e8a03?w=600&q=80&auto=format" class="w-full h-56 object-cover group-hover:scale-110 transition duration-500" alt="Deep Tissue Massage">
                </div>
                <div class="p-6">
                    <h3 class="text-emerald-600 text-xl font-bold mb-3">Deep Tissue Massage</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Massage dengan tekanan dalam yang fokus pada lapisan jaringan otot yang lebih dalam.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:-translate-y-3 transition duration-300">
                <div class="overflow-hidden">
                    <img loading="lazy" src="https://images.unsplash.com/photo-1596178065887-1198b6148b2b?w=600&q=80&auto=format" class="w-full h-56 object-cover group-hover:scale-110 transition duration-500" alt="Swedish Massage">
                </div>
                <div class="p-6">
                    <h3 class="text-emerald-600 text-xl font-bold mb-3">Swedish Massage</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Massage lembut dan ritmik untuk meningkatkan sirkulasi darah serta relaksasi pikiran.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:-translate-y-3 transition duration-300">
                <div class="overflow-hidden">
                    <img loading="lazy" src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=600&q=80&auto=format" class="w-full h-56 object-cover group-hover:scale-110 transition duration-500" alt="Traditional Massage">
                </div>
                <div class="p-6">
                    <h3 class="text-emerald-600 text-xl font-bold mb-3">Traditional Massage</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Massage tradisional warisan budaya untuk memulihkan kebugaran dan relaksasi tubuh.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#E7F3EF] py-24 px-6">
        <div class="container-custom">
            <div class="text-center mb-16">
                <h2 class="heading text-4xl text-emerald-700 mb-4">
                    Kenapa Gabung Jadi Terapis?
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg leading-relaxed">
                    Bergabunglah dengan <span class="font-semibold text-emerald-600">Pijat.in</span> dan rasakan berbagai keuntungan sebagai terapis profesional dalam ekosistem wellness terpercaya.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg p-10 text-center hover:-translate-y-2 transition duration-300 group">
                    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-emerald-50 group-hover:bg-emerald-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5 s8.268 2.943 9.542 7 c-1.274 4.057-5.065 7-9.542 7 s-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="text-emerald-700 font-bold text-xl mb-3">Penghasilan Fleksibel</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Atur jadwal kerja sendiri dan dapatkan penghasilan tambahan dari layanan pijat profesional sesuai ketersediaan waktu Anda.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-10 text-center hover:-translate-y-2 transition duration-300 group">
                    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-emerald-50 group-hover:bg-emerald-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20h6M12 16v4" />
                        </svg>
                    </div>
                    <h3 class="text-emerald-700 font-bold text-xl mb-3">Platform Profesional</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Bekerja dalam ekosistem digital yang memudahkan manajemen pemesanan, konfirmasi pembayaran, dan riwayat layanan.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-10 text-center hover:-translate-y-2 transition duration-300 group">
                    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-emerald-50 group-hover:bg-emerald-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0121 17.5 M12 14L5.84 10.578A12.083 12.083 0 003 17.5" />
                        </svg>
                    </div>
                    <h3 class="text-emerald-700 font-bold text-xl mb-3">Pelatihan & Pengembangan</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Kami menyediakan pelatihan berkala untuk meningkatkan teknik pijat, etika pelayanan, dan profesionalitas Anda.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-10 text-center hover:-translate-y-2 transition duration-300 group">
                    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-emerald-50 group-hover:bg-emerald-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-emerald-700 font-bold text-xl mb-3">Keamanan Terjamin</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Sistem verifikasi dua arah dan dukungan bantuan darurat memberikan rasa aman bagi terapis selama bertugas.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-10 text-center hover:-translate-y-2 transition duration-300 group">
                    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-emerald-50 group-hover:bg-emerald-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11c1.657 0 3-1.343 3-3 s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11c1.657 0 3-1.343 3-3 S9.657 5 8 5 5 6.343 5 8 s1.343 3 3 3z" />
                        </svg>
                    </div>
                    <h3 class="text-emerald-700 font-bold text-xl mb-3">Jangkauan Luas</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Akses ke ribuan pelanggan aktif setiap harinya tanpa perlu repot melakukan pemasaran mandiri.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-10 text-center hover:-translate-y-2 transition duration-300 group">
                    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-emerald-50 group-hover:bg-emerald-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5" />
                        </svg>
                    </div>
                    <h3 class="text-emerald-700 font-bold text-xl mb-3">Proses Mudah</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Pendaftaran cepat, seleksi transparan, dan sistem *onboarding* yang membantu Anda mulai bekerja segera.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="relative bg-[#E7F3EF] py-32 overflow-hidden">

        <!-- BACKGROUND CURVE -->
        <svg class="absolute top-0 right-0 w-[900px] h-auto z-0"
            viewBox="0 0 900 600"
            xmlns="http://www.w3.org/2000/svg">

            <path
                fill="#BFE3DB"
                d="M900 0H350C420 180 680 200 900 350V0Z"/>
        </svg>

        <!-- DECORATIVE CIRCLE -->
        <div class="absolute right-10 bottom-10 w-[420px] h-[420px] bg-[#1F6F64]/10 rounded-full blur-3xl z-0"></div>


        <div class="container-custom relative z-10 px-6 space-y-32">


            <!-- ================= JOIN TERAPIS ================= -->

            <div class="grid md:grid-cols-2 gap-16 items-center">

                <!-- IMAGE -->
                <div class="flex justify-center">

                    <div class="relative">

                        <div class="absolute inset-0 bg-emerald-200 rounded-full translate-x-4 translate-y-4"></div>

                        <img
                            loading="lazy"
                            src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=600&q=80&auto=format"
                            class="relative w-[300px] h-[300px] object-cover rounded-full border-10 border-white shadow-2xl"
                            alt="Terapis">

                        <div class="absolute bottom-3 right-3 w-12 h-12 bg-emerald-500 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                            ✓
                        </div>

                    </div>

                </div>


                <!-- TEXT -->
                <div class="text-center md:text-left">

                    <h2 class="heading text-4xl md:text-5xl text-[#1F6F64] mb-6 leading-tight">
                        Jadilah bagian dari tim <br class="hidden md:block">
                        terapis profesional kami
                    </h2>

                    <p class="text-gray-600 text-lg leading-relaxed mb-8 max-w-xl mx-auto md:mx-0">
                        Bergabunglah dengan
                        <strong class="text-emerald-700">Pijat.in</strong>
                        dan nikmati kesempatan untuk memberikan ketenangan
                        serta kesejahteraan kepada pelanggan kami.
                    </p>

                    <button class="bg-emerald-500 hover:bg-emerald-600 text-white px-10 py-4 rounded-xl shadow-lg transition">
                        Selengkapnya
                    </button>

                </div>

            </div>



            <!-- ================= DOWNLOAD APP ================= -->

            <div class="grid md:grid-cols-2 gap-16 items-center">

                <!-- TEXT -->
                <div class="text-center md:text-left">

                    <h2 class="heading text-4xl md:text-5xl text-[#1F6F64] mb-6 leading-tight">
                        Relaksasi dalam <br class="hidden md:block">
                        Genggaman Anda!
                    </h2>

                    <p class="text-gray-700 text-lg leading-relaxed mb-10 max-w-md mx-auto md:mx-0">
                        Download aplikasi
                        <strong class="text-emerald-700">Pijat.in</strong>
                        untuk akses cepat ke perawatan pijat berkualitas
                        dengan ribuan terapis terpercaya.
                    </p>

                    <div class="flex justify-center md:justify-start gap-4">

                        <img
                            loading="lazy"
                            src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                            class="h-12"
                            alt="App Store">

                        <img
                            loading="lazy"
                            src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                            class="h-12"
                            alt="Play Store">

                    </div>

                </div>


                <!-- PHONE -->
                <div class="flex justify-center">

                    <div class="relative">

                        <div class="absolute inset-0 bg-emerald-300/30 blur-3xl rounded-full"></div>

                        <img
                            loading="lazy"
                            src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=600&q=80&auto=format"
                            class="relative w-60 rounded-[2.5rem] shadow-2xl rotate-6 hover:rotate-0 transition duration-500"
                            alt="Mobile App">

                    </div>

                </div>

            </div>


        </div>

    </section>
    
    <footer class="bg-emerald-900 text-white py-20 px-6">
        <div class="container-custom grid md:grid-cols-4 gap-12">
            <div class="space-y-4">
                <h3 class="font-bold text-2xl tracking-tight">Pijat.in</h3>
                <p class="text-sm opacity-70 leading-relaxed">
                    Platform layanan pijat profesional yang menghubungkan pelanggan dengan terapis terpercaya di ujung jari Anda.
                </p>
            </div>

            <div>
                <h4 class="font-semibold text-lg mb-6 border-b border-emerald-700 pb-2 inline-block">Hubungi Kami</h4>
                <ul class="text-sm opacity-80 space-y-3">
                    <li class="flex items-center gap-2"><span>📍</span> Yogyakarta, Indonesia</li>
                    <li class="flex items-center gap-2"><span>📞</span> +62 812 3456 7890</li>
                    <li class="flex items-center gap-2"><span>✉️</span> info@pijat.in</li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-lg mb-6 border-b border-emerald-700 pb-2 inline-block">Eksplorasi</h4>
                <ul class="text-sm opacity-80 space-y-3">
                    <li><a href="#" class="hover:text-emerald-400 transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-emerald-400 transition">Layanan</a></li>
                    <li><a href="#" class="hover:text-emerald-400 transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-emerald-400 transition">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-lg mb-6 border-b border-emerald-700 pb-2 inline-block">Ikuti Kami</h4>
                <div class="flex gap-4">
                    <a href="#" class="p-2 bg-emerald-800 rounded-lg hover:bg-emerald-700 transition" aria-label="Instagram">
                        <span class="text-sm">Instagram</span>
                    </a>
                    <a href="#" class="p-2 bg-emerald-800 rounded-lg hover:bg-emerald-700 transition" aria-label="Facebook">
                        <span class="text-sm">Facebook</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="container-custom text-center text-xs opacity-40 mt-16 pt-8 border-t border-emerald-800">
            Copyright © 2026 Pijat.in. All Rights Reserved.
        </div>
    </footer>

</body>

</html>