@extends('layouts.customer')

@section('title','Pembayaran  ')
@section('header','Pembayaran ')

@section('content')

<!-- ================= HEADER ================= -->
<div class="bg-gradient-to-r from-teal-700 to-teal-500 text-white p-5 shadow-md flex items-center gap-4">
    <a href="{{ route('customer.orders') }}" class="text-xl">←</a>
    <div>
        <h1 class="font-semibold text-lg">Detail Pesanan</h1>
        <p class="text-xs opacity-80">Monitoring status & pembayaran</p>
    </div>
</div>

@php
    $isBelumBayar  = in_array($order->payment_status, ['pending','uploaded']);
    $isPaid        = $order->payment_status == 'verified';
    $isDiproses    = in_array($order->order_status, ['ready','assigned','on_the_way','ongoing']);
    $isSelesai     = $order->order_status == 'completed';
    $isBatal       = $order->order_status == 'cancelled';

    // Flag utama: apakah pesanan ini milik terapis langsung
    $hasTherapist  = isset($order->therapist_id) && $order->therapist_id;
@endphp

<div class="max-w-7xl mx-auto px-6 py-6 grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 space-y-6">

        <!-- ================= STATUS CARD ================= -->
        <div class="bg-white rounded-2xl shadow p-4 border-l-4
            @if($isBelumBayar) border-yellow-400
            @elseif($isDiproses) border-blue-400
            @elseif($isSelesai) border-green-400
            @elseif($isBatal) border-red-400
            @endif
        ">

            <div class="flex justify-between items-center">

                <div>
                    <p class="text-sm text-gray-500">Status Pesanan</p>
                    <p class="font-semibold text-lg">
                        @if($isBelumBayar)
                            Menunggu Pembayaran
                        @elseif($isPaid)
                            Pembayaran Berhasil
                        @elseif($isDiproses)
                            Sedang Diproses
                        @elseif($isSelesai)
                            Selesai
                        @elseif($isBatal)
                            Dibatalkan
                        @endif
                    </p>
                </div>

                <div class="text-2xl">
                    @if($isBelumBayar)
                    @elseif($isDiproses)
                    @elseif($isSelesai)
                    @elseif($isBatal)
                    @endif
                </div>

            </div>

        </div>


        <!-- ================= PROGRESS TRACKER ================= -->
        @if(!$isBatal)

        <div class="bg-white rounded-xl border shadow-sm p-4">

            <p class="text-sm font-semibold mb-4">Tracking Pesanan</p>

            @php
                // Jika ada therapist_id, skip step upload & verifikasi 
                if($hasTherapist){
                    $steps = [
                        'waiting'  => 'Order',
                        'ready'    => 'Siap',
                        'assigned' => 'Ambil',
                    ];
                }else{
                    $steps = [
                        'waiting'  => 'Order',
                        'uploaded' => 'Upload',
                        'verified' => 'Verifikasi',
                        'ready'    => 'Siap',
                        'assigned' => 'Ambil',
                    ];
                }

                if($order->payment_status == 'pending'){
                    $current = 'waiting';
                }
                elseif($order->payment_status == 'uploaded'){
                    $current = $hasTherapist ? 'waiting' : 'uploaded';
                }
                elseif($order->payment_status == 'verified' && $order->order_status == 'ready'){
                    $current = 'ready';
                }
                elseif($order->order_status == 'assigned'){
                    $current = 'assigned';
                }
                else{
                    $current = $hasTherapist ? 'waiting' : 'verified';
                }

                $keys         = array_keys($steps);
                $currentIndex = array_search($current, $keys);
            @endphp

            <div class="flex items-center justify-between">

                @foreach($steps as $key => $label)

                @php
                    $index    = array_search($key, $keys);
                    $isDone   = $index < $currentIndex;
                    $isActive = $index == $currentIndex;
                @endphp

                <div class="flex-1 flex items-center">

                    <!-- CIRCLE -->
                    <div class="flex flex-col items-center text-center">

                        <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs
                            {{ $isDone   ? 'bg-green-500 text-white' : '' }}
                            {{ $isActive ? 'bg-blue-500 text-white animate-pulse' : '' }}
                            {{ (!$isDone && !$isActive) ? 'bg-gray-200 text-gray-400' : '' }}
                        ">
                            @if($isDone) ✓
                            @elseif($isActive) ●
                            @else ○
                            @endif
                        </div>

                        <p class="text-[10px] mt-1
                            {{ $isActive ? 'text-blue-600 font-semibold' : 'text-gray-500' }}">
                            {{ $label }}
                        </p>

                    </div>

                    <!-- LINE -->
                    @if(!$loop->last)
                    <div class="flex-1 h-1 mx-1
                        {{ $isDone ? 'bg-green-500' : 'bg-gray-200' }}">
                    </div>
                    @endif

                </div>

                @endforeach

            </div>

        </div>

        @endif


        <!-- ================= PAYMENT SECTION ================= -->
        @if($isBelumBayar)

        <div class="bg-white rounded-2xl shadow p-4 space-y-4">

            <h2 class="font-semibold">Pembayaran</h2>

            {{-- Transfer + tidak ada therapist_id: tampilkan countdown, rekening, upload --}}
            @if($order->payment_method === 'transfer' && !$hasTherapist)

            <!-- COUNTDOWN -->
            <div class="bg-teal-600 text-white text-center rounded-xl p-4">
                <p class="text-xs">Sisa Waktu</p>
                <p id="countdown" class="text-2xl font-bold">00:00:00</p>
            </div>

            {{-- ================= BANK INFO ================= --}}
            @if($order->payment_method === 'transfer' && (!isset($order->therapist_id) || !$order->therapist_id))
            <div class="bg-white rounded-2xl shadow p-5 space-y-4">

                <h2 class="font-semibold">Transfer Bank</h2>

                @if($order->companyAccount)
                <div class="bg-gray-50 p-4 rounded-lg text-sm space-y-1">
                    <p><b>Bank:</b> {{ $order->companyAccount->bank_name }}</p>
                    <p><b>No. Rekening:</b> {{ $order->companyAccount->account_number }}</p>
                    <p><b>Atas Nama:</b> {{ $order->companyAccount->account_holder }}</p>
                </div>

                <button
                    onclick="navigator.clipboard.writeText('{{ $order->companyAccount->account_number }}').then(() => alert('Nomor rekening berhasil disalin'))"
                    class="text-sm bg-gray-100 px-3 py-1 rounded-lg">
                    Salin Nomor Rekening
                </button>
                @else
                <p class="text-sm text-red-500">Rekening tujuan tidak ditemukan.</p>
                @endif

                @if($order->payment_status === 'uploaded')
                <p class="text-xs text-green-600">
                    Bukti sudah diupload, menunggu verifikasi admin
                </p>
                @endif

            </div>
            @endif

            <!-- DETAIL REKENING -->
            <div id="rekeningDetail" class="hidden bg-gray-50 p-3 rounded text-sm space-y-1">
                <p><b>Bank:</b> <span id="rekBank"></span></p>
                <p><b>No:</b> <span id="rekNumber"></span></p>
                <p><b>Nama:</b> <span id="rekHolder"></span></p>
            </div>

            <!-- UPLOAD -->
            <form action="{{ route('customer.upload.payment',$order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="payment_proof" name="payment_proof" class="w-full border p-2 rounded">
                <button class="mt-3 w-full bg-teal-600 text-white py-2 rounded">
                    Upload Bukti
                </button>
            </form>

            @endif

            {{-- Cash ATAU ada therapist_id: tampilkan info bayar langsung --}}
            @if($order->payment_method === 'cash' || $hasTherapist)
            <div class="bg-yellow-50 p-3 rounded text-sm">
                Bayar langsung ke terapis saat datang
            </div>
            @endif

        </div>

        @endif

    </div>


    <div class="space-y-6">

        <!-- ================= ORDER SUMMARY ================= -->
        <div class="bg-white rounded-2xl shadow p-4 space-y-3">

            <h2 class="font-semibold">Detail Pesanan</h2>

            <div class="text-sm space-y-1 text-gray-600">
                <p>{{ $order->customer_address }}</p>
                <p>{{ $order->customer_city }}</p>
                <p>{{ $order->service_date }} • {{ $order->service_time }}</p>
            </div>

        </div>

        <!-- ================= SERVICES ================= -->
        <div class="bg-white rounded-2xl shadow p-4">

            <h2 class="font-semibold mb-3">Layanan</h2>

            @foreach($order->services as $service)
            <div class="flex justify-between text-sm mb-2">
                <span>{{ $service->service_name }}</span>
                <span class="text-gray-500">{{ $service->duration }} menit</span>
            </div>
            @endforeach

        </div>

        <!-- ================= TOTAL ================= -->
        <div class="bg-white rounded-2xl shadow p-4 flex justify-between font-semibold">
            <span>Total</span>
            <span class="text-teal-600">Rp {{ number_format($order->total_price) }}</span>
        </div>

        <!-- ================= FINAL STATE ================= -->
        @if($isSelesai)
        <div class="bg-green-100 text-green-700 p-4 rounded-xl text-center">
            Terima kasih! Layanan selesai 🎉
        </div>
        @endif

        @if($isBatal)
        <div class="bg-red-100 text-red-700 p-4 rounded-xl text-center">
            Pesanan dibatalkan
        </div>
        @endif

    </div>

