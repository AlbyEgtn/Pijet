@extends('layouts.superadmin')

@section('title','Layanan')
@section('header','Layanan')

@section('content')
@php use Illuminate\Support\Str; @endphp
<div class="space-y-8">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-teal-600 to-teal-800 text-white p-6 rounded-2xl shadow flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold">Daftar Layanan Utama</h2>
            <p class="text-sm text-teal-100">Kelola layanan utama sistem</p>
        </div>
        <button onclick="toggleModal('serviceModal', true)"
            class="bg-white text-teal-700 px-4 py-2 rounded-lg font-medium hover:bg-teal-100">
            + Buat Layanan
        </button>
    </div>

    {{-- GRID --}}
    <div class="grid grid-cols-3 gap-6">
        @foreach($services as $service)
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden group">

            <div class="h-40 overflow-hidden">
                <img 
                    src="{{ 
                        $service->image 
                            ? (Str::startsWith($service->image, 'http') 
                                ? $service->image 
                                : asset('storage/'.$service->image)) 
                            : 'https://via.placeholder.com/400x300' 
                    }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                >
                    
            </div>

            <div class="p-4">
                <div class="flex justify-between items-center mb-2">

                    <span class="bg-teal-100 text-teal-700 text-xs px-2 py-1 rounded-full">
                        {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>

                    <div class="relative">
                        <button onclick="toggleMenu(event, {{ $service->id }})"
                            class="text-gray-400 text-xl px-2">⋮</button>

                        <div id="menu-{{ $service->id }}"
                            class="hidden absolute right-0 mt-2 w-36 bg-white border rounded-lg shadow-lg z-50">

                            <button onclick="openEditModal(
                                    {{ $service->id }},
                                    @js($service->name),
                                    '{{ $service->price }}',
                                    '{{ $service->duration }}',
                                    @js($service->description),
                                    '{{ $service->image }}'
                                )"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                Edit
                            </button>

                            <button onclick="openDeleteModal({{ $service->id }})"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <h3 class="font-semibold text-lg text-gray-800">{{ $service->name }}</h3>
                <p class="text-sm text-gray-500 mb-3 line-clamp-2">{{ $service->description }}</p>

                <div class="flex justify-between items-center text-sm">
                    <span class="text-teal-700 font-semibold">Rp {{ number_format($service->price,0,',','.') }}</span>
                    <span class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $service->duration }} Menit</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div class="flex justify-between items-center mt-6">
        @if ($services->onFirstPage())
            <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg text-sm">← Previous</span>
        @else
            <a href="{{ $services->previousPageUrl() }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm">← Previous</a>
        @endif

        <span class="text-sm text-gray-500">Halaman {{ $services->currentPage() }} dari {{ $services->lastPage() }}</span>

        @if ($services->hasMorePages())
            <a href="{{ $services->nextPageUrl() }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm">Next →</a>
        @else
            <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg text-sm">Next →</span>
        @endif
    </div>

</div>


{{-- ===== LAYANAN TAMBAHAN ===== --}}
<div class="space-y-6 mt-12">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold">Layanan Tambahan</h2>
        <button onclick="toggleModal('additionalServiceModal', true)"
            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg">
            + Tambah Layanan
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="text-gray-400 text-xs uppercase bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">Harga</th>
                    <th class="px-4 py-3 text-left">Durasi</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($additionalServices as $service)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium">{{ $service->name }}</td>
                    <td class="px-4 py-3 text-teal-600">Rp {{ number_format($service->price,0,',','.') }}</td>
                    <td class="px-4 py-3">{{ $service->duration }} Menit</td>
                    <td class="px-4 py-3 text-right">
                        <button
                            onclick="openEditAdditionalModal(this)"
                            data-id="{{ $service->id }}"
                            data-name="{{ $service->name }}"
                            data-price="{{ $service->price }}"
                            data-duration="{{ $service->duration }}"
                            data-description="{{ $service->description }}"
                            class="text-blue-500 text-sm">
                            Edit
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


