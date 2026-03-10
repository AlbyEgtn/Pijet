@props([
    'title',
    'price',
    'image'
])

<div class="relative rounded-xl overflow-hidden shadow-lg group">

    <img 
        src="{{ $image }}" 
        class="w-full h-48 object-cover group-hover:scale-105 transition"
    >

    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

    <div class="absolute bottom-0 p-4 text-white">

        <h3 class="font-semibold text-sm">
            {{ $title }}
        </h3>

        <p class="text-xs opacity-90">
            {{ $price }}
        </p>

    </div>

</div>