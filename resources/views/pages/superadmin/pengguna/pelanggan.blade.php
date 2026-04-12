@extends('layouts.superadmin')

@section('title','Pengguna')
@section('header','Pengguna')

@section('content')

<div class="space-y-6">

    <!-- BREADCRUMB -->
    <div class="text-sm text-gray-400">
        Pengguna > <span class="text-green-600">Pelanggan</span>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow-sm p-6">

        <h2 class="text-lg font-semibold mb-4">
            Data Akun Pelanggan
        </h2>

        <!-- SEARCH -->
        <div class="flex justify-between items-center mb-4">

            <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 w-80">
                <input type="text"
                    placeholder="Cari nomor id, nama, kota, dll"
                    class="bg-transparent outline-none text-sm w-full">
                
                <button class="text-green-600">
                    🔍
                </button>
            </div>

            <button class="border px-4 py-2 rounded-lg text-sm hover:bg-gray-50">
                Filter
            </button>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="text-gray-400 border-b">
                    <tr class="border-b hover:bg-gray-50">
                        <th class="text-left py-2">Nomor ID</th>
                        <th class="text-left py-2">Nama Lengkap</th>
                        <th class="text-left py-2">Tanggal Lahir</th>
                        <th class="text-left py-2">Email</th>
                        <th class="text-left py-2">Jenis Kelamin</th>
                        <th class="text-left py-2">Kota/Kabupaten</th>
                        <th class="text-left py-2">Status</th>
                        <th class="text-left py-2">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700">

                    @foreach($users as $user)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="py-2">
                            {{ $user->kode }}
                        </td>

                        <td>
                            {{ $user->name }}
                        </td>

                        <td>
                            {{ $user->birth_date 
                                ? \Carbon\Carbon::parse($user->birth_date)->format('d M Y') 
                                : '-' }}
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>
                            {{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </td>

                        <td>
                            {{ $user->city ?? '-' }}
                        </td>

                        <td>
                            @if($user->is_suspended)
                                <span class="bg-red-100 text-red-600 px-2 py-1 text-xs rounded">
                                    Ditangguhkan
                                </span>
                            @else
                                <span class="bg-green-100 text-green-600 px-2 py-1 text-xs rounded">
                                    Aktif
                                </span>
                            @endif
                        </td>

                        <td class="flex gap-3 py-2 items-center">

                            <!-- DETAIL -->
                            <a href="{{ route('superadmin.pengguna.detail', [$type, $user->id]) }}"
                            class="text-blue-500">
                                👁
                            </a>

                            <!-- WARNING -->
                            <span class="text-yellow-500 cursor-pointer">
                                ⚠
                            </span>

                            <!-- STATUS ICON -->
                            @if($user->is_suspended)
                                <span class="text-green-500" title="Akun Ditangguhkan">
                                    🔒
                                </span>
                            @else
                                <span class="text-red-500" title="Akun Aktif">
                                    ⛔
                                </span>
                            @endif

                        </td>

                    </tr>
                    @endforeach

                    </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="flex justify-between items-center mt-4 text-sm text-gray-400">

            <span>Halaman 1 dari 53</span>

            <div class="flex gap-2">

                <span class="px-3 py-1 bg-green-600 text-white rounded">1</span>
                <span class="px-3 py-1 bg-gray-100 rounded">2</span>
                <span class="px-3 py-1 bg-gray-100 rounded">3</span>
                <span class="px-3 py-1 bg-gray-100 rounded">...</span>
                <span class="px-3 py-1 bg-gray-100 rounded">53</span>

            </div>

        </div>

    </div>

</div>

@endsection