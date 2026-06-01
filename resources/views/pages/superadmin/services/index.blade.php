@extends('layouts.superadmin')

@section('title','Layanan')
@section('header','Layanan')

@section('content')

<div class="space-y-8">

    <!-- ================= HERO ================= -->
    <div class="
        relative overflow-hidden
        bg-gradient-to-r from-teal-600 via-teal-700 to-teal-800
        rounded-3xl
        p-6 md:p-8
        text-white
        shadow-xl
        flex flex-col lg:flex-row
        lg:items-center
        lg:justify-between
        gap-6
    ">

        <!-- BG EFFECT -->
        <div class="
            absolute -top-10 -right-10
            w-52 h-52
            bg-white/10
            rounded-full
            blur-3xl
        "></div>

        <div class="relative z-10">

            <p class="
                text-sm
                text-teal-100
                mb-2
            ">
                Kelola Layanan
            </p>

            <h2 class="
                text-2xl md:text-4xl
                font-bold
            ">
                Daftar Layanan
            </h2>

            <p class="
                text-sm md:text-base
                text-teal-100
                mt-3
                max-w-2xl
            ">
                Kelola layanan utama dan layanan tambahan aplikasi.
            </p>

        </div>


        <!-- BUTTON -->
        <button
            onclick="toggleModal('serviceModal', true)"
            class="
                relative z-10
                bg-white
                hover:bg-gray-100
                text-teal-700
                px-5 py-3
                rounded-2xl
                text-sm font-semibold
                transition
                shadow-sm
            "
        >

            + Buat Layanan

        </button>

    </div>


    <!-- ================= LAYANAN UTAMA ================= -->
    <div>

        <div class="
            grid grid-cols-1
            sm:grid-cols-2
            xl:grid-cols-3
            gap-6
        ">

            @foreach($services as $service)

            <div class="
                bg-white
                rounded-3xl
                border border-gray-100
                shadow-sm
                overflow-hidden
                hover:shadow-xl
                transition
                group
            ">

                <!-- IMAGE -->
                <div class="
                    h-56
                    overflow-hidden
                    relative
                ">

                    <img
                        src="{{ $service->image
                            ? asset('storage/'.$service->image)
                            : 'https://via.placeholder.com/400x300'
                        }}"
                        class="
                            w-full h-full
                            object-cover
                            group-hover:scale-105
                            transition duration-500
                        "
                    >


                    <!-- STATUS -->
                    <div class="
                        absolute top-4 left-4
                    ">

                        <span class="
                            px-3 py-1.5
                            rounded-full
                            text-xs font-semibold
                            backdrop-blur
                            {{
                                $service->is_active
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-600'
                            }}
                        ">

                            {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}

                        </span>

                    </div>


                    <!-- MENU -->
                    <div class="
                        absolute top-4 right-4
                    ">

                        <div class="relative">

                            <button
                                onclick="toggleMenu(event, {{ $service->id }})"
                                class="
                                    w-10 h-10
                                    rounded-2xl
                                    bg-white/90
                                    backdrop-blur
                                    hover:bg-white
                                    text-gray-700
                                    transition
                                "
                            >

                                ⋮

                            </button>


                            <!-- DROPDOWN -->
                            <div
                                id="menu-{{ $service->id }}"
                                class="
                                    hidden
                                    absolute right-0 mt-2
                                    w-40
                                    bg-white
                                    border border-gray-100
                                    rounded-2xl
                                    shadow-xl
                                    overflow-hidden
                                    z-50
                                "
                            >

                                <!-- EDIT -->
                                <button
                                    onclick="openEditModal(
                                        {{ $service->id }},
                                        @js($service->name),
                                        '{{ $service->price }}',
                                        '{{ $service->duration }}',
                                        @js($service->description),
                                        '{{ $service->image }}'
                                    )"
                                    class="
                                        w-full text-left
                                        px-4 py-3
                                        text-sm
                                        hover:bg-gray-50
                                    "
                                >

                                    Edit

                                </button>


                                <!-- DELETE -->
                                <button
                                    onclick="openDeleteModal({{ $service->id }})"
                                    class="
                                        w-full text-left
                                        px-4 py-3
                                        text-sm
                                        text-red-600
                                        hover:bg-red-50
                                    "
                                >

                                    Hapus

                                </button>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- CONTENT -->
                <div class="p-5">

                    <h3 class="
                        text-xl
                        font-bold
                        text-gray-800
                        mb-2
                    ">

                        {{ $service->name }}

                    </h3>


                    <p class="
                        text-sm
                        text-gray-500
                        leading-relaxed
                        line-clamp-2
                        min-h-[42px]
                    ">

                        {{ $service->description }}

                    </p>


                    <!-- FOOTER -->
                    <div class="
                        flex items-center justify-between
                        gap-3
                        mt-5
                    ">

                        <div>

                            <p class="
                                text-xs
                                text-gray-400
                                mb-1
                            ">
                                Harga
                            </p>

                            <p class="
                                text-lg
                                font-bold
                                text-teal-600
                            ">

                                Rp {{ number_format($service->price,0,',','.') }}

                            </p>

                        </div>


                        <div class="
                            bg-gray-100
                            rounded-2xl
                            px-3 py-2
                            text-xs
                            font-medium
                            text-gray-600
                        ">

                            {{ $service->duration }} Menit

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>


    <!-- ================= PAGINATION ================= -->
    <div class="
        flex flex-col sm:flex-row
        items-center justify-between
        gap-4
    ">

        @if ($services->onFirstPage())

            <span class="
                px-5 py-2.5
                rounded-2xl
                bg-gray-200
                text-gray-500
                text-sm
            ">

                ← Previous

            </span>

        @else

            <a
                href="{{ $services->previousPageUrl() }}"
                class="
                    px-5 py-2.5
                    rounded-2xl
                    bg-teal-600
                    hover:bg-teal-700
                    text-white
                    text-sm
                    transition
                "
            >

                ← Previous

            </a>

        @endif


        <p class="
            text-sm
            text-gray-500
        ">

            Halaman
            {{ $services->currentPage() }}
            dari
            {{ $services->lastPage() }}

        </p>


        @if ($services->hasMorePages())

            <a
                href="{{ $services->nextPageUrl() }}"
                class="
                    px-5 py-2.5
                    rounded-2xl
                    bg-teal-600
                    hover:bg-teal-700
                    text-white
                    text-sm
                    transition
                "
            >

                Next →

            </a>

        @else

            <span class="
                px-5 py-2.5
                rounded-2xl
                bg-gray-200
                text-gray-500
                text-sm
            ">

                Next →

            </span>

        @endif

    </div>


    <!-- ================= LAYANAN TAMBAHAN ================= -->
    <div class="space-y-5">

        <!-- HEADER -->
        <div class="
            flex flex-col sm:flex-row
            sm:items-center
            justify-between
            gap-4
        ">

            <div>

                <h2 class="
                    text-2xl
                    font-bold
                    text-gray-800
                ">
                    Layanan Tambahan
                </h2>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Daftar layanan tambahan sistem
                </p>

            </div>


            <!-- BUTTON -->
            <button
                onclick="toggleModal('additionalServiceModal', true)"
                class="
                    bg-teal-600
                    hover:bg-teal-700
                    text-white
                    px-5 py-3
                    rounded-2xl
                    text-sm font-semibold
                    transition
                "
            >

                + Tambah Layanan

            </button>

        </div>


        <!-- TABLE -->
        <div class="
            bg-white
            rounded-3xl
            border border-gray-100
            shadow-sm
            overflow-hidden
        ">

            <!-- MOBILE -->
            <div class="block md:hidden">

                @foreach($additionalServices as $service)

                <div class="
                    p-5
                    border-b border-gray-100
                    space-y-4
                ">

                    <div class="
                        flex items-start justify-between
                        gap-3
                    ">

                        <div>

                            <h3 class="
                                font-semibold
                                text-gray-800
                            ">
                                {{ $service->name }}
                            </h3>

                            <p class="
                                text-sm
                                text-gray-400
                                mt-1
                            ">
                                {{ $service->duration }} Menit
                            </p>

                        </div>


                        <button
                            onclick="openEditAdditionalModal(this)"
                            data-id="{{ $service->id }}"
                            data-name="{{ $service->name }}"
                            data-price="{{ $service->price }}"
                            data-duration="{{ $service->duration }}"
                            data-description="{{ $service->description }}"
                            class="
                                text-blue-600
                                text-sm font-medium
                            "
                        >

                            Edit

                        </button>

                    </div>


                    <p class="
                        text-lg
                        font-bold
                        text-teal-600
                    ">

                        Rp {{ number_format($service->price,0,',','.') }}

                    </p>

                </div>

                @endforeach

            </div>


            <!-- DESKTOP -->
            <div class="hidden md:block overflow-x-auto">

                <table class="min-w-full text-sm">

                    <thead class="
                        bg-gray-50
                        text-xs uppercase
                        text-gray-500
                    ">

                        <tr>

                            <th class="px-6 py-4 text-left">
                                Nama
                            </th>

                            <th class="px-6 py-4 text-left">
                                Harga
                            </th>

                            <th class="px-6 py-4 text-left">
                                Durasi
                            </th>

                            <th class="px-6 py-4 text-right">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach($additionalServices as $service)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="
                                px-6 py-5
                                font-medium
                                text-gray-800
                            ">

                                {{ $service->name }}

                            </td>


                            <td class="
                                px-6 py-5
                                font-semibold
                                text-teal-600
                            ">

                                Rp {{ number_format($service->price,0,',','.') }}

                            </td>


                            <td class="
                                px-6 py-5
                                text-gray-600
                            ">

                                {{ $service->duration }} Menit

                            </td>


                            <td class="
                                px-6 py-5
                                text-right
                            ">

                                <button
                                    onclick="openEditAdditionalModal(this)"
                                    data-id="{{ $service->id }}"
                                    data-name="{{ $service->name }}"
                                    data-price="{{ $service->price }}"
                                    data-duration="{{ $service->duration }}"
                                    data-description="{{ $service->description }}"
                                    class="
                                        px-4 py-2
                                        rounded-xl
                                        bg-blue-50
                                        hover:bg-blue-100
                                        text-blue-600
                                        text-sm
                                        transition
                                    "
                                >

                                    Edit

                                </button>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- ================= MODAL TAMBAH ========================== --}}
{{-- ========================================================= --}}

