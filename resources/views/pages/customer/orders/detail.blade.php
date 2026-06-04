@extends('layouts.customer')

@section('title', 'Detail Pesanan')

@section('content')

{{-- ===================== HERO ===================== --}}
<section class="relative h-[220px] bg-gradient-to-r from-teal-800 via-teal-700 to-teal-600 overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 h-full flex items-center gap-4 text-white">
        <a href="{{ route('customer.orders') }}"
           class="text-xl bg-white/20 p-2 rounded-full hover:bg-white/30 transition">
            ←
        </a>
        <div>
            <h1 class="text-2xl font-semibold">Detail Pesanan</h1>
            <p class="text-sm opacity-90">Status & progress layanan Anda</p>
        </div>
    </div>
</section>


{{-- ===================== HELPERS ===================== --}}
@php
    $steps = [
        'waiting'   => 'Order Dibuat',
        'verified'  => 'Pembayaran',
        'ready'     => 'Siap',
        'assigned'  => 'Terapis Berangkat',
        'ongoing'   => 'Sedang Berjalan',
        'completed' => 'Selesai',
    ];

    // Tentukan step aktif
    if ($order->order_status === 'completed') {
        $current = 'completed';
    } elseif ($order->order_status === 'ongoing') {
        $current = 'ongoing';
    } elseif ($order->order_status === 'assigned') {
        $current = 'assigned';
    } elseif ($order->order_status === 'ready') {
        $current = 'ready';
    } elseif ($order->payment_status === 'verified') {
        $current = 'verified';
    } else {
        $current = 'waiting';
    }

    $keys         = array_keys($steps);
    $currentIndex = array_search($current, $keys);

    // Status card
    [$statusTitle, $statusDesc, $statusIcon, $statusClass] = match ($order->order_status) {
        'completed' => [
            'Layanan Selesai',
            'Terima kasih telah menggunakan layanan kami',
            '🎉',
            'bg-gradient-to-r from-emerald-600 to-teal-700',
        ],
        'ongoing' => [
            'Layanan Sedang Berjalan',
            'Therapist sedang melakukan layanan',
            '💆',
            'bg-gradient-to-r from-teal-600 to-teal-800',
        ],
        'assigned' => [
            'Therapist Sedang Menuju Lokasi',
            'Therapist sedang dalam perjalanan',
            '🚗',
            'bg-gradient-to-r from-teal-700 to-emerald-700',
        ],
        'ready' => [
            'Pesanan Siap Diproses',
            'Menunggu therapist mengambil pesanan',
            '📦',
            'bg-gradient-to-r from-slate-700 to-slate-800',
        ],
        default => $order->payment_status === 'verified'
            ? ['Pembayaran Berhasil', 'Pesanan sedang diproses', '✔', 'bg-gradient-to-r from-teal-700 to-emerald-700']
            : ['Menunggu Pembayaran', 'Silakan selesaikan pembayaran', '⏳', 'bg-gradient-to-r from-gray-700 to-gray-900'],
    };

    // Waktu layanan
    $startedAt   = $order->started_at   ? \Carbon\Carbon::parse($order->started_at)   : null;
    $completedAt = $order->completed_at ? \Carbon\Carbon::parse($order->completed_at) : null;
    $duration    = ($startedAt && $completedAt)
        ? $startedAt->diffInMinutes($completedAt)
        : null;
@endphp


