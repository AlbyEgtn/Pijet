<aside class="w-64 bg-[#4C9A8B] text-white flex flex-col min-h-screen">

    <!-- LOGO -->
    <div class="px-6 py-6 flex items-center gap-3 border-b border-white/10">

        <img src="{{ asset('images/logo.png') }}"
             class="w-10 h-10 bg-white rounded object-contain">

        <span class="text-xl font-semibold tracking-wide">
            Pijat.in
        </span>

    </div>


    <!-- KOTA -->
    <div class="px-6 py-4 text-sm text-white/80 flex items-center justify-between cursor-pointer hover:text-white transition">

        Seluruh Kota

        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor">
            <path stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>

    </div>


    <!-- MENU -->
    <nav class="flex-1 px-3 py-4 space-y-1 text-sm">

        <!-- DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
           {{ request()->routeIs('admin.dashboard') 
           ? 'bg-white text-[#3E7F73] font-medium shadow-sm' 
           : 'hover:bg-white/10' }}">
            Dashboard
        </a>


        <!-- ORDER -->
        <div x-data="{ open: true }">

            <button @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-white/10">

                <span>Order</span>

                <svg :class="open ? 'rotate-180' : ''"
                     class="w-4 h-4 transition">
                    <path stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>

            </button>

            <div x-show="open" x-transition class="ml-3 mt-1 space-y-1 text-sm">

                <a href="{{ route('admin.orders.status') }}"
                   class="block px-3 py-2 rounded hover:bg-white/10">
                    Status Order
                </a>

                <a href="{{ route('admin.orders.waiting') }}"
                   class="block px-3 py-2 rounded hover:bg-white/10">
                    Menunggu
                </a>

                <a href="{{ route('admin.orders.finished') }}"
                   class="block px-3 py-2 rounded hover:bg-white/10">
                    Selesai
                </a>

                <a href="{{ route('admin.orders.reschedule') }}"
                   class="block px-3 py-2 rounded hover:bg-white/10">
                    Reschedule
                </a>

            </div>

        </div>


        <!-- PELANGGAN -->
        <a href="{{ route('admin.customer.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10">
            Data Pelanggan
        </a>


        <!-- TERAPIS -->
        <div x-data="{ open: true }">

            <button @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-white/10">

                <span>Data Terapis</span>

                <span class="text-xs">▾</span>

            </button>

            <div x-show="open" class="ml-3 mt-1 space-y-1 text-sm">

                <a href="{{ route('admin.therapist.index') }}"
                   class="block px-3 py-2 rounded hover:bg-white/10">
                    Akun
                </a>

                <a href="{{ route('admin.therapist.verification') }}"
                   class="block px-3 py-2 rounded hover:bg-white/10">
                    Verifikasi
                </a>

                <a href="{{ route('admin.therapist.review') }}"
                   class="block px-3 py-2 rounded hover:bg-white/10">
                    Rating & Ulasan
                </a>

            </div>

        </div>


        <!-- REPORT -->
        <a href="{{ route('admin.report.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10">
            Report
        </a>

    </nav>

</aside>