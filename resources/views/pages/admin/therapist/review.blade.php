@extends('layouts.admin')

@section('title','Review  ')
@section('header','Review ')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-6">
        Rating & Ulasan Terapis
    </h1>

    <div class="bg-white rounded-xl shadow p-4">
        <table class="w-full text-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-3 py-2">Terapis</th>
                    <th class="px-3 py-2">User</th>
                    <th class="px-3 py-2">Rating</th>
                    <th class="px-3 py-2">Ulasan</th>
                    <th class="px-3 py-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reviews as $review)
                    <tr class="border-b">
                        <td class="px-3 py-2">
                            {{ $review->therapist->name ?? '-' }}
                        </td>

                        <td class="px-3 py-2">
                            {{ $review->user->name ?? '-' }}
                        </td>

                        <td class="px-3 py-2">
                            ⭐ {{ $review->rating }}/5
                        </td>

                        <td class="px-3 py-2">
                            {{ $review->comment }}
                        </td>

                        <td class="px-3 py-2">
                            {{ $review->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            Belum ada ulasan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    </div>
</div>
@endsection