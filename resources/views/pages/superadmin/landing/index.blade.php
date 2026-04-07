@extends('layouts.superadmin')

@section('title','Landing Page  ')
@section('header','Landing Page ')

@section('content')

<form
    action="{{ route('superadmin.landing.update') }}"
    method="POST"
    enctype="multipart/form-data"
>
@csrf

<div class="space-y-10">

    {{-- ================= HERO SECTION ================= --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-lg font-semibold mb-6">
            Hero Section
        </h2>

        <div class="space-y-6">

            {{-- HERO IMAGE --}}
            <div>

                <label class="block text-sm font-medium mb-3">
                    Hero Image
                </label>

                <div class="grid grid-cols-2 gap-6 items-start">

                    {{-- PREVIEW IMAGE --}}
                    <div>
                        @if($page->hero_image)
                            <img
                                src="{{ asset('images/' . $page->hero_image) }}"
                                class="w-full h-64 object-cover rounded-lg border"
                            >
                        @else
                            <div class="w-full h-64 flex items-center justify-center border rounded-lg text-gray-400">
                                No Image
                            </div>
                        @endif
                    </div>

                    {{-- FILE UPLOAD --}}
                    <div class="flex flex-col justify-center space-y-3">

                        <input
                            type="file"
                            name="hero_image"
                            class="w-full border rounded-lg p-2"
                        >

                        <p class="text-sm text-gray-500">
                            Upload gambar hero untuk landing page.
                            Disarankan ukuran landscape.
                        </p>

                    </div>

                </div>

            </div>


            {{-- HERO TITLE --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Hero Title
                </label>

                <input
                    type="text"
                    name="hero_title"
                    value="{{ $page->hero_title }}"
                    placeholder="Hero Title"
                    class="w-full border rounded-lg p-2"
                >

            </div>


            {{-- HERO SUBTITLE --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Hero Subtitle
                </label>

                <textarea
                    name="hero_subtitle"
                    rows="4"
                    placeholder="Hero Subtitle"
                    class="w-full border rounded-lg p-2"
                >{{ $page->hero_subtitle }}</textarea>

            </div>


            {{-- BUTTON WEBSITE --}}
            <div class="grid grid-cols-2 gap-4">

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Button Text
                    </label>

                    <input
                        type="text"
                        name="hero_button_text"
                        value="{{ $page->hero_button_text }}"
                        placeholder="Button Text"
                        class="w-full border rounded-lg p-2"
                    >

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Button Link
                    </label>

                    <input
                        type="text"
                        name="hero_button_link"
                        value="{{ $page->hero_button_link }}"
                        placeholder="Button Link"
                        class="w-full border rounded-lg p-2"
                    >

                </div>

            </div>


            {{-- BUTTON APP --}}
            <div class="grid grid-cols-2 gap-4">

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Button App Text
                    </label>

                    <input
                        type="text"
                        name="app_button_text"
                        value="{{ $page->app_button_text ?? '' }}"
                        placeholder="Button App Text"
                        class="w-full border rounded-lg p-2"
                    >

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Button App Link
                    </label>

                    <input
                        type="text"
                        name="app_button_link"
                        value="{{ $page->app_button_link ?? '' }}"
                        placeholder="Button App Link"
                        class="w-full border rounded-lg p-2"
                    >

                </div>

            </div>

        </div>

    </div>



    {{-- ================= ABOUT / WHY US ================= --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-lg font-semibold mb-6">
            About / Why Us
        </h2>

        <div class="grid grid-cols-2 gap-6 items-start">

            {{-- IMAGE --}}
            <div>

                @if($page->about_image)
                    <img
                        src="{{ asset('images/'.$page->about_image) }}"
                        class="w-full h-56 object-cover rounded-lg border mb-3"
                    >
                @endif

                <input
                    type="file"
                    name="about_image"
                    class="w-full border rounded-lg p-2"
                >

            </div>


            {{-- TEXT --}}
            <div class="space-y-4">

                <input
                    type="text"
                    name="about_title"
                    value="{{ $page->about_title }}"
                    placeholder="About Title"
                    class="w-full border rounded-lg p-2"
                >

                <textarea
                    name="about_description"
                    rows="5"
                    placeholder="About Description"
                    class="w-full border rounded-lg p-2"
                >{{ $page->about_description }}</textarea>

            </div>

        </div>

    </div>

    {{-- ================= STATISTICS ================= --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-lg font-semibold mb-4">
            Statistic Items
        </h2>

        @foreach($statistics as $stat)

            <div class="grid grid-cols-2 gap-4 mb-3">

                <input
                    type="text"
                    name="statistics[{{ $stat->id }}][title]"
                    value="{{ $stat->title }}"
                    class="border rounded-lg p-2"
                >

                <input
                    type="text"
                    name="statistics[{{ $stat->id }}][value]"
                    value="{{ $stat->value }}"
                    class="border rounded-lg p-2"
                >

            </div>

        @endforeach

    </div>

    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-lg font-semibold mb-6">
            Benefit Terapis
        </h2>


        {{-- ================= BENEFITS ================= --}}
        <div class="bg-white p-6 rounded-xl shadow">

            <div class="flex justify-between items-center mb-6">

                <h2 class="text-lg font-semibold">
                    Benefit Terapis
                </h2>

                <a 
                    href="{{ route('benefit.create') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                    + Tambah
                </a>

            </div>


            <table class="w-full text-sm">

                <thead class="border-b text-gray-600">

                    <tr>
                        <th class="text-left py-3">Icon</th>
                        <th class="text-left py-3">Title</th>
                        <th class="text-left py-3">Description</th>
                        <th class="text-left py-3 w-32">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                @foreach($benefits as $benefit)

                    <tr class="border-b hover:bg-gray-50">

                        {{-- ICON --}}
                        <td class="py-3">

                            @if($benefit->icon)
                                <img 
                                    src="{{ asset('images/'.$benefit->icon) }}"
                                    class="w-10 h-10 object-contain">
                            @endif

                        </td>

                        {{-- TITLE --}}
                        <td>
                            {{ $benefit->title }}
                        </td>

                        {{-- DESCRIPTION --}}
                        <td>
                            {{ $benefit->description }}
                        </td>

                        {{-- ACTION --}}
                        <td class="flex gap-3 py-3">

                            {{-- EDIT --}}
                            <a 
                                href="{{ route('benefit.edit',$benefit->id) }}"
                                class="text-blue-500 hover:text-blue-700 text-sm">
                                Edit
                            </a>


                            {{-- DELETE --}}
                            <button
                                type="button"
                                onclick="deleteBenefit({{ $benefit->id }})"
                                class="text-red-500 hover:text-red-700 text-sm">
                                Hapus
                            </button>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

    {{-- ================= JOIN THERAPIST ================= --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-lg font-semibold mb-6">
            Section Join Therapist
        </h2>

        <div class="grid grid-cols-2 gap-6">

            {{-- IMAGE --}}
            <div>

                @if($page->join_image)
                    <img
                        src="{{ asset('images/'.$page->join_image) }}"
                        class="w-full h-48 object-cover rounded-lg mb-3">
                @endif

                <input
                    type="file"
                    name="join_image"
                    class="w-full border rounded-lg p-2">
            </div>


            {{-- TEXT --}}
            <div class="space-y-4">

                <input
                    type="text"
                    name="join_title"
                    value="{{ $page->join_title }}"
                    placeholder="Join Title"
                    class="w-full border rounded-lg p-2">

                <textarea
                    name="join_description"
                    rows="5"
                    placeholder="Join Description"
                    class="w-full border rounded-lg p-2">{{ $page->join_description }}</textarea>

            </div>

        </div>

    </div>

    {{-- ================= DOWNLOAD APP ================= --}}
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-lg font-semibold mb-6">
            Section Download App
        </h2>

        <div class="grid grid-cols-2 gap-6">

            {{-- IMAGE --}}
            <div>

                @if($page->download_image)
                    <img
                        src="{{ asset('images/'.$page->download_image) }}"
                        class="w-full h-48 object-cover rounded-lg mb-3">
                @endif

                <input
                    type="file"
                    name="download_image"
                    class="w-full border rounded-lg p-2">
            </div>


            {{-- TEXT --}}
            <div class="space-y-4">

                <input
                    type="text"
                    name="download_title"
                    value="{{ $page->download_title }}"
                    placeholder="Download Title"
                    class="w-full border rounded-lg p-2">

                <textarea
                    name="download_description"
                    rows="5"
                    placeholder="Download Description"
                    class="w-full border rounded-lg p-2">{{ $page->download_description }}</textarea>

            </div>

        </div>

    </div>

    {{-- ================= SAVE BUTTON ================= --}}
    <div class="flex justify-end">

        <button
            type="submit"
            class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-lg"
        >
            Simpan Semua Perubahan
        </button>

    </div>


</div>

</form>

@endsection

<form id="deleteBenefitForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script>
function deleteBenefit(id)
{
    if(confirm('Hapus benefit ini?'))
    {
        let form = document.getElementById('deleteBenefitForm');
        form.action = "/benefit/delete/" + id;
        form.submit();
    }
}
</script>