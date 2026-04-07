@extends('layouts.superadmin')

@section('title','Penangguhan')
@section('header','Penangguhan User')

@section('content')

<div class="space-y-6">

    <!-- BREADCRUMB -->
    <div class="text-sm text-gray-400">
        Penangguhan > <span class="text-green-600 capitalize">{{ $type }}</span>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow-sm p-6">

        <!-- HEADER -->
        <form method="GET" class="flex justify-between items-center mb-4">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama / email..."
                   class="border rounded-lg px-3 py-2 text-sm w-64">

            <button class="border px-3 py-2 rounded-lg text-sm">
                Cari
            </button>
        </form>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="text-left text-gray-500 border-b">
                    <tr>
                        <th class="py-2">Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $user)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="py-2">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>

                        <!-- STATUS -->
                        <td>
                            @if($user->is_suspended)
                                <span class="px-2 py-1 bg-red-100 text-red-600 rounded-lg text-xs">
                                    Ditangguhkan
                                </span>
                            @else
                                <span class="px-2 py-1 bg-green-100 text-green-600 rounded-lg text-xs">
                                    Aktif
                                </span>
                            @endif
                        </td>

                        <!-- AKSI -->
                        <td class="text-center">
                            <div class="flex justify-center gap-2">

                                <!-- DETAIL -->
                                @if($user->latestReport)
                                    <a href="{{ route('superadmin.penangguhan.detail', $user->latestReport->id) }}"
                                       class="bg-blue-500 text-white px-3 py-1 rounded-lg text-xs"
                                       onclick="event.stopPropagation();">
                                        Detail
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs italic">
                                        Tidak ada laporan
                                    </span>
                                @endif

                                <!-- SUSPEND / AKTIFKAN -->
                                <form action="{{ route('superadmin.pengguna.suspend', $user->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin mengubah status user ini?')"
                                      onclick="event.stopPropagation();">
                                    @csrf

                                    <button type="submit"
                                        class="{{ $user->is_suspended ? 'bg-green-500' : 'bg-red-500' }} text-white px-3 py-1 rounded-lg text-xs">
                                        {{ $user->is_suspended ? 'Aktifkan' : 'Suspend' }}
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty

                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-400">
                            Tidak ada data pengguna
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        <!-- PAGINATION -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>

    </div>

</div>

@endsection