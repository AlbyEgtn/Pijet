@extends('layouts.superadmin')

@section('title','Detail Pengguna')
@section('header','Detail Akun')

@section('content')

<div x-data="{ openSuspend: false }" class="space-y-6">

    <!-- BREADCRUMB -->
    <div class="text-sm text-gray-400">
        Pengguna > {{ ucfirst($type) }} > 
        <span class="text-green-600">Detail Akun</span>
    </div>

    <!-- TOP -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- LEFT CARD -->
        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-full bg-gray-200 overflow-hidden">
                    @if($user->foto)
                        <img src="{{ asset('storage/'.$user->foto) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-xl font-bold">
                            {{ strtoupper(substr($user->name,0,1)) }}
                        </div>
                    @endif
                </div>

                <div>
                    <h3 class="font-semibold text-lg">{{ $user->name }}</h3>

                    <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-600">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>

                <div class="ml-auto text-sm text-gray-400">
                    #{{ $user->kode }}
                </div>

            </div>

            <!-- INFO -->
            <div class="mt-6 space-y-3 text-sm">

                <h4 class="font-semibold text-gray-700">Informasi Akun</h4>

                <div class="flex justify-between">
                    <span>Status Akun</span>

                    @if($user->is_suspended ?? false)
                        <span class="bg-red-100 text-red-600 px-2 py-1 text-xs rounded">
                            Ditangguhkan
                        </span>
                    @else
                        <span class="bg-green-100 text-green-600 px-2 py-1 text-xs rounded">
                            Aktif
                        </span>
                    @endif
                </div>

                <div class="flex justify-between">
                    <span>Email</span>
                    <span>{{ $user->email }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Telepon</span>
                    <span>{{ $user->phone ?? '-' }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Alamat</span>
                    <span class="text-right max-w-xs">
                        {{ $user->address ?? '-' }}
                    </span>
                </div>

            </div>

            <!-- ACTION -->
            <div class="flex gap-2 mt-6">

                <button 
                    @click="openSuspend = true"
                    class="border border-red-400 text-red-500 px-4 py-2 rounded-lg text-sm hover:bg-red-50">
                    Tangguhkan Akun
                </button>



            </div>

        </div>

        <!-- RIGHT -->
        <div class="bg-white rounded-2xl shadow-sm p-6 space-y-6">

            <div>

                <div class="flex justify-between items-center mb-2">
                    <h4 class="font-semibold text-gray-700">Identitas Diri</h4>

                    @if($user->ktp)
                        <a href="{{ asset('storage/'.$user->ktp) }}" target="_blank"
                           class="text-xs border px-3 py-1 rounded-lg text-blue-600 hover:bg-blue-50">
                            Lihat Bukti KTP
                        </a>
                    @endif
                </div>

                <div class="text-sm space-y-2">

                    <div class="flex justify-between">
                        <span>NIK</span>
                        <span>{{ $user->nik ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Nama</span>
                        <span>{{ $user->name }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Jenis Kelamin</span>
                        <span>{{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Tanggal Lahir</span>
                        <span>{{ $user->birth_date ?? '-' }}</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div 
        x-show="openSuspend"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-cloak
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div @click.away="openSuspend = false"
            class="bg-white w-full max-w-xl rounded-2xl shadow-xl p-6">

            <!-- HEADER -->
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-red-100 text-red-600 flex items-center justify-center rounded-full">
                    ⚠️
                </div>
                <div>
                    <h2 class="font-semibold text-lg">Penangguhan Akun</h2>
                    <p class="text-xs text-gray-400">Tindakan ini akan membatasi akses pengguna</p>
                </div>
            </div>

            <!-- WARNING -->
            <div class="bg-yellow-100 text-yellow-700 text-sm p-3 rounded-lg mb-4">
                Pastikan keputusan ini sudah dipertimbangkan dengan baik sebelum melanjutkan.
            </div>

            <form method="POST" action="{{ route('superadmin.pengguna.suspend', $user->id) }}">
                @csrf

                <!-- ALASAN -->
                <div class="mb-4">
                    <p class="text-sm font-medium mb-2">Alasan Penangguhan</p>

                    <div class="grid grid-cols-1 gap-2 text-sm">

                        <label class="flex items-center gap-2 p-2 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="reason" value="pelecehan">
                            Pelecehan Seksual
                        </label>

                        <label class="flex items-center gap-2 p-2 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="reason" value="penghinaan">
                            Penghinaan
                        </label>

                        <label class="flex items-center gap-2 p-2 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="reason" value="tidak_sopan">
                            Perilaku Tidak Sopan
                        </label>

                        <label class="flex items-center gap-2 p-2 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="reason" value="kekerasan">
                            Tindak Kekerasan
                        </label>

                        <label class="flex items-center gap-2 p-2 border rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="reason" value="mengabaikan">
                            Mengabaikan Peringatan
                        </label>

                    </div>
                </div>

                <!-- CATATAN -->
                <div class="mb-4">
                    <p class="text-sm font-medium mb-2">Catatan Tambahan</p>

                    <textarea 
                        name="note"
                        maxlength="500"
                        x-data="{ count: 0 }"
                        @input="count = $event.target.value.length"
                        placeholder="Tuliskan detail alasan..."
                        class="w-full border rounded-lg p-3 text-sm"></textarea>

                    <div class="text-right text-xs text-gray-400 mt-1">
                        <span x-text="count"></span>/500
                    </div>
                </div>

                <!-- DURASI -->
                <div class="mb-6">
                    <p class="text-sm font-medium mb-2">Durasi Penangguhan</p>

                    <div class="grid grid-cols-4 gap-2 text-sm">

                        <!-- 7 Hari -->
                        <label class="cursor-pointer">
                            <input type="radio" name="duration" value="7" class="hidden peer">
                            <div class="text-center border rounded-lg p-2 
                                peer-checked:bg-red-500 
                                peer-checked:text-white 
                                peer-checked:border-red-500 
                                hover:bg-gray-50">
                                7 Hari
                            </div>
                        </label>

                        <!-- 14 Hari -->
                        <label class="cursor-pointer">
                            <input type="radio" name="duration" value="14" class="hidden peer">
                            <div class="text-center border rounded-lg p-2 
                                peer-checked:bg-red-500 
                                peer-checked:text-white 
                                peer-checked:border-red-500 
                                hover:bg-gray-50">
                                14 Hari
                            </div>
                        </label>

                        <!-- 30 Hari -->
                        <label class="cursor-pointer">
                            <input type="radio" name="duration" value="30" class="hidden peer">
                            <div class="text-center border rounded-lg p-2 
                                peer-checked:bg-red-500 
                                peer-checked:text-white 
                                peer-checked:border-red-500 
                                hover:bg-gray-50">
                                30 Hari
                            </div>
                        </label>

                        <!-- Permanen -->
                        <label class="cursor-pointer">
                            <input type="radio" name="duration" value="permanent" class="hidden peer">
                            <div class="text-center border rounded-lg p-2 
                                peer-checked:bg-red-500 
                                peer-checked:text-white 
                                peer-checked:border-red-500 
                                hover:bg-gray-50">
                                Permanen
                            </div>
                        </label>

                    </div>
                </div>

                <!-- ACTION -->
                <div class="flex justify-end gap-2">

                    <button type="button"
                        @click="openSuspend = false"
                        class="px-4 py-2 border rounded-lg text-sm hover:bg-gray-50">
                        Batal
                    </button>

                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600">
                        Tangguhkan Akun
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- RIWAYAT PESANAN -->
    <div class="bg-white rounded-2xl shadow-sm p-6">

        <h4 class="font-semibold mb-4">Riwayat Pesanan</h4>

        <table class="w-full text-sm">

            <thead class="text-gray-400 border-b">
                <tr>
                    <th class="text-left py-2">Kode</th>
                    <th class="text-left py-2">Layanan</th>
                    <th class="text-left py-2">Tanggal</th>
                    <th class="text-left py-2">Waktu</th>
                    <th class="text-left py-2">Total</th>
                    <th class="text-left py-2">Status</th>
                </tr>
            </thead>

            <tbody>

            @forelse($transactions as $trx)
            <tr class="border-b hover:bg-gray-50">

                <!-- KODE -->
                <td>{{ $trx->transaction_code }}</td>

                <!-- LAYANAN -->
                <td>
                    @if($trx->services->count())
                        {{ $trx->services->first()->service_name ?? 'Layanan' }}
                        @if($trx->services->count() > 1)
                            +{{ $trx->services->count()-1 }} lainnya
                        @endif
                    @else
                        -
                    @endif
                </td>

                <!-- TANGGAL -->
                <td>
                    {{ \Carbon\Carbon::parse($trx->service_date)->format('d M Y') }}
                </td>

                <!-- WAKTU -->
                <td>{{ $trx->service_time }}</td>

                <!-- TOTAL -->
                <td>{{ $trx->formatted_total_price }}</td>

                <!-- STATUS -->
                <td>
                    <span class="px-2 py-1 text-xs rounded {{ $trx->status_badge }}">
                        {{ ucfirst(str_replace('_',' ',$trx->status)) }}
                    </span>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-gray-400">
                    Belum ada riwayat pesanan
                </td>
            </tr>
            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection