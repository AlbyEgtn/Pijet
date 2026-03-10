<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title')</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="@yield('body-class')">

    {{-- PAGE CONTENT --}}
    @yield('content')


    {{-- TOAST NOTIFICATION --}}
    @if(session('success') || session('error') || session('warning'))

    <div id="toast-container"
         class="fixed top-6 right-6 z-50 space-y-3">

        @if(session('success'))
        <div class="toast bg-emerald-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="toast bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('error') }}
        </div>
        @endif

        @if(session('warning'))
        <div class="toast bg-yellow-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('warning') }}
        </div>
        @endif

    </div>

    @endif


<script>

document.querySelectorAll('.toast').forEach((toast)=>{

    setTimeout(()=>{
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(50px)';
    },3000)

    setTimeout(()=>{
        toast.remove()
    },3500)

})

</script>

@stack('scripts')

</body>
</html>