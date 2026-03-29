<aside class="w-64 bg-[#4C9A8B] text-white flex flex-col min-h-screen">

    <!-- LOGO -->
    <div class="px-6 py-7 flex items-center gap-3">
        <img
            src="{{ asset('images/logo-pth.png') }}"
            alt="Logo Pijat.in"
            class="h-12 object-contain"
        >

        <span class="text-2xl font-semibold tracking-wide">
            Pijat.in
        </span>

    </div>


    <!-- CABANG SELECT -->
    <div class="px-6 py-4 text-sm text-white/80 flex items-center justify-between cursor-pointer">

        Seluruh Cabang

        <svg
            class="w-4 h-4 opacity-70"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7"
            />

        </svg>

    </div>


    <!-- MENU -->
    <nav class="flex-1 px-3 py-4 space-y-1 text-[15px]">


        <!-- Dashboard -->
        <a
            href="{{ route('superadmin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition
            {{ request()->routeIs('superadmin.dashboard')
                ? 'bg-white text-[#3E7F73] font-medium shadow-sm'
                : 'hover:bg-white/10 text-white' }}"
        >

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 13h8V3H3v10zM13 21h8V11h-8v10zM13 3v6h8V3h-8zM3 21v-6h8v6H3z"
                />

            </svg>

            Dashboard

        </a>


        <!-- Layanan -->
        <a
            href="{{ route('superadmin.services') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition
            {{ request()->routeIs('superadmin.services*')
                ? 'bg-white text-[#3E7F73] font-medium shadow-sm'
                : 'hover:bg-white/10 text-white' }}"
        >

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12l4-2 4 2V7a2 2 0 00-2-2H9z"
                />

            </svg>

            Layanan

        </a>


        <!-- Pesanan -->
        <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition"
        >

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12h6m-6 4h6M9 8h6M5 3h14a2 2 0 012 2v14l-4-2-4 2-4-2-4 2V5a2 2 0 012-2z"
                />

            </svg>

            Pesanan

        </a>


        <!-- Cabang -->
        <a
            href="{{ route('superadmin.cabang.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition
            {{ request()->routeIs('superadmin.cabang*')
                ? 'bg-white text-[#3E7F73] font-medium shadow-sm'
                : 'hover:bg-white/10 text-white' }}"
        >

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"
                />

            </svg>

            Cabang

        </a>


        <!-- Karyawan -->
        <a
            href="#"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition"
        >

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 20h5V4H2v16h5M12 12a4 4 0 100-8 4 4 0 000 8zm0 0v8"
                />

            </svg>

            Karyawan

        </a>


        <!-- Landing Page -->
        <a
            href="{{ route('superadmin.landing') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition
            {{ request()->routeIs('superadmin.landing*')
                ? 'bg-white text-[#3E7F73] font-medium shadow-sm'
                : 'hover:bg-white/10 text-white' }}"
        >

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 5h18M3 12h18M3 19h18"
                />

            </svg>

            Landing Page

        </a>


    </nav>


    <!-- LOGOUT -->
    <div class="px-4 pb-6">

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button
                class="flex items-center gap-3 px-4 py-3 rounded-lg w-full hover:bg-white/10"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7"
                    />

                </svg>

                Keluar Akun

            </button>

        </form>

    </div>

</aside>
