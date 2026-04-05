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
        <div x-data="{ open: false  }">

            <button @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-white/10">

                <span>Order</span>

                <span class="text-xs">▾</span>

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
        <div x-data="{ open: false  }">

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