@extends('layouts.app')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')

@php
    $user = auth()->user();
    $role = $user->role;
@endphp


{{-- SUPER ADMIN --}}
@if ($role === 'super_admin')

<div class="p-6 bg-white rounded shadow">

    <h2 class="mb-2 text-lg font-semibold">
        Dashboard Super Admin
    </h2>

    <p class="text-gray-600">
        Mengelola seluruh sistem aplikasi, termasuk user,
        konfigurasi sistem, serta monitoring aktivitas platform.
    </p>

</div>


{{-- ADMIN --}}
@elseif ($role === 'admin')

<div class="p-6 bg-white rounded shadow">

    <h2 class="mb-2 text-lg font-semibold">
        Dashboard Admin
    </h2>

    <p class="text-gray-600">
        Mengelola operasional layanan, booking pelanggan,
        serta aktivitas layanan pijat.
    </p>

</div>


{{-- FINANCE --}}
@elseif ($role === 'finance')

<div class="p-6 bg-white rounded shadow">

    <h2 class="mb-2 text-lg font-semibold">
        Dashboard Finance
    </h2>

    <p class="text-gray-600">
        Melihat laporan transaksi, pemasukan, dan pengeluaran
        dari layanan pijet.in.
    </p>

</div>


{{-- TERAPIS --}}
@elseif ($role === 'terapis')

<div class="p-6 bg-white rounded shadow">

    <h2 class="mb-2 text-lg font-semibold">
        Dashboard Terapis
    </h2>

    <p class="text-gray-600">
        Melihat jadwal terapi, daftar pelanggan,
        dan aktivitas layanan yang harus dilakukan.
    </p>

</div>


{{-- CUSTOMER --}}
@elseif ($role === 'customer')

<div class="p-6 bg-white rounded shadow">

    <h2 class="mb-2 text-lg font-semibold">
        Dashboard Customer
    </h2>

    <p class="text-gray-600">
        Melihat layanan pijat yang tersedia,
        melakukan booking, dan melihat riwayat pemesanan.
    </p>

</div>

@endif

@endsection