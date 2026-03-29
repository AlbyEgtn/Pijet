<aside class="w-64 bg-teal-800 text-white flex flex-col">
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