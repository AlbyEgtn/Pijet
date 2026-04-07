@extends('layouts.terapis')

@section('title','Pesanan Saya')
@section('header',' Pesanan Saya ')

@section('content')

<div class="p-4 space-y-4 relative z-10">

    <h1 class="text-lg font-semibold">Pesanan Saya</h1>

    <!-- ================= FILTER ================= -->
    <div class="flex gap-2 overflow-x-auto">

        <a href="{{ route('terapis.pesanan.saya') }}"
           class="px-3 py-1 rounded-full text-sm
           {{ request('status') == null ? 'bg-teal-600 text-white' : 'bg-gray-200' }}">
            Semua
        </a>

        <a href="{{ route('terapis.pesanan.saya', ['status'=>'assigned']) }}"
           class="px-3 py-1 rounded-full text-sm
           {{ request('status') == 'assigned' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
            Diambil
        </a>

        <a href="{{ route('terapis.pesanan.saya', ['status'=>'cancelled']) }}"
           class="px-3 py-1 rounded-full text-sm
           {{ request('status') == 'cancelled' ? 'bg-red-500 text-white' : 'bg-gray-200' }}">
            Dibatalkan
        </a>

        <a href="{{ route('terapis.pesanan.saya', ['status'=>'completed']) }}"
           class="px-3 py-1 rounded-full text-sm
           {{ request('status') == 'completed' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
            Selesai
        </a>

    </div>

    <!-- ================= LIST ================= -->
    @forelse($transactions as $trx)
    <div class="bg-white p-5 rounded-2xl shadow-sm border space-y-3 hover:shadow-md transition">

        <!-- HEADER -->
        <div class="flex justify-between items-start">
            <div>
                <p class="font-semibold text-gray-800">{{ $trx->customer_name }}</p>
                <p class="text-xs text-gray-400">
                    ID {{ $trx->transaction_code }}
                </p>
            </div>

<<<<<<< HEAD
            <span class="text-xs px-3 py-1 rounded-full font-medium
                @if($trx->status == 'proses') bg-blue-100 text-blue-600
                @elseif($trx->status == 'lunas') bg-green-100 text-green-600
                @else bg-gray-100 text-gray-600
                @endif">
                {{ ucfirst(str_replace('_',' ',$trx->status)) }}
=======
            <!-- ✅ FIX STATUS -->
            <span class="text-xs px-2 py-1 rounded
                @if($trx->order_status == 'assigned') bg-blue-100 text-blue-600
                @elseif($trx->order_status == 'completed') bg-green-100 text-green-600
                @elseif($trx->order_status == 'cancelled') bg-red-100 text-red-600
                @else bg-gray-100 text-gray-600
                @endif
            ">
                {{ ucfirst(str_replace('_',' ',$trx->order_status)) }}
>>>>>>> df56f5da5624620b191301cd14ab1289247f314f
            </span>
        </div>

        <!-- DETAIL -->
<<<<<<< HEAD
        <div class="text-sm text-gray-500 space-y-1">
            <p>📅 {{ $trx->service_date }} • {{ $trx->service_time }}</p>
            <p>📍 {{ $trx->customer_address }}</p>
=======
        <div class="text-sm text-gray-600">
            <p>
                {{ \Carbon\Carbon::parse($trx->service_date)->format('d M Y') }}
                • {{ $trx->service_time }}
            </p>
            <p>{{ $trx->customer_address }}</p>
>>>>>>> df56f5da5624620b191301cd14ab1289247f314f
        </div>

        <!-- TOTAL -->
        <div class="flex justify-between items-center font-semibold text-gray-700">
            <span>Total</span>
            <span class="text-teal-600">
                Rp{{ number_format($trx->total_price,0,',','.') }}
            </span>
        </div>

        <!-- ACTION -->
        <div class="flex gap-2 pt-2">

            <a href="{{ route('terapis.pesanan.saya.detail', $trx->id) }}"
            class="flex-1 text-center bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-lg transition">
                Detail
            </a>

<<<<<<< HEAD
            @if($trx->status == 'proses')
            <button 
                type="button"
                data-id="{{ $trx->id }}"
                class="btn-cancel flex-1 border border-red-500 text-red-500 py-2 rounded-lg hover:bg-red-50 transition">
                Batalkan
            </button>
=======
            <!-- ✅ BATALKAN -->
            @if(in_array($trx->order_status, ['assigned','on_the_way']))
            <form action="{{ route('terapis.pesanan.batal', $trx->id) }}" method="POST" class="flex-1">
                @csrf
                <button class="w-full border border-red-500 text-red-500 py-2 rounded-lg hover:bg-red-50">
                    Batalkan
                </button>
            </form>
>>>>>>> df56f5da5624620b191301cd14ab1289247f314f
            @endif

        </div>

    </div>
    @empty
    <div class="text-center text-gray-500 mt-10">
        Belum ada pesanan
    </div>
    @endforelse

</div>

<!-- ================= MODAL ================= -->
<div id="cancelModal"
     class="fixed inset-0 bg-black/50 hidden z-[9999] flex items-center justify-center">

    <div class="bg-white w-full max-w-md rounded-2xl p-5 space-y-4 animate-scaleIn">

        <h2 class="font-semibold text-lg text-gray-800">
            Batalkan Pesanan
        </h2>

        <!-- WARNING -->
        <div class="bg-yellow-50 text-yellow-700 p-3 rounded-lg text-sm">
            Pastikan keputusan ini sudah benar.
        </div>

        <!-- ERROR -->
        <div id="errorMsg" class="hidden text-red-500 text-sm"></div>

        <!-- REASON -->
        <div class="space-y-2 text-sm">
            <p class="font-medium text-gray-700">Pilih Alasan:</p>

            @foreach(['Sakit','Kepentingan','Tidak Mau','Lainnya'] as $r)
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="reason" value="{{ $r }}" class="accent-teal-600">
                <span>{{ $r }}</span>
            </label>
            @endforeach
        </div>

        <!-- INPUT LAINNYA -->
        <div id="otherInput" class="hidden">
            <textarea id="cancel_note"
                class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-teal-500"
                placeholder="Tuliskan alasan lainnya..."></textarea>
        </div>

        <!-- ACTION -->
        <div class="flex gap-2 pt-2">

            <button id="closeModal"
                class="flex-1 border py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                Batal
            </button>

            <form id="cancelForm" method="POST" class="flex-1">
                @csrf
                <button type="button"
                    id="submitCancel"
                    class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg">
                    Ya, Batalkan
                </button>
            </form>

        </div>

    </div>
</div>

@endsection


@push('scripts')
<script>
let selectedId = null;

document.addEventListener("click", function(e){

    const modal = document.getElementById("cancelModal");

    // buka modal
    const btn = e.target.closest(".btn-cancel");
    if(btn){
        selectedId = btn.dataset.id;
        modal.classList.remove("hidden");
        return;
    }

    // klik background = close
    if(e.target.id === "cancelModal"){
        modal.classList.add("hidden");
        return;
    }

    // tombol batal
    if(e.target.id === "closeModal"){
        modal.classList.add("hidden");
        return;
    }

    // show input lainnya
    if(e.target.name === "reason"){
        if(e.target.value === "Lainnya"){
            document.getElementById("otherInput").classList.remove("hidden");
        } else {
            document.getElementById("otherInput").classList.add("hidden");
        }
    }

    // submit
    if(e.target.id === "submitCancel"){

        let reason = document.querySelector('input[name="reason"]:checked');
        let note = document.getElementById("cancel_note").value;
        let error = document.getElementById("errorMsg");

        error.classList.add("hidden");

        if(!reason){
            error.innerText = "Silakan pilih alasan terlebih dahulu.";
            error.classList.remove("hidden");
            return;
        }

        if(reason.value === "Lainnya" && note.trim() === ""){
            error.innerText = "Isi alasan lainnya.";
            error.classList.remove("hidden");
            return;
        }

        let form = document.getElementById("cancelForm");
        form.action = `/terapis/pesanan/${selectedId}/batal`;

        let inputReason = document.createElement("input");
        inputReason.type = "hidden";
        inputReason.name = "reason";
        inputReason.value = reason.value;

        let inputNote = document.createElement("input");
        inputNote.type = "hidden";
        inputNote.name = "note";
        inputNote.value = note;

        form.appendChild(inputReason);
        form.appendChild(inputNote);

        form.submit();
    }

});
</script>
@endpush