@extends('layouts.admin')

@section('title','Edit Order')
@section('header','Edit Order')

@section('content')

<div class="bg-white p-6 rounded-xl shadow w-full max-w-2xl">

<form method="POST" action="{{ route('admin.orders.update',$transaction->id) }}">

    @csrf
    @method('PUT')

    <div class="mb-4">

        <label class="text-sm">Status</label>

        <select name="status"
            class="w-full border px-3 py-2 rounded-lg">

            <option value="belum_lunas"
                {{ $transaction->status == 'belum_lunas' ? 'selected' : '' }}>
                Belum Lunas
            </option>

            <option value="proses"
                {{ $transaction->status == 'proses' ? 'selected' : '' }}>
                Proses
            </option>

            <option value="lunas"
                {{ $transaction->status == 'lunas' ? 'selected' : '' }}>
                Lunas
            </option>

            <option value="reschedule"
                {{ $transaction->status == 'reschedule' ? 'selected' : '' }}>
                Reschedule
            </option>

            <option value="dibatalkan"
                {{ $transaction->status == 'dibatalkan' ? 'selected' : '' }}>
                Dibatalkan
            </option>

        </select>

    </div>


    <div class="mb-4">

        <label class="text-sm">Tanggal Layanan</label>

        <input
            type="date"
            name="execution_date"
            value="{{ $transaction->execution_date }}"
            class="w-full border px-3 py-2 rounded-lg"
        >

    </div>


    <button
        class="bg-[#4C9A8B] text-white px-6 py-2 rounded-lg"
    >
        Update Order
    </button>

</form>

</div>

@endsection