</div>

@endsection


@push('scripts')
<script>

/* ================= SELECT REKENING ================= */
{{-- Hanya jalankan jika tidak ada therapist_id --}}
@if(!$hasTherapist)

let selectedRek = "";

document.addEventListener("DOMContentLoaded", function(){

    const select = document.getElementById("rekeningSelect");
    if(!select) return;

    select.addEventListener("change", function(){

        const selected = this.options[this.selectedIndex];
        const detail   = document.getElementById("rekeningDetail");

        if(!selected.value){
            detail.classList.add("hidden");
            return;
        }

        document.getElementById("rekBank").innerText   = selected.dataset.bank;
        document.getElementById("rekNumber").innerText = selected.dataset.number;
        document.getElementById("rekHolder").innerText = selected.dataset.holder;

        selectedRek = selected.dataset.number;
        detail.classList.remove("hidden");

    });

});


/* ================= COPY ================= */
function copyRek(){

    if(!selectedRek){
        alert("Pilih rekening dulu");
        return;
    }

    navigator.clipboard.writeText(selectedRek);
    alert("Berhasil disalin");

}

@endif


/* ================= COUNTDOWN ================= */
{{-- Countdown hanya jalan jika transfer DAN tidak ada therapist_id --}}
@if($order->payment_method === 'transfer' && !$hasTherapist)

const el = document.getElementById("countdown");

if(el){

    const expired =
        {{ \Carbon\Carbon::parse($order->payment_expired_at)->timestamp * 1000 }};

    function update(){

        let d = expired - Date.now();

        if(d <= 0){
            el.innerText = "Expired";
            return;
        }

        let h = Math.floor(d / 3600000);
        let m = Math.floor((d % 3600000) / 60000);
        let s = Math.floor((d % 60000) / 1000);

        el.innerText =
            String(h).padStart(2,'0') + ":" +
            String(m).padStart(2,'0') + ":" +
            String(s).padStart(2,'0');

    }

    update();
    setInterval(update, 1000);

}

@endif

</script>
@endpush