{{-- ===== MODAL TAMBAH LAYANAN UTAMA ===== --}}
<div id="serviceModal"
    class="fixed inset-0 hidden items-center justify-center bg-black/30 z-50 backdrop-blur-sm px-4">
    <div class="bg-white w-full max-w-md rounded-xl shadow-lg flex flex-col max-h-[90vh]">

        <div class="flex justify-between items-center px-5 py-4 border-b">
            <h2 class="font-semibold text-base">Buat Layanan</h2>
            <button onclick="toggleModal('serviceModal', false)" class="text-gray-400 hover:text-gray-700">✕</button>
        </div>

        <form id="serviceForm"
            action="{{ route('superadmin.services.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="flex-1 overflow-y-auto px-5 py-4 space-y-4">

            @csrf
            <input type="hidden" name="is_additional" value="0">

            <div>
                <label class="text-xs text-gray-500">Nama Layanan</label>
                <input type="text" name="name"
                    class="w-full border rounded-lg px-3 py-2 mt-1 text-sm focus:ring-2 focus:ring-teal-500 outline-none">
            </div>

            <div>
                <label class="text-xs text-gray-500">Gambar</label>
                <input type="file" name="image" id="imageInput" accept="image/*" class="w-full text-sm mt-1">
                <img id="previewImage" class="mt-2 rounded-lg hidden max-h-32 object-cover w-full">
            </div>

            <div>
                <label class="text-xs text-gray-500">Harga</label>
                <input type="number" name="price"
                    class="w-full border rounded-lg px-3 py-2 mt-1 text-sm focus:ring-2 focus:ring-teal-500 outline-none">
            </div>

            <div>
                <label class="text-xs text-gray-500">Durasi</label>
                <div class="flex gap-3 mt-2 text-sm">
                    <label class="flex items-center gap-1"><input type="radio" name="duration" value="60"> 60m</label>
                    <label class="flex items-center gap-1"><input type="radio" name="duration" value="90"> 90m</label>
                    <label class="flex items-center gap-1"><input type="radio" name="duration" value="120"> 120m</label>
                </div>
            </div>

            <div>
                <label class="text-xs text-gray-500">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full border rounded-lg px-3 py-2 mt-1 text-sm focus:ring-2 focus:ring-teal-500 outline-none"></textarea>
            </div>
        </form>

        <div class="px-5 py-4 border-t flex justify-end">
            <button type="submit" form="serviceForm"
                class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm">
                Simpan
            </button>
        </div>
    </div>
</div>


{{-- ===== MODAL EDIT LAYANAN UTAMA ===== --}}
<div id="editServiceModal"
    class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">
    <div class="bg-white w-[500px] rounded-xl p-6 shadow-lg">

        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-lg">Edit Layanan</h2>
            <button onclick="toggleModal('editServiceModal', false)">✕</button>
        </div>

        <form id="editServiceForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="text-sm">Nama Layanan</label>
                <input type="text" name="name" id="edit_name" class="w-full border p-2 rounded mt-1">
            </div>

            <div>
                <label class="text-sm">Upload Gambar</label>
                <input type="file" name="image" id="edit_image" accept="image/*" class="w-full border p-2 rounded mt-1">
                {{-- Preview image edit --}}
                <img id="edit_preview" class="mt-2 rounded-lg hidden max-h-32 object-cover w-full">
            </div>

            <div>
                <label class="text-sm">Harga</label>
                <input type="number" name="price" id="edit_price" class="w-full border p-2 rounded mt-1">
            </div>

            <div>
                <label class="text-sm">Durasi</label>
                <div class="flex gap-4 mt-2">
                    <label><input type="radio" name="duration" value="60"> 60 Menit</label>
                    <label><input type="radio" name="duration" value="90"> 90 Menit</label>
                    <label><input type="radio" name="duration" value="120"> 120 Menit</label>
                </div>
            </div>

            <div>
                <label class="text-sm">Deskripsi</label>
                <textarea name="description" id="edit_description" class="w-full border p-2 rounded mt-1"></textarea>
            </div>

            <div class="flex justify-end">
                <button class="bg-gray-900 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>


{{-- ===== MODAL DELETE LAYANAN UTAMA ===== --}}
<div id="deleteModal"
    class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">
    <div class="bg-white w-[420px] rounded-xl p-6 text-center">

        <div class="flex justify-center mb-4">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.71 18h16.58a1 1 0 00.92-1.14l-7.5-13a1 1 0 00-1.84 0z"/>
                </svg>
            </div>
        </div>

        <h2 class="text-lg font-semibold mb-2">Hapus Layanan</h2>
        <p class="text-gray-500 text-sm mb-6">Apakah Anda yakin ingin menghapus layanan ini? Data yang dihapus tidak dapat dikembalikan.</p>

        <div class="flex justify-center gap-4">
            <button onclick="toggleModal('deleteModal', false)" class="px-4 py-2 rounded border">Batal</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
            </form>
        </div>
    </div>
</div>


{{-- ===== MODAL TAMBAH LAYANAN TAMBAHAN ===== --}}
<div id="additionalServiceModal"
    class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">
    <div class="bg-white w-[450px] rounded-xl p-6 shadow-lg">

        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-lg">Tambah Layanan Tambahan</h2>
            <button onclick="toggleModal('additionalServiceModal', false)">✕</button>
        </div>

        <form action="{{ route('superadmin.services.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="is_additional" value="1">

            <div>
                <label class="text-sm">Nama Layanan</label>
                <input type="text" name="name" class="w-full border p-2 rounded mt-1" required>
            </div>

            <div>
                <label class="text-sm">Harga</label>
                <input type="number" name="price" class="w-full border p-2 rounded mt-1" required>
            </div>

            <div>
                <label class="text-sm">Durasi</label>
                <div class="flex gap-4 mt-2">
                    <label><input type="radio" name="duration" value="30"> 30 Menit</label>
                    <label><input type="radio" name="duration" value="60"> 60 Menit</label>
                </div>
            </div>

            <div>
                <label class="text-sm">Deskripsi</label>
                <textarea name="description" class="w-full border p-2 rounded mt-1"></textarea>
            </div>

            <div class="flex justify-end">
                <button class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800">Tambahkan</button>
            </div>
        </form>
    </div>
</div>


{{-- ===== MODAL EDIT LAYANAN TAMBAHAN ===== --}}
<div id="editAdditionalModal"
    class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">
    <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-6">

        <h3 class="text-lg font-semibold mb-4">Edit Layanan Tambahan</h3>

        <form id="editAdditionalForm" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium">Nama Layanan</label>
                    <input type="text" name="name" id="edit_additional_name" class="w-full border rounded-lg px-3 py-2 mt-1">
                </div>
                <div>
                    <label class="block text-sm font-medium">Harga</label>
                    <input type="number" name="price" id="edit_additional_price" class="w-full border rounded-lg px-3 py-2 mt-1">
                </div>
                <div>
                    <label class="block text-sm font-medium">Durasi (Menit)</label>
                    <input type="number" name="duration" id="edit_additional_duration" class="w-full border rounded-lg px-3 py-2 mt-1">
                </div>
                <div>
                    <label class="block text-sm font-medium">Deskripsi</label>
                    <textarea name="description" id="edit_additional_description" class="w-full border rounded-lg px-3 py-2 mt-1"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-6">
                <button type="button" onclick="toggleModal('editAdditionalModal', false)"
                    class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update</button>
            </div>
        </form>
    </div>
</div>


{{-- ===== MODAL DELETE LAYANAN TAMBAHAN ===== --}}
<div id="deleteAdditionalModal"
    class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6">

        <h3 class="text-lg font-semibold">Hapus Layanan</h3>
        <p class="text-gray-500 mt-2">Apakah Anda yakin ingin menghapus layanan ini?</p>

        <form id="deleteAdditionalForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" onclick="toggleModal('deleteAdditionalModal', false)"
                    class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg">Hapus</button>
            </div>
        </form>
    </div>
</div>

@endsection


@section('script')
<script>
/* ===== HELPER MODAL ===== */
function toggleModal(id, show) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.toggle('hidden', !show);
    modal.classList.toggle('flex', show);
}

/* ===== DROPDOWN ===== */
function toggleMenu(e, id) {
    e.stopPropagation(); // cegah langsung ditutup oleh listener document
    const menu = document.getElementById('menu-' + id);
    if (!menu) return;

    // tutup semua dropdown lain dulu
    document.querySelectorAll('[id^="menu-"]').forEach(m => {
        if (m !== menu) m.classList.add('hidden');
    });

    menu.classList.toggle('hidden');
}

// tutup semua dropdown jika klik di luar
document.addEventListener('click', function () {
    document.querySelectorAll('[id^="menu-"]').forEach(m => m.classList.add('hidden'));
});


/* ===== PREVIEW IMAGE ===== */
function bindImagePreview(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    if (!input || !preview) return;

    input.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
    });
}

bindImagePreview('imageInput', 'previewImage');
bindImagePreview('edit_image', 'edit_preview');


/* ===== MODAL EDIT LAYANAN UTAMA ===== */
function openEditModal(id, name, price, duration, description, image) {
    const form = document.getElementById('editServiceForm');
    form.reset();
    form.action = "{{ url('superadmin/services') }}/" + id;

    document.getElementById('edit_name').value        = name;
    document.getElementById('edit_price').value       = price;
    document.getElementById('edit_description').value = description;

    form.querySelectorAll('input[name="duration"]').forEach(function (radio) {
        radio.checked = radio.value == duration;
    });

    const preview = document.getElementById('edit_preview');
    if (image) {
        preview.src = image.startsWith('http') ? image : '/storage/' + image;
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }

    toggleModal('editServiceModal', true);
}


/* ===== MODAL DELETE LAYANAN UTAMA ===== */
function openDeleteModal(id) {
    document.getElementById('deleteForm').action = "{{ url('superadmin/services') }}/" + id;
    toggleModal('deleteModal', true);
}


/* ===== MODAL EDIT LAYANAN TAMBAHAN ===== */
function openEditAdditionalModal(button) {
    const { id, name, price, duration, description } = button.dataset;

    document.getElementById('edit_additional_name').value        = name;
    document.getElementById('edit_additional_price').value       = price;
    document.getElementById('edit_additional_duration').value    = duration;
    document.getElementById('edit_additional_description').value = description;

    document.getElementById('editAdditionalForm').action = "{{ url('superadmin/services') }}/" + id;

    toggleModal('editAdditionalModal', true);
}


/* ===== MODAL DELETE LAYANAN TAMBAHAN ===== */
function openDeleteAdditionalModal(id) {
    document.getElementById('deleteAdditionalForm').action = "{{ url('superadmin/services') }}/" + id;
    toggleModal('deleteAdditionalModal', true);
}
</script>
@endsection