<div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ===================== MAIN ===================== --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- STATUS CARD --}}
        <div class="{{ $statusClass }} rounded-3xl shadow-lg overflow-hidden">
            <div class="p-8 text-white text-center">
                <div class="text-6xl mb-4 animate-bounce">{{ $statusIcon }}</div>
                <h2 class="text-2xl font-bold">{{ $statusTitle }}</h2>
                <p class="text-white/80 mt-2">{{ $statusDesc }}</p>
            </div>
        </div>

        {{-- TRACKING --}}
        <div class="bg-white rounded-3xl shadow-sm hover:shadow-lg transition p-6">
            <div class="flex items-center justify-between gap-2 overflow-x-auto">
                @foreach ($steps as $key => $label)
                    @php
                        $index    = array_search($key, $keys);
                        $isDone   = $index < $currentIndex;
                        $isActive = $index === $currentIndex;
                    @endphp
                    <div class="flex items-center flex-1 min-w-[90px]">
                        <div class="flex flex-col items-center w-full text-center">

                            {{-- Lingkaran step --}}
                            <div @class([
                                'w-12 h-12 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300',
                                'bg-teal-600 text-white shadow-lg'                    => $isDone,
                                'bg-emerald-700 text-white scale-110 shadow-xl animate-pulse' => $isActive,
                                'bg-gray-200 text-gray-400'                           => !$isDone && !$isActive,
                            ])>
                                @if ($isDone) ✓
                                @elseif ($isActive) ●
                                @else ○
                                @endif
                            </div>

                            {{-- Label --}}
                            <p @class([
                                'text-xs mt-3 leading-tight',
                                'text-teal-700 font-semibold' => $isActive,
                                'text-gray-500'               => !$isActive,
                            ])>{{ $label }}</p>
                        </div>

                        @unless ($loop->last)
                            <div @class([
                                'flex-1 h-1 rounded-full mx-2',
                                'bg-green-500' => $index < $currentIndex,
                                'bg-gray-200'  => $index >= $currentIndex,
                            ])></div>
                        @endunless
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ===================== WAKTU LAYANAN ===================== --}}
        @if ($startedAt || $completedAt)
        <div class="bg-white rounded-3xl shadow-sm hover:shadow-lg transition p-6">
            <h3 class="font-semibold text-gray-800 mb-4">⏱ Waktu Layanan</h3>
            <div class="grid grid-cols-3 gap-4 text-center">

                {{-- Mulai --}}
                <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4">
                    <p class="text-xs text-gray-500 mb-1">Mulai</p>
                    @if ($startedAt)
                        <p class="text-xl font-bold text-emerald-600">
                            {{ $startedAt->format('H:i') }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            {{ $startedAt->format('d M Y') }}
                        </p>
                    @else
                        <p class="text-gray-400 text-sm">—</p>
                    @endif
                </div>

                {{-- Durasi --}}
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4">
                    <p class="text-xs text-gray-500 mb-1">Durasi</p>
                    @if ($duration !== null)
                        <p class="text-xl font-bold text-amber-600">
                            @if ($duration >= 60)
                                {{ intdiv($duration, 60) }}j {{ $duration % 60 }}m
                            @else
                                {{ $duration }} mnt
                            @endif
                        </p>
                        <p class="text-xs text-gray-400 mt-1">{{ $duration }} menit</p>
                    @else
                        <p class="text-gray-400 text-sm">—</p>
                    @endif
                </div>

                {{-- Selesai --}}
                <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4">
                    <p class="text-xs text-gray-500 mb-1">Selesai</p>
                    @if ($completedAt)
                        <p class="text-xl font-bold text-blue-600">
                            {{ $completedAt->format('H:i') }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            {{ $completedAt->format('d M Y') }}
                        </p>
                    @else
                        <p class="text-gray-400 text-sm">—</p>
                    @endif
                </div>

            </div>
        </div>
        @endif

    </div>


    {{-- ===================== SIDEBAR ===================== --}}
    <div class="space-y-6">

        {{-- Detail pesanan --}}
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5">
            <h3 class="font-semibold mb-3 text-gray-800">Detail Pesanan</h3>
            <div class="text-sm text-gray-500 space-y-2">
                <p><b>Kode:</b> {{ $order->transaction_code }}</p>
                <p>{{ $order->customer_address }}</p>
                <p>{{ $order->customer_city }}</p>
                <p>
                    {{ $order->services->pluck('service_name')->implode(', ') }}
                </p>                
                <p>
                    {{ \Carbon\Carbon::parse($order->service_date)->format('d M Y') }}
                    • {{ $order->service_time }}
                </p>
            </div>
        </div>

        {{-- Terapis --}}
        @if ($order->terapis)
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-start gap-4">
                    <img
                        src="{{ $order->terapis->user->foto
                            ? asset('storage/'.$order->terapis->user->foto)
                            : 'https://ui-avatars.com/api/?name='.urlencode($order->terapis->user->name) }}"
                        class="w-16 h-16 rounded-2xl object-cover border"
                        alt="Foto Terapis"
                    >
                    <div>
                        <h3 class="font-semibold text-gray-800 text-lg">
                            {{ $order->terapis->user->name }}
                        </h3>
                        <p class="text-sm text-gray-400 mt-1">Terapis Professional</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-yellow-500">⭐</span>
                            <span class="font-semibold text-gray-700">
                                {{ round($order->terapis->user->reviewsReceived()->avg('rating') ?? 0, 1) }}
                            </span>
                            <span class="text-xs text-gray-400">
                                ({{ $order->terapis->user->reviewsReceived()->count() }} ulasan)
                            </span>
                        </div>
                    </div>
                </div>

                @php
                    $alreadyReviewed = \App\Models\TherapistReview::where('customer_id', auth()->id())
                        ->where('therapist_id', $order->terapis->user->id)
                        ->exists();
                @endphp

                @if ($order->order_status === 'completed' && !$alreadyReviewed)
                <button
                    onclick="openReviewModal()"
                    class="bg-yellow-500 hover:bg-yellow-600 transition text-white px-4 py-2 rounded-xl text-sm font-medium"
                >
                    ⭐ Rating
                </button>
                @endif
            </div>
        </div>
        @endif

        {{-- Aksi (cancel / reschedule) --}}
        @if (in_array($order->order_status, ['waiting','ready','assigned']) && $order->payment_status !== 'verified')
        <div class="action-card bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5 space-y-4">

            {{-- Cancel --}}
            <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST">
                @csrf
                <textarea name="cancel_reason"
                    class="w-full border p-2 rounded-xl mb-2"
                    placeholder="Alasan pembatalan..."
                    required></textarea>
                <button class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-xl transition">
                    Batalkan Pesanan
                </button>
            </form>

            {{-- Reschedule --}}
            <form action="{{ route('customer.orders.reschedule', $order->id) }}" method="POST">
                @csrf
                <input type="date" name="new_date" class="w-full border p-2 rounded-xl mb-2" required>
                <input type="time" name="new_time" class="w-full border p-2 rounded-xl mb-2" required>
                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl transition">
                    Reschedule
                </button>
            </form>

        </div>
        @endif

        {{-- Total --}}
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5 flex justify-between font-semibold">
            <span>Total</span>
            <span class="text-teal-600">Rp {{ number_format($order->total_price) }}</span>
        </div>

        {{-- Tombol laporan --}}
        @if ($order->order_status === 'completed')
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-5">
            <button
                onclick="openReportModal()"
                class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl transition font-medium"
            >
                Laporkan Masalah
            </button>
        </div>
        @endif

        {{-- ===================== REPORT MODAL ===================== --}}
        <div id="reportModal"
             class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
            <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden">

                <div class="flex items-center justify-between px-6 py-4 border-b">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Laporkan Terapis</h2>
                        <p class="text-sm text-gray-400">Jelaskan masalah yang terjadi</p>
                    </div>
                    <button onclick="closeReportModal()" class="text-gray-400 hover:text-gray-600 text-xl">✕</button>
                </div>

                <form action="{{ route('customer.report.store', $order->id) }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <div class="space-y-3">
                        <select name="reason" required class="w-full border rounded-2xl p-3 text-sm">
                            <option value="">Pilih alasan laporan</option>
                            <option value="Terapis terlambat">Terapis terlambat</option>
                            <option value="Pelayanan buruk">Pelayanan buruk</option>
                            <option value="Perilaku tidak sopan">Perilaku tidak sopan</option>
                            <option value="Tindakan mencurigakan">Tindakan mencurigakan</option>
                        </select>
                        <textarea name="description" rows="5" required
                            placeholder="Jelaskan detail laporan..."
                            class="w-full border rounded-2xl p-4 text-sm"></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeReportModal()"
                            class="px-4 py-2 rounded-xl border text-gray-600 hover:bg-gray-100">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2 rounded-xl bg-red-500 hover:bg-red-600 text-white">
                            Kirim Report
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>


