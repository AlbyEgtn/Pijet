<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Pijetin') }}</title>

    {{-- VITE --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- STACK STYLE --}}
    @stack('styles')
</head>

<body class="min-h-screen flex flex-col bg-gray-100">

    {{-- ================= NAVBAR ================= --}}
    @include('layouts.partials.customer.navbar')



    {{-- ================= MAIN CONTENT ================= --}}
    <main class="flex-1 flex flex-col">

        {{-- ===== OPTIONAL HEADER (PER PAGE) ===== --}}
        @hasSection('header')
            <div class="w-full">
                @yield('header')
            </div>
        @endif


        {{-- ===== PAGE CONTENT ===== --}}
        <div class="flex-1 w-full">
            @yield('content')
        </div>

    </main>



    {{-- ================= FOOTER ================= --}}
    <footer class="p-4 text-sm text-center text-gray-500 bg-white border-t">
        © {{ date('Y') }} pijet.in
    </footer>



    {{-- ================= GLOBAL SCRIPT ================= --}}
    <script>
        /**
         * Global Toast (simple version)
         */
        function showToast(message) {
            const toast = document.createElement('div');
            toast.innerText = message;

            toast.className = `
                fixed top-5 right-5
                bg-black text-white text-sm
                px-4 py-2 rounded-lg shadow-lg
                opacity-0 transition duration-300 z-50
            `;

            document.body.appendChild(toast);

            setTimeout(() => toast.classList.remove('opacity-0'), 100);
            setTimeout(() => {
                toast.classList.add('opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 2000);
        }
    </script>



    {{-- ================= STACK SCRIPT ================= --}}
    @stack('scripts')

</body>
</html>