@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-6">
        Verifikasi Terapis
    </h1>

    <div class="bg-white rounded-xl shadow p-4">
        <table class="w-full text-sm">
            <thead class="bg-yellow-500 text-white">
                <tr>
                    <th class="px-3 py-2">Nama</th>
                    <th class="px-3 py-2">Email</th>
                    <th class="px-3 py-2">Ponsel</th>
                    <th class="px-3 py-2">Status</th>
                    <th class="px-3 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($therapists as $therapist)
                    <tr class="border-b">
                        <td class="px-3 py-2">{{ $therapist->name }}</td>
                        <td class="px-3 py-2">{{ $therapist->email }}</td>
                        <td class="px-3 py-2">{{ $therapist->phone }}</td>

                        <td class="px-3 py-2">
                            @if ($therapist->is_verified)
                                <span class="text-green-600 font-semibold">
                                    ✔ Verified
                                </span>
                            @else
                                <span class="text-yellow-600 font-semibold">
                                    Pending
                                </span>
                            @endif
                        </td>

                        <td class="px-3 py-2 text-center flex justify-center gap-2">
                            @if (!$therapist->is_verified)
                                <!-- Approve -->
                                <form action="{{ route('admin.therapist.verify', $therapist->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-green-500 text-white px-3 py-1 rounded">
                                        Approve
                                    </button>
                                </form>

                                <!-- Reject -->
                                <form action="{{ route('admin.therapist.reject', $therapist->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                                        Reject
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            Tidak ada data verifikasi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $therapists->links() }}
        </div>
    </div>
</div>
@endsection