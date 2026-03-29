@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">
            Data Akun Terapis
        </h1>
    </div>

    <!-- Component Table -->
    <x-table.therapist-table :therapists="$therapists" />
</div>
@endsection