@extends('layouts.superadmin')

@section('title','Landing Page')
@section('header','Landing Page')

@section('content')

<form
    action="{{ route('superadmin.landing.update') }}"
    method="POST"
    enctype="multipart/form-data"
>

@csrf

<div class="space-y-8">

    <!-- ================= HERO ================= -->
    <div class="
        relative overflow-hidden
        bg-gradient-to-r from-teal-600 via-teal-700 to-teal-800
        rounded-3xl
        p-6 md:p-8
        text-white
        shadow-xl
    ">

        <!-- BG -->
        <div class="
            absolute -top-10 -right-10
            w-56 h-56
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
                Kelola Landing Page
            </p>

            <h2 class="
                text-2xl md:text-4xl
                font-bold
            ">
                Landing Page Management
            </h2>

            <p class="
                text-sm md:text-base
                text-teal-100
                mt-3
                max-w-2xl
            ">
                Kelola tampilan website landing page aplikasi Pijat.in.
            </p>

        </div>

    </div>


    <!-- ================= HERO SECTION ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        p-6 md:p-8
        space-y-6
    ">

        <div>

            <h2 class="
                text-xl
                font-semibold
                text-gray-800
            ">
                Hero Section
            </h2>

            <p class="
                text-sm
                text-gray-400
                mt-1
            ">
                Tampilan utama halaman landing.
            </p>

        </div>


        <!-- IMAGE -->
        <div class="
            grid grid-cols-1
            lg:grid-cols-2
            gap-6
        ">

            <!-- PREVIEW -->
            <div>

                <p class="
                    text-sm
                    font-medium
                    text-gray-700
                    mb-3
                ">
                    Hero Image
                </p>

                @if($page->hero_image)

                    <img
                        src="{{ asset('images/' . $page->hero_image) }}"
                        class="
                            w-full
                            h-72
                            object-cover
                            rounded-3xl
                            border border-gray-200
                        "
                    >

                @else

                    <div class="
                        w-full h-72
                        rounded-3xl
                        border border-dashed border-gray-300
                        flex items-center justify-center
                        text-gray-400
                        bg-gray-50
                    ">

                        No Image

                    </div>

                @endif

            </div>


            <!-- UPLOAD -->
            <div class="space-y-5">

                <div>

                    <label class="
                        block
                        text-sm
                        font-medium
                        text-gray-700
                        mb-2
                    ">
                        Upload Gambar
                    </label>

                    <input
                        type="file"
                        name="hero_image"
                        class="
                            w-full
                            border border-gray-200
                            rounded-2xl
                            px-4 py-3
                            text-sm
                        "
                    >

                    <p class="
                        text-xs
                        text-gray-400
                        mt-2
                    ">
                        Disarankan menggunakan gambar landscape.
                    </p>

                </div>


                <!-- TITLE -->
                <div>

                    <label class="
                        block
                        text-sm
                        font-medium
                        text-gray-700
                        mb-2
                    ">
                        Hero Title
                    </label>

                    <input
                        type="text"
                        name="hero_title"
                        value="{{ $page->hero_title }}"
                        class="
                            w-full
                            border border-gray-200
                            rounded-2xl
                            px-5 py-3
                            text-sm
                            focus:ring-2 focus:ring-teal-500
                            outline-none
                        "
                    >

                </div>


                <!-- SUBTITLE -->
                <div>

                    <label class="
                        block
                        text-sm
                        font-medium
                        text-gray-700
                        mb-2
                    ">
                        Hero Subtitle
                    </label>

                    <textarea
                        name="hero_subtitle"
                        rows="5"
                        class="
                            w-full
                            border border-gray-200
                            rounded-2xl
                            px-5 py-3
                            text-sm
                            focus:ring-2 focus:ring-teal-500
                            outline-none
                        "
                    >{{ $page->hero_subtitle }}</textarea>

                </div>

            </div>

        </div>


        <!-- BUTTON -->
        <div class="
            grid grid-cols-1
            md:grid-cols-2
            gap-5
        ">

            <!-- WEBSITE -->
            <div class="
                bg-gray-50
                rounded-3xl
                p-5
                space-y-4
            ">

                <h3 class="
                    font-semibold
                    text-gray-800
                ">
                    Button Website
                </h3>

                <input
                    type="text"
                    name="hero_button_text"
                    value="{{ $page->hero_button_text }}"
                    placeholder="Button Text"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-5 py-3
                        text-sm
                    "
                >

                <input
                    type="text"
                    name="hero_button_link"
                    value="{{ $page->hero_button_link }}"
                    placeholder="Button Link"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-5 py-3
                        text-sm
                    "
                >

            </div>


            <!-- APP -->
            <div class="
                bg-gray-50
                rounded-3xl
                p-5
                space-y-4
            ">

                <h3 class="
                    font-semibold
                    text-gray-800
                ">
                    Button App
                </h3>

                <input
                    type="text"
                    name="app_button_text"
                    value="{{ $page->app_button_text ?? '' }}"
                    placeholder="Button App Text"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-5 py-3
                        text-sm
                    "
                >

                <input
                    type="text"
                    name="app_button_link"
                    value="{{ $page->app_button_link ?? '' }}"
                    placeholder="Button App Link"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-5 py-3
                        text-sm
                    "
                >

            </div>

        </div>

    </div>


    <!-- ================= ABOUT ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        p-6 md:p-8
    ">

        <div class="mb-6">

            <h2 class="
                text-xl
                font-semibold
                text-gray-800
            ">
                About / Why Us
            </h2>

            <p class="
                text-sm
                text-gray-400
                mt-1
            ">
                Informasi tentang perusahaan dan keunggulan.
            </p>

        </div>


        <div class="
            grid grid-cols-1
            lg:grid-cols-2
            gap-6
        ">

            <!-- IMAGE -->
            <div class="space-y-4">

                @if($page->about_image)

                    <img
                        src="{{ asset('images/'.$page->about_image) }}"
                        class="
                            w-full
                            h-72
                            object-cover
                            rounded-3xl
                            border border-gray-200
                        "
                    >

                @endif

                <input
                    type="file"
                    name="about_image"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-4 py-3
                        text-sm
                    "
                >

            </div>


            <!-- TEXT -->
            <div class="space-y-5">

                <input
                    type="text"
                    name="about_title"
                    value="{{ $page->about_title }}"
                    placeholder="About Title"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-5 py-3
                        text-sm
                    "
                >

                <textarea
                    name="about_description"
                    rows="8"
                    placeholder="About Description"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-5 py-3
                        text-sm
                    "
                >{{ $page->about_description }}</textarea>

            </div>

        </div>

    </div>


    <!-- ================= STATISTIC ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        p-6 md:p-8
    ">

        <div class="mb-6">

            <h2 class="
                text-xl
                font-semibold
                text-gray-800
            ">
                Statistic Items
            </h2>

            <p class="
                text-sm
                text-gray-400
                mt-1
            ">
                Statistik yang tampil di landing page.
            </p>

        </div>


        <div class="
            grid grid-cols-1
            md:grid-cols-2
            gap-5
        ">

            @foreach($statistics as $stat)

            <div class="
                bg-gray-50
                rounded-3xl
                p-5
                space-y-4
            ">

                <input
                    type="text"
                    name="statistics[{{ $stat->id }}][title]"
                    value="{{ $stat->title }}"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-5 py-3
                        text-sm
                    "
                >

                <input
                    type="text"
                    name="statistics[{{ $stat->id }}][value]"
                    value="{{ $stat->value }}"
                    class="
                        w-full
                        border border-gray-200
                        rounded-2xl
                        px-5 py-3
                        text-sm
                    "
                >

            </div>

            @endforeach

        </div>

    </div>


    <!-- ================= BENEFIT ================= -->
    <div class="
        bg-white
        rounded-3xl
        border border-gray-100
        shadow-sm
        p-6 md:p-8
    ">

        <!-- HEADER -->
        <div class="
            flex flex-col sm:flex-row
            sm:items-center
            justify-between
            gap-4
            mb-6
        ">

            <div>

                <h2 class="
                    text-xl
                    font-semibold
                    text-gray-800
                ">
                    Benefit Terapis
                </h2>

                <p class="
                    text-sm
                    text-gray-400
                    mt-1
                ">
                    Kelola daftar benefit terapis.
                </p>

            </div>


            <a href="{{ route('benefit.create') }}"
               class="
                    inline-flex items-center justify-center
                    bg-teal-600
                    hover:bg-teal-700
                    text-white
                    px-5 py-3
                    rounded-2xl
                    text-sm font-semibold
                    transition
               ">

                + Tambah Benefit

            </a>

        </div>


        <!-- MOBILE -->
        <div class="block md:hidden space-y-4">

            @foreach($benefits as $benefit)

            <div class="
                border border-gray-100
                rounded-3xl
                p-5
                space-y-4
            ">

                <!-- TOP -->
                <div class="
                    flex items-start
                    gap-4
                ">

                    @if($benefit->icon)

                        <img
                            src="{{ asset('images/'.$benefit->icon) }}"
                            class="
                                w-14 h-14
                                object-contain
                                rounded-2xl
                                border
                                p-2
                            "
                        >

                    @endif


                    <div class="flex-1">

                        <h3 class="
                            font-semibold
                            text-gray-800
                        ">
                            {{ $benefit->title }}
                        </h3>

                        <p class="
                            text-sm
                            text-gray-500
                            mt-1
                        ">
                            {{ $benefit->description }}
                        </p>

                    </div>

                </div>


                <!-- ACTION -->
                <div class="
                    flex items-center
                    gap-3
                ">

                    <a href="{{ route('benefit.edit',$benefit->id) }}"
                       class="
                            flex-1
                            text-center
                            bg-blue-50
                            hover:bg-blue-100
                            text-blue-600
                            py-3
                            rounded-2xl
                            text-sm font-medium
                            transition
                       ">

                        Edit

                    </a>


                    <button
                        type="button"
                        onclick="deleteBenefit({{ $benefit->id }})"
                        class="
                            flex-1
                            bg-red-50
                            hover:bg-red-100
                            text-red-600
                            py-3
                            rounded-2xl
                            text-sm font-medium
                            transition
                        "
                    >

                        Hapus

                    </button>

                </div>

            </div>

            @endforeach

        </div>


        <!-- DESKTOP -->
        <div class="
            hidden md:block
            overflow-x-auto
        ">

            <table class="min-w-full text-sm">

                <thead class="
                    bg-gray-50
                    text-xs uppercase
                    text-gray-500
                ">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            Icon
                        </th>

                        <th class="px-6 py-4 text-left">
                            Title
                        </th>

                        <th class="px-6 py-4 text-left">
                            Description
                        </th>

                        <th class="px-6 py-4 text-right">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @foreach($benefits as $benefit)

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-5">

                            @if($benefit->icon)

                                <img
                                    src="{{ asset('images/'.$benefit->icon) }}"
                                    class="
                                        w-12 h-12
                                        object-contain
                                        rounded-2xl
                                        border
                                        p-2
                                    "
                                >

                            @endif

                        </td>


                        <td class="
                            px-6 py-5
                            font-semibold
                            text-gray-800
                        ">

                            {{ $benefit->title }}

                        </td>


                        <td class="
                            px-6 py-5
                            text-gray-600
                        ">

                            {{ $benefit->description }}

                        </td>


                        <td class="
                            px-6 py-5
                            text-right
                        ">

                            <div class="
                                flex items-center justify-end
                                gap-3
                            ">

                                <a href="{{ route('benefit.edit',$benefit->id) }}"
                                   class="
                                        px-4 py-2
                                        rounded-xl
                                        bg-blue-50
                                        hover:bg-blue-100
                                        text-blue-600
                                        text-sm
                                        transition
                                   ">

                                    Edit

                                </a>


                                <button
                                    type="button"
                                    onclick="deleteBenefit({{ $benefit->id }})"
                                    class="
                                        px-4 py-2
                                        rounded-xl
                                        bg-red-50
                                        hover:bg-red-100
                                        text-red-600
                                        text-sm
                                        transition
                                    ">

                                    Hapus

                                </button>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>


    <!-- ================= JOIN & DOWNLOAD ================= -->
    <div class="
        grid grid-cols-1
        xl:grid-cols-2
        gap-6
    ">

        <!-- JOIN -->
        <div class="
            bg-white
            rounded-3xl
            border border-gray-100
            shadow-sm
            p-6
            space-y-5
        ">

            <div>

                <h2 class="
                    text-xl
                    font-semibold
                    text-gray-800
                ">
                    Join Therapist
                </h2>

            </div>

            @if($page->join_image)

                <img
                    src="{{ asset('images/'.$page->join_image) }}"
                    class="
                        w-full
                        h-60
                        object-cover
                        rounded-3xl
                    "
                >

            @endif

            <input
                type="file"
                name="join_image"
                class="
                    w-full
                    border border-gray-200
                    rounded-2xl
                    px-4 py-3
                    text-sm
                "
            >

            <input
                type="text"
                name="join_title"
                value="{{ $page->join_title }}"
                placeholder="Join Title"
                class="
                    w-full
                    border border-gray-200
                    rounded-2xl
                    px-5 py-3
                    text-sm
                "
            >

            <textarea
                name="join_description"
                rows="5"
                placeholder="Join Description"
                class="
                    w-full
                    border border-gray-200
                    rounded-2xl
                    px-5 py-3
                    text-sm
                "
            >{{ $page->join_description }}</textarea>

        </div>


        <!-- DOWNLOAD -->
        <div class="
            bg-white
            rounded-3xl
            border border-gray-100
            shadow-sm
            p-6
            space-y-5
        ">

            <div>

                <h2 class="
                    text-xl
                    font-semibold
                    text-gray-800
                ">
                    Download App
                </h2>

            </div>

            @if($page->download_image)

                <img
                    src="{{ asset('images/'.$page->download_image) }}"
                    class="
                        w-full
                        h-60
                        object-cover
                        rounded-3xl
                    "
                >

            @endif

            <input
                type="file"
                name="download_image"
                class="
                    w-full
                    border border-gray-200
                    rounded-2xl
                    px-4 py-3
                    text-sm
                "
            >

            <input
                type="text"
                name="download_title"
                value="{{ $page->download_title }}"
                placeholder="Download Title"
                class="
                    w-full
                    border border-gray-200
                    rounded-2xl
                    px-5 py-3
                    text-sm
                "
            >

            <textarea
                name="download_description"
                rows="5"
                placeholder="Download Description"
                class="
                    w-full
                    border border-gray-200
                    rounded-2xl
                    px-5 py-3
                    text-sm
                "
            >{{ $page->download_description }}</textarea>

        </div>

    </div>


    <!-- ================= SAVE BUTTON ================= -->
    <div class="
        flex justify-end
    ">

        <button
            type="submit"
            class="
                bg-teal-600
                hover:bg-teal-700
                text-white
                px-8 py-4
                rounded-2xl
                text-sm font-semibold
                transition
                shadow-sm
            "
        >

            Simpan Semua Perubahan

        </button>

    </div>

</div>

</form>


<!-- ================= DELETE FORM ================= -->
<form id="deleteBenefitForm"
      method="POST"
      style="display:none;">

    @csrf
    @method('DELETE')

</form>

@endsection


@section('script')

<script>

function deleteBenefit(id)
{
    Swal.fire({

        title: 'Hapus Benefit?',
        text: 'Data benefit akan dihapus permanen.',
        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',

        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'

    }).then((result) => {

        if(result.isConfirmed)
        {
            let form = document.getElementById('deleteBenefitForm');

            form.action = "/benefit/delete/" + id;

            form.submit();
        }

    });
}

</script>

@endsection