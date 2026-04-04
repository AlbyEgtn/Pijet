@extends('layouts.customer')

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
    $isBelumBayar = in_array($order->payment_status, ['pending','uploaded']);
    $isDiproses   = in_array($order->order_status, ['ready','assigned','on_the_way','ongoing']);
    $isSelesai    = $order->order_status == 'completed';
    $isBatal      = $order->order_status == 'cancelled';
@endphp

<div class="max-w-xl mx-auto p-4 space-y-4">

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
                @if($isBelumBayar) Menunggu Pembayaran
                @elseif($isDiproses) Sedang Diproses
                @elseif($isSelesai) Selesai
                @elseif($isBatal) Dibatalkan
                @endif
            </p>
        </div>

        <div class="text-2xl">
            @if($isBelumBayar) ⏳
            @elseif($isDiproses) 🚀
            @elseif($isSelesai) ✅
            @elseif($isBatal) ❌
            @endif
        </div>

    </div>

</div>

<!-- ================= PROGRESS TRACKER ================= -->
@if($isDiproses)
<div class="bg-white rounded-2xl shadow p-4">

    <p class="font-semibold mb-3">Progress Layanan</p>

    <div class="space-y-3 text-sm">

        @php
            $steps = [
                'assigned' => 'Terapis mengambil pesanan',
                'on_the_way' => 'Menuju lokasi',
                'ongoing' => 'Sedang berlangsung',
                'completed' => 'Selesai'
            ];
        @endphp

        @foreach($steps as $key => $label)
        <div class="flex items-center gap-3">
            <div class="w-6 h-6 rounded-full flex items-center justify-center
                {{ $order->order_status == $key ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                ✓
            </div>
            <span class="{{ $order->order_status == $key ? 'font-semibold text-blue-600' : '' }}">
                {{ $label }}
            </span>
        </div>
        @endforeach

    </div>

</div>
@endif

<!-- ================= PAYMENT SECTION ================= -->
@if($isBelumBayar)

<div class="bg-white rounded-2xl shadow p-4 space-y-4">

    <h2 class="font-semibold">Pembayaran</h2>

    @if($order->payment_method === 'transfer')

    <!-- COUNTDOWN -->
    <div class="bg-teal-600 text-white text-center rounded-xl p-4">
        <p class="text-xs">Sisa Waktu</p>
        <p id="countdown" class="text-2xl font-bold">00:00:00</p>
    </div>

    <!-- BANK SELECT -->
    <div>
        <label class="text-sm text-gray-500">Pilih Rekening</label>

        <select id="rekeningSelect" class="w-full border rounded p-2 mt-1">
            <option value="">-- Pilih --</option>
            @foreach($accounts as $acc)
            <option 
                data-bank="{{ $acc->bank_name }}"
                data-number="{{ $acc->account_number }}"
                data-holder="{{ $acc->account_holder }}">
                {{ $acc->bank_name }} - {{ $acc->account_number }}
            </option>
            @endforeach
        </select>
    </div>

    <!-- DETAIL -->
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

    @if($order->payment_method === 'cash')
    <div class="bg-yellow-50 p-3 rounded text-sm">
        Bayar langsung ke terapis saat datang
    </div>
    @endif

</div>

@endif

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

@endsection


@push('scripts')
<script>

/* ================= SAFE SELECT ================= */
let selectedRek = "";

document.addEventListener("DOMContentLoaded", function(){

    const select = document.getElementById("rekeningSelect");
    if(!select) return;

    select.addEventListener("change", function(){

        const selected = this.options[this.selectedIndex];
        const detail = document.getElementById("rekeningDetail");

        if(!selected.value){
            detail.classList.add("hidden");
            return;
        }

        document.getElementById("rekBank").innerText = selected.dataset.bank;
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

/* ================= COUNTDOWN ================= */
const el = document.getElementById("countdown");

@if($order->payment_method === 'transfer')
if(el){

    const expired =
        {{ \Carbon\Carbon::parse($order->payment_expired_at)->timestamp * 1000 }};

    function update(){
        let d = expired - Date.now();

        if(d <= 0){
            el.innerText = "Expired";
            return;
        }

        let h = Math.floor(d/3600000);
        let m = Math.floor((d%3600000)/60000);
        let s = Math.floor((d%60000)/1000);

        el.innerText =
            String(h).padStart(2,'0')+":"+
            String(m).padStart(2,'0')+":"+
            String(s).padStart(2,'0');
    }

    update();
    setInterval(update,1000);
}
@endif

</script>
@endpush