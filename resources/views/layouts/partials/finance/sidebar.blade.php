<aside class="w-64 bg-[#4C9A8B] text-white flex flex-col">

    <!-- LOGO -->
    <div class="px-6 py-6 flex items-center gap-3">

        <img
            src="{{ asset('images/logo.png') }}"
            alt="logo"
            class="w-10 h-10 object-contain bg-white rounded"
        >

        <span class="text-2xl font-semibold tracking-wide">
            Pijat.in
        </span>

    </div>


    <!-- CABANG -->
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
            href="{{ route('finance.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition"
        >

            Dashboard

        </a>


        <!-- TRANSAKSI CUSTOMER -->
        <div
            x-data="{ open: true }"
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
                    href="{{ route('finance.transaction.cash') }}"
                    class="block text-sm hover:underline"
                >
                    Daftar pembayaran cash
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


        <!-- GAJI -->
        <a
            href="{{ route('finance.salary') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition"
        >

            Daftar Gaji Terapis

        </a>


        <!-- PENGATURAN -->
        <a
            href="{{ route('finance.setting') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition"
        >

            Pengaturan

        </a>

    </nav>

</aside>