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
        <div class="flex justify-between items-center mb-4">
            <input type="text" placeholder="Cari nama / email..." 
                   class="border rounded-lg px-3 py-2 text-sm w-64">

            <button class="border px-3 py-2 rounded-lg text-sm">
                Filter
            </button>
        </div>

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

                    @foreach($users as $user)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="py-2">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>

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

                        <td class="text-center">
                            <form action="{{ route('superadmin.pengguna.suspend', $user->id) }}" method="POST">
                                @csrf
                                <button class="{{ $user->is_suspended ? 'bg-green-500' : 'bg-red-500' }} text-white px-3 py-1 rounded-lg text-xs">
                                    {{ $user->is_suspended ? 'Aktifkan' : 'Suspend' }}
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach

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