{{-- ===================== REVIEW MODAL ===================== --}}
<div id="reviewModal"
     class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl w-full max-w-md p-6 relative">

        <button onclick="closeReviewModal()"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">✕</button>

        <h2 class="text-xl font-bold text-gray-800 mb-1">Beri Rating Terapis</h2>
        <p class="text-sm text-gray-400 mb-6">Bagikan pengalaman layanan Anda</p>

        <form action="{{ route('customer.review.store', $order->id) }}" method="POST" class="space-y-5">
            @csrf

            {{-- Bintang --}}
            <div class="text-center">
                <div class="flex justify-center gap-2 text-4xl">
                    @for ($i = 1; $i <= 5; $i++)
                    <button type="button" class="star text-gray-300 transition hover:scale-110" data-value="{{ $i }}">
                        ★
                    </button>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="ratingInput" required>
            </div>

            <textarea name="review" rows="4" required maxlength="500"
                placeholder="Tulis pengalaman Anda..."
                class="w-full border rounded-2xl p-4 focus:ring-2 focus:ring-teal-500 outline-none"></textarea>

            <button type="submit"
                class="w-full bg-teal-600 hover:bg-teal-700 transition text-white py-3 rounded-2xl font-medium">
                Kirim Review
            </button>
        </form>

    </div>
