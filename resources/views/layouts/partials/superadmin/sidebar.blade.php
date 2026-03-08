<!-- SIDEBAR -->
<aside class="w-64 bg-[#4C9A8B] text-white flex flex-col">

    <!-- LOGO -->
    <div class="px-6 py-6 flex items-center gap-3">

        <!-- LOGO ICON -->
        <svg class="w-10 h-10 text-white opacity-90" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 12c4-8 12-8 16 0M4 18c4-8 12-8 16 0M4 6c4-8 12-8 16 0"/>
        </svg>

        <!-- TEXT -->
        <span class="text-2xl font-semibold tracking-wide">
            Pijat.in
        </span>

    </div>


    <!-- CABANG -->
    <div class="px-6 py-4 text-sm text-white/80 flex items-center justify-between cursor-pointer">

        Seluruh Cabang

        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7"/>
        </svg>

    </div>


    <!-- MENU -->
    <nav class="flex-1 px-3 py-4 space-y-1 text-[15px]">

        <!-- Dashboard -->
        <a href="{{ route('superadmin.dashboard') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">

            <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 13h8V3H3v10zM13 21h8V11h-8v10zM13 3v6h8V3h-8zM3 21v-6h8v6H3z"/>
            </svg>

            Dashboard

        </a>


        <!-- Layanan (ACTIVE) -->
        <a href="#"
        class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white text-[#3E7F73] font-medium">

            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12l4-2 4 2V7a2 2 0 00-2-2H9z"/>
            </svg>

            Layanan

        </a>


        <!-- Pesanan -->
        <a href="#"
        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">

            <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12h6m-6 4h6M9 8h6M5 3h14a2 2 0 012 2v14l-4-2-4 2-4-2-4 2V5a2 2 0 012-2z"/>
            </svg>

            Pesanan

        </a>


        <!-- Cabang -->
        <a href="#"
        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">

            <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"/>
            </svg>

            Cabang

        </a>


        <!-- Karyawan -->
        <a href="#"
        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">

            <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 20h5V4H2v16h5M12 12a4 4 0 100-8 4 4 0 000 8zm0 0v8"/>
            </svg>

            Karyawan

        </a>


        <!-- Landing Page -->
        <a href="/"
        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">

            <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 5h18M3 12h18M3 19h18"/>
            </svg>

            Landing Page

        </a>


        <!-- Pengguna -->
        <a href="#"
        class="flex items-center justify-between px-4 py-3 rounded-lg hover:bg-white/10 transition">

            <span class="flex items-center gap-3">

                <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 20h5V4H2v16h5"/>
                </svg>

                Pengguna

            </span>

            <span class="text-xs opacity-70">▾</span>

        </a>


        <!-- Penangguhan -->
        <a href="#"
        class="flex items-center justify-between px-4 py-3 rounded-lg hover:bg-white/10 transition">

            <span class="flex items-center gap-3">

                <svg class="w-5 h-5 opacity-90" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01M5.93 19h12.14c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L4.2 16c-.77 1.33.19 3 1.73 3z"/>
                </svg>

                Penangguhan

            </span>

            <span class="text-xs opacity-70">▾</span>

        </a>

    </nav>


</aside>
