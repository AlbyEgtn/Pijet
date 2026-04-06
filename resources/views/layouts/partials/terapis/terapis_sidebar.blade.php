<div class="h-full flex flex-col bg-teal-800 text-white">

    <!-- LOGO -->
    <div class="px-6 py-7 flex items-center gap-3 border-b border-white/10">
        <img
            src="{{ asset('images/logo-pth.png') }}"
            alt="Logo Pijat.in"
            class="h-10 object-contain"
        >

        <span class="text-xl font-semibold tracking-wide">
            Pijat.in
        </span>
    </div>

    <!-- MENU -->
    <nav class="flex-1 p-4 space-y-2 text-sm">

        <a href="{{ route('terapis.dashboard') }}"
           class="block px-4 py-2 rounded-lg hover:bg-teal-700 transition">
            Dashboard
        </a>

        <a href="{{ route('terapis.pesanan') }}"
           class="block px-4 py-2 rounded-lg hover:bg-teal-700 transition">
            Pesanan
        </a>

        <a href="{{ route('terapis.pesanan.saya') }}"
           class="block px-4 py-2 rounded-lg hover:bg-teal-700 transition">
            Pesanan Saya
        </a>

    </nav>

    <!-- FOOTER / LOGOUT -->
    <div class="p-4 border-t border-white/10">

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                class="flex items-center gap-3 px-4 py-3 rounded-lg w-full hover:bg-white/10 transition"
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

</div>