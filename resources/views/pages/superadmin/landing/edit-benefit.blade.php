@extends('layouts.superadmin')

@section('title','Landing Page  ')
@section('header','Landing Page ')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-lg font-semibold mb-6">
        <a href="{{ route('superadmin.landing') }}"
           class="text-gray-600">

            ←

        </a>
        Edit Benefit
    </h2>

    <form action="{{ route('benefit.update',$benefit->id) }}" 
          method="POST"
          enctype="multipart/form-data"
          class="space-y-4">

        @csrf

        {{-- TITLE --}}
        <div>
            <label class="text-sm text-gray-600">Title</label>

            <input
                type="text"
                name="title"
                value="{{ $benefit->title }}"
                class="w-full border rounded-lg p-2">
        </div>


        {{-- DESCRIPTION --}}
        <div>
            <label class="text-sm text-gray-600">Description</label>

            <textarea
                name="description"
                rows="3"
                class="w-full border rounded-lg p-2">{{ $benefit->description }}</textarea>
        </div>


        {{-- ICON --}}
        <div>

            <label class="text-sm text-gray-600">Icon</label>

            @if($benefit->icon)
                <img
                    src="{{ asset('images/'.$benefit->icon) }}"
                    class="w-12 mb-2">
            @endif

            <input
                type="file"
                name="icon"
                class="w-full border rounded-lg p-2">
        </div>


        {{-- BUTTON --}}
        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
            Update Benefit
        </button>

    </form>

</div>

@endsection