<div id="serviceModal"
    class="
        fixed inset-0
        hidden items-center justify-center
        bg-black/50
        backdrop-blur-sm
        z-50
        p-4
    ">

    <div class="
        bg-white
        w-full max-w-2xl
        rounded-3xl
        shadow-2xl
        overflow-hidden
        flex flex-col
        max-h-[90vh]
    ">

        <!-- HEADER -->
        <div class="
            px-6 py-5
            border-b border-gray-100
            flex items-center justify-between
        ">

            <div>

                <h2 class="
                    text-xl
                    font-bold
                    text-gray-800
                ">
                    Buat Layanan
                </h2>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Tambahkan layanan baru ke sistem
                </p>

            </div>


            <button
                onclick="toggleModal('serviceModal', false)"
                class="
                    w-10 h-10
                    rounded-2xl
                    hover:bg-gray-100
                    transition
                "
            >

                ✕

            </button>

        </div>


        <!-- FORM -->
        <form id="serviceForm"
            action="{{ route('superadmin.services.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="
                flex-1 overflow-y-auto
                px-6 py-5
                space-y-5
            ">

            @csrf

            <input type="hidden" name="is_additional" value="0">


            <!-- NAME -->
            <div>

                <label class="
                    text-sm
                    font-medium
                    text-gray-700
                ">
                    Nama Layanan
                </label>

                <input
                    type="text"
                    name="name"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-4 py-3
                        mt-2
                        text-sm
                        focus:ring-2 focus:ring-teal-500
                        outline-none
                    "
                >

            </div>


            <!-- IMAGE -->
            <div>

                <label class="
                    text-sm
                    font-medium
                    text-gray-700
                ">
                    Gambar
                </label>

                <input
                    type="file"
                    name="image"
                    id="imageInput"
                    accept="image/*"
                    class="
                        w-full
                        mt-2
                        text-sm
                    "
                >

                <img
                    id="previewImage"
                    class="
                        hidden
                        mt-4
                        rounded-2xl
                        max-h-52
                        w-full
                        object-cover
                        border
                    "
                >

            </div>


            <!-- PRICE -->
            <div>

                <label class="
                    text-sm
                    font-medium
                    text-gray-700
                ">
                    Harga
                </label>

                <input
                    type="number"
                    name="price"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-4 py-3
                        mt-2
                        text-sm
                        focus:ring-2 focus:ring-teal-500
                        outline-none
                    "
                >

            </div>


            <!-- DURATION -->
            <div>

                <label class="
                    text-sm
                    font-medium
                    text-gray-700
                ">
                    Durasi
                </label>

                <div class="
                    grid grid-cols-3
                    gap-3
                    mt-3
                ">

                    <label class="
                        border border-gray-200
                        rounded-2xl
                        p-3
                        flex items-center justify-center
                        gap-2
                        cursor-pointer
                    ">

                        <input type="radio" name="duration" value="60">
                        <span class="text-sm">60 Menit</span>

                    </label>


                    <label class="
                        border border-gray-200
                        rounded-2xl
                        p-3
                        flex items-center justify-center
                        gap-2
                        cursor-pointer
                    ">

                        <input type="radio" name="duration" value="90">
                        <span class="text-sm">90 Menit</span>

                    </label>


                    <label class="
                        border border-gray-200
                        rounded-2xl
                        p-3
                        flex items-center justify-center
                        gap-2
                        cursor-pointer
                    ">

                        <input type="radio" name="duration" value="120">
                        <span class="text-sm">120 Menit</span>

                    </label>

                </div>

            </div>


            <!-- DESCRIPTION -->
            <div>

                <label class="
                    text-sm
                    font-medium
                    text-gray-700
                ">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-4 py-3
                        mt-2
                        text-sm
                        focus:ring-2 focus:ring-teal-500
                        outline-none
                    "
                ></textarea>

            </div>

        </form>


        <!-- FOOTER -->
        <div class="
            px-6 py-5
            border-t border-gray-100
            flex flex-col sm:flex-row
            gap-3
            justify-end
            bg-white
        ">

            <button
                type="button"
                onclick="toggleModal('serviceModal', false)"
                class="
                    px-5 py-3
                    rounded-2xl
                    bg-gray-100
                    hover:bg-gray-200
                    text-gray-700
                    text-sm font-medium
                    transition
                "
            >

                Batal

            </button>


            <button
                type="submit"
                form="serviceForm"
                class="
                    px-5 py-3
                    rounded-2xl
                    bg-teal-600
                    hover:bg-teal-700
                    text-white
                    text-sm font-semibold
                    transition
                "
            >

                Simpan Layanan

            </button>

        </div>

    </div>

</div>

@endsection


@section('script')
<script>

/* ================= MODAL ================= */
function toggleModal(id, show) {

    const modal = document.getElementById(id);

    if (!modal) return;

    modal.classList.toggle('hidden', !show);
    modal.classList.toggle('flex', show);
}


/* ================= DROPDOWN ================= */
function toggleMenu(e, id) {

    e.stopPropagation();

    const menu = document.getElementById('menu-' + id);

    if (!menu) return;

    document.querySelectorAll('[id^="menu-"]').forEach(m => {

        if (m !== menu) {

            m.classList.add('hidden');

        }

    });

    menu.classList.toggle('hidden');
}


/* ================= CLOSE DROPDOWN ================= */
document.addEventListener('click', function () {

    document.querySelectorAll('[id^="menu-"]').forEach(m => {

        m.classList.add('hidden');

    });

});


/* ================= IMAGE PREVIEW ================= */
function bindImagePreview(inputId, previewId) {

    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);

    if (!input || !preview) return;

    input.addEventListener('change', function () {

        const file = this.files[0];

        if (file) {

            preview.src = URL.createObjectURL(file);

            preview.classList.remove('hidden');

        }

    });

}

bindImagePreview('imageInput', 'previewImage');

</script>
@endsection