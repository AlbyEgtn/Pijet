@extends('layouts.superadmin')

@section('title','Aduan Pengguna')
@section('header','Aduan Pengguna')

@section('content')

<div class="space-y-6">

    <!-- BREADCRUMB -->
    <div class="text-sm text-gray-400">
        Penangguhan > <span class="text-green-600">Aduan Pengguna</span>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow-sm p-6">

        <!-- SEARCH + FILTER -->
        <div class="flex justify-between items-center mb-4">
            <input type="text" placeholder="Cari nama, laporan..."
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
                        <th class="py-2">Nama Pelapor</th>
                        <th>Tipe</th>
                        <th>Alasan</th>
                        <th>Waktu</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($reports as $report)
                <tr class="border-b hover:bg-gray-50">

                    <td class="py-2">
                        {{ $report->user->name }}
                    </td>

                    <td>
                        <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded-lg text-xs">
                            {{ ucfirst($report->user->role) }}
                        </span>
                    </td>

                    <td>
                        {{ $report->reason }}
                    </td>

                    <td>
                        {{ $report->created_at->format('d M Y') }}
                    </td>

                    <td class="text-center space-x-2">

                        <!-- DETAIL -->
                        <a href="{{ route('superadmin.penangguhan.detail', $report->id) }}"
                        class="bg-blue-500 text-white px-3 py-1 rounded-lg text-xs">
                            Detail
                        </a>

                        <!-- SUSPEND -->
                        <form action="{{ route('superadmin.pengguna.suspend', $report->reportedUser->id) }}" 
                            method="POST" class="inline">
                            @csrf
                            <button class="bg-red-500 text-white px-3 py-1 rounded-lg text-xs">
                                Suspend
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
            {{ $reports->links() }}
        </div>

    </div>

</div>

@endsection