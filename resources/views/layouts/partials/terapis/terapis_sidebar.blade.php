<aside class="w-64 bg-gradient-to-b from-teal-700 to-teal-900 text-white flex flex-col min-h-screen shadow-lg">

    <!-- LOGO -->
    <div class="px-6 py-7 flex items-center gap-3 border-b border-white/10">
        <img
            src="{{ asset('images/logo-pth.png') }}"
            alt="Logo Pijat.in"
            class="w-10 h-10 object-contain"
        >

        <span class="text-xl font-semibold tracking-wide">
            Pijat.in
        </span>

    </div>

    <nav class="flex-1 p-4 space-y-2">

        <a href="{{ route('terapis.dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-teal-700">

            Dashboard

        </a>

        <a href="{{ route('terapis.pesanan') }}"
           class="block px-4 py-2 rounded hover:bg-teal-700">

            Pesanan

        </a>
        <a href="{{ route('terapis.pesanan.saya') }}"
        class="block px-4 py-2 rounded hover:bg-teal-700">
            Pesanan Saya
        </a>

    </nav>

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