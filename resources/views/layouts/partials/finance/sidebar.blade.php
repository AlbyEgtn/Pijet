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


    <!-- MENU -->
    <nav class="flex-1 px-3 py-4 space-y-1 text-[15px]">


        <!-- Dashboard -->
        <a
            href="{{ route('finance.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition"
        >

            Dashboard

        </a>


        <!-- TRANSAKSI CUSTOMER -->
        <div
            x-data="{ open: false  }"
            class="space-y-1"
        >

            <button
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-white/10"
            >

                <span>
                    Transaksi customer
                </span>

                <svg
                    :class="open ? 'rotate-180' : ''"
                    class="w-4 h-4 transition"
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

            </button>


            <!-- DROPDOWN -->
            <div
                x-show="open"
                x-transition
                class="bg-white text-[#3E7F73] rounded-xl p-3 space-y-2 ml-2"
            >

                <a
                    href="{{ route('finance.transaction.transfer') }}"
                    class="block text-sm hover:underline"
                >
                    Daftar pembayaran transfer
                </a>


                <a
                    href="{{ route('finance.transaction.cancelled') }}"
                    class="block text-sm hover:underline"
                >
                    Daftar transaksi dibatalkan
                </a>


                <a
                    href="{{ route('finance.transaction.reschedule') }}"
                    class="block text-sm hover:underline"
                >
                    Daftar transaksi reschedule
                </a>

            </div>

        </div>


        <!-- RECAP -->
        <a
            href="{{ route('finance.recap') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition"
        >

            Recap transaksi

        </a>


        <!-- PENGATURAN -->
        <a
            href="{{ route('finance.setting') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition"
        >

            Pengaturan

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