</div>

@endsection


@push('scripts')
<script>
const orderId = {{ $order->id }};

// ===================== UPDATE UI =====================
function updateUI(data) {
    const steps = ['waiting','verified','ready','assigned','ongoing','completed'];
    const current = data.payment_status !== 'verified' ? 'waiting' : data.order_status;
    const currentIndex = steps.indexOf(current);

    document.querySelectorAll('.step').forEach(el => {
        const index = steps.indexOf(el.dataset.step);
        el.className = 'w-8 h-8 rounded-full flex items-center justify-center text-xs step';

        if (index < currentIndex) {
            el.classList.add('bg-green-500','text-white');
            el.innerText = '✓';
        } else if (index === currentIndex) {
            el.classList.add('bg-teal-600','text-white','animate-pulse');
            el.innerText = '●';
        } else {
            el.classList.add('bg-gray-200','text-gray-400');
            el.innerText = '○';
        }
    });
}

// ===================== POLLING =====================
const interval = setInterval(() => {
    fetch(`/customer/orders/${orderId}/status`)
        .then(res => res.json())
        .then(data => {
            updateUI(data);
            if (data.order_status === 'completed') {
                clearInterval(interval);
            }
        })
        .catch(err => console.error(err));
}, 5000);

// ===================== MODAL HELPERS =====================
function openReportModal()  { toggleModal('reportModal',  true);  }
function closeReportModal() { toggleModal('reportModal',  false); }
function openReviewModal()  { toggleModal('reviewModal',  true);  }
function closeReviewModal() { toggleModal('reviewModal',  false); }

function toggleModal(id, show) {
    const el = document.getElementById(id);
    el.classList.toggle('hidden', !show);
    el.classList.toggle('flex',    show);
}

// ===================== STAR RATING =====================
const stars       = document.querySelectorAll('.star');
const ratingInput = document.getElementById('ratingInput');

stars.forEach(star => {
    star.addEventListener('click', () => {
        const value = star.dataset.value;
        ratingInput.value = value;
        stars.forEach(s => {
            s.classList.toggle('text-yellow-400', s.dataset.value <= value);
            s.classList.toggle('text-gray-300',   s.dataset.value >  value);
        });
    });
});
</script>
@endpush