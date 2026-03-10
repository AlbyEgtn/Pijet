<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="h-screen w-screen overflow-hidden bg-black">

<div class="h-full w-full flex">

    <!-- LEFT SIDE -->
    <div class="w-1/2 relative flex items-center justify-center text-white
        bg-gradient-to-br from-teal-600 via-teal-500 to-emerald-400">

        <!-- background overlay -->
        <div class="absolute inset-0 opacity-10 bg-[url('/images/chart.png')] bg-cover"></div>

        <div class="relative text-center max-w-sm px-6">

            <!-- Money Bag -->
            <img src="/images/pijit.png"
                 class="mx-auto mb-8 w-48 drop-shadow-xl">

            <h2 class="text-xl font-semibold mb-3">
                Layanan Pijat Profesional
            </h2>

            <p class="text-sm opacity-90 leading-relaxed">
                Platform manajemen layanan pijat yang membantu
                mengelola pemesanan, jadwal terapis, serta aktivitas
                layanan secara terintegrasi dalam satu sistem yang
                mudah digunakan.
            </p>
        </div>

    </div>


    <!-- RIGHT SIDE -->
    <div class="w-1/2 bg-gray-100 flex items-center justify-center">

        <div class="bg-white shadow-lg rounded-xl p-10 w-[380px]">

            <!-- LOGO -->
            <div class="flex items-center justify-center gap-2 mb-8">

                <img 
                    src="{{ asset('images/logo.png') }}" 
                    alt="logo"
                    class="w-8 h-8"
                >

                <span class="text-teal-600 font-semibold text-lg">
                    Pijat.in
                </span>

            </div>

            <!-- TITLE -->
            <h1 class="text-xl font-semibold text-center mb-6">
                Login
            </h1>

            <!-- ERROR -->
            @if(session('error'))
            <div class="bg-red-100 text-red-600 text-sm p-2 rounded mb-4 text-center">
                {{ session('error') }}
            </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="/login">
                @csrf

                <!-- EMAIL -->
                <div class="mb-4">
                    <input
                        type="text"
                        name="email"
                        placeholder="Email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full
                        focus:outline-none focus:ring-2 focus:ring-teal-400"
                    >
                </div>

                <!-- PASSWORD -->
                <div class="mb-2 relative">

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-full
                        focus:outline-none focus:ring-2 focus:ring-teal-400"
                    >

                    <!-- show password -->
                    <button type="button"
                        onclick="togglePassword()"
                        class="absolute right-4 top-2 text-gray-400 hover:text-gray-600">

                        <!-- eye icon -->
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5
                            c4.478 0 8.268 2.943 9.542 7
                            -1.274 4.057-5.064 7-9.542 7
                            -4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <!-- eye off icon -->
                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19
                            c-4.478 0-8.268-2.943-9.542-7
                            a9.956 9.956 0 012.293-3.95m3.164-2.44
                            A9.956 9.956 0 0112 5c4.478 0 8.268
                            2.943 9.542 7a9.969 9.969 0 01-4.132
                            5.411M15 12a3 3 0 00-3-3m0 0a3
                            3 0 00-2.995 2.824M12 9l6 6M6 6l12 12" />
                        </svg>

                    </button>

                </div>

                <!-- FORGOT -->
                <div class="text-right text-xs mb-5">
                    <a href="/forgot-password" class="text-blue-500 hover:underline">
                        Lupa Password?
                    </a>
                </div>

                <!-- BUTTON -->
                <button
                    class="w-full bg-teal-500 hover:bg-teal-600
                    transition text-white py-2 rounded-full">
                    Masuk
                </button>

            </form>

        </div>

    </div>

</div>


<script>
function togglePassword(){
    const input = document.getElementById("password");

    if(input.type === "password"){
        input.type = "text";
    }else{
        input.type = "password";
    }
}
</script>

</body>
</html>