@extends('layouts.terapis')

@section('content')

<div class="p-6 max-w-4xl mx-auto space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-5 rounded-2xl shadow">
        <h1 class="text-xl font-semibold">Rekening Pembayaran</h1>
        <p class="text-sm opacity-80">Kelola rekening untuk pencairan saldo</p>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- LIST AKUN -->
    <div class="bg-white p-5 rounded-2xl shadow space-y-4">

        <h2 class="font-semibold text-gray-700">Daftar Rekening</h2>

        @forelse($accounts as $acc)
        <div class="border rounded-xl p-4 flex justify-between items-center">

            <div>
                <p class="font-semibold text-gray-800">
                    {{ $acc->bank_name }}
                </p>
                <p class="text-sm text-gray-600">
                    {{ $acc->account_number }}
                </p>
                <p class="text-xs text-gray-400">
                    a.n {{ $acc->account_holder }}
                </p>
            </div>

            <div class="flex items-center gap-2">

                @if($acc->is_active)
                    <span class="text-xs px-2 py-1 rounded bg-green-100 text-green-600">
                        Aktif
                    </span>
                @else
                    <form action="{{ route('terapis.rekening.aktif',$acc->id) }}" method="POST">
                        @csrf
                        <button class="text-xs px-2 py-1 bg-teal-600 text-white rounded">
                            Jadikan Aktif
                        </button>
                    </form>
                @endif

                <form action="{{ route('terapis.rekening.delete',$acc->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="text-xs px-2 py-1 bg-red-500 text-white rounded">
                        Hapus
                    </button>
                </form>

            </div>

        </div>
        @empty
        <p class="text-sm text-gray-500 text-center">Belum ada rekening</p>
        @endforelse

    </div>

    <!-- FORM TAMBAH -->
    <form action="{{ route('terapis.rekening.store') }}" method="POST"
          class="bg-white p-5 rounded-2xl shadow space-y-4">
        @csrf

        <h2 class="font-semibold text-gray-700">Tambah Rekening</h2>

        <div class="grid grid-cols-2 gap-4">

            <input type="text" name="bank_name" placeholder="Nama Bank"
                class="p-2 border rounded-lg" required>

            <input type="text" name="account_holder" placeholder="Nama Pemilik"
                class="p-2 border rounded-lg" required>

            <input type="text" name="account_number" placeholder="Nomor Rekening"
                class="p-2 border rounded-lg col-span-2" required>

        </div>

        <button class="w-full bg-teal-600 text-white py-3 rounded-xl">
            Simpan Rekening
        </button>

    </form>

</div>

@endsection