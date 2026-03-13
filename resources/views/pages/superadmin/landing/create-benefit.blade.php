@extends('layouts.superadmin')

@section('title', 'Landing Page')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">



    <h2 class="text-lg font-semibold mb-6">
        <a href="{{ route('superadmin.landing') }}"
           class="text-gray-600">

            ←

        </a>
        Tambah Benefit
    </h2>

    <form action="{{ route('benefit.store') }}" 
          method="POST"
          enctype="multipart/form-data"
          class="space-y-4">

        @csrf

        {{-- TITLE --}}
        <div>
            <label class="text-sm text-gray-600">
                Title
            </label>

            <input
                type="text"
                name="title"
                class="w-full border rounded-lg p-2"
                placeholder="Contoh: Penghasilan Menarik">
        </div>


        {{-- DESCRIPTION --}}
        <div>
            <label class="text-sm text-gray-600">
                Description
            </label>

            <textarea
                name="description"
                rows="3"
                class="w-full border rounded-lg p-2"
                placeholder="Deskripsi benefit"></textarea>
        </div>


        {{-- ICON --}}
        <div>
            <label class="text-sm text-gray-600">
                Icon
            </label>

            <input
                type="file"
                name="icon"
                class="w-full border rounded-lg p-2">
        </div>


        {{-- BUTTON --}}
        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
            Simpan Benefit
        </button>

    </form>

</div>

@endsection