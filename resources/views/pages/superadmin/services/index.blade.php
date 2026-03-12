@extends('layouts.superadmin')

@section('title','Manajemen Layanan')

@section('content')

<div class="space-y-8">

    <div class="flex justify-between items-center">

        <h2 class="text-xl font-semibold">
            Daftar Layanan Utama
        </h2>

        <button
            onclick="openModal()"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">

            + Buat Layanan Utama

        </button>

    </div>


    <div class="grid grid-cols-3 gap-6">

        @foreach($services as $service)

        <div class="bg-white rounded-xl shadow overflow-visible">

            <div class="h-40 w-full">

                <img
                    src="{{ $service->image_url }}"
                    alt="{{ $service->name }}"
                    class="w-full h-full object-cover"
                >

            </div>

            <div class="p-4">

                <div class="flex justify-between items-center mb-2">

                    <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded">

                        Aktif

                    </span>

                    <div class="relative">

                        <button
                            onclick="toggleMenu({{ $service->id }})"
                            class="text-gray-400 text-xl px-2">

                            ⋮

                        </button>

                        <div
                            id="menu-{{ $service->id }}"
                            class="hidden absolute right-0 mt-2 w-36 bg-white border rounded-lg shadow-lg z-50">

                            {{-- EDIT --}}
                           <button
                            onclick="openEditModal(
                                {{ $service->id }},
                                '{{ $service->name }}',
                                '{{ $service->price }}',
                                '{{ $service->duration }}',
                                `{{ $service->description }}`,
                                '{{ $service->image }}'
                            )"
                            class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">

                            Edit
                            </button>

                            {{-- DELETE --}}
                            <button
                            onclick="openDeleteModal({{ $service->id }})"
                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">

                            Delete
                            </button>

                        </div>

                    </div>

                </div>


                <h3 class="font-semibold text-lg">

                    {{ $service->name }}

                </h3>


                <p class="text-sm text-gray-500 mb-2">

                    {{ $service->description }}

                </p>


                <div class="flex justify-between text-sm">

                    <span class="text-green-600 font-semibold">

                        Rp {{ number_format($service->price,0,',','.') }}

                    </span>

                    <span class="text-gray-500">

                        {{ $service->duration }} Menit

                    </span>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

{{-- Layanan Tambahan --}}
<div class="space-y-6 mt-12">

    <div class="flex justify-between items-center">

        <h2 class="text-xl font-semibold">
            Daftar Layanan Tambahan
        </h2>

        <button
            onclick="openAdditionalModal()"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">

            + Tambah Layanan Tambahan

        </button>

    </div>


    <div class="bg-white rounded-xl shadow overflow-visible relative">

        <table class="w-full text-sm">

            <thead class="bg-gray-100">

                <tr>

                    <th class="text-left px-4 py-3">Nama Layanan</th>
                    <th class="text-left px-4 py-3">Harga</th>
                    <th class="text-left px-4 py-3">Durasi</th>
                    <th class="text-left px-4 py-3">Deskripsi</th>
                    <th class="text-right px-4 py-3">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @foreach($additionalServices as $service)

                <tr class="border-t">

                    <td class="px-4 py-3 font-medium">
                        {{ $service->name }}
                    </td>

                    <td class="px-4 py-3 text-green-600">
                        Rp {{ number_format($service->price,0,',','.') }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $service->duration }} Menit
                    </td>

                    <td class="px-4 py-3 text-gray-500">
                        {{ $service->description }}
                    </td>

                    <td class="px-4 py-3 text-right">

                        <div class="relative inline-block">

                            <button
                                onclick="toggleMenu('additional-{{ $service->id }}')"
                                class="text-gray-400 text-xl">

                                ⋮

                            </button>

                            <div
                                id="menu-additional-{{ $service->id }}"
                                class="hidden absolute right-0 mt-2 w-36 bg-white border rounded-lg shadow z-50">

                                <!-- ================= ACTION BUTTON ================= -->

                                <button
                                    class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100"
                                    onclick="openEditAdditionalModal(this)"

                                    data-id="{{ $service->id }}"
                                    data-name="{{ $service->name }}"
                                    data-price="{{ $service->price }}"
                                    data-duration="{{ $service->duration }}"
                                    data-description="{{ $service->description }}"
                                >
                                    Edit
                                </button>


                                <button
                                    onclick="openDeleteAdditionalModal('{{ $service->id }}')"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                                >
                                    Delete
                                </button>

                            </div>

                        </div>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

{{-- MODAL TAMBAH --}}
<div
    id="serviceModal"
    class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">

    <div class="bg-white w-[500px] rounded-xl p-6">

        <div class="flex justify-between mb-4">

            <h2 class="font-semibold text-lg">

                Buat Layanan Utama

            </h2>

            <button onclick="closeModal()">✕</button>

        </div>


        <form
            action="{{ route('superadmin.services.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4">

            @csrf
            <input type="hidden" name="is_additional" value="0">

            <div>

                <label class="text-sm">Nama Layanan</label>

                <input
                    type="text"
                    name="name"
                    class="w-full border p-2 rounded mt-1">

            </div>


            <div>

                <label class="text-sm">Upload Gambar</label>

                <input
                    type="file"
                    name="image"
                    id="imageInput"
                    class="w-full border p-2 rounded mt-1">

                    <img
                        src="{{ $service->image_url }}"
                        alt="{{ $service->name }}"
                        class="w-full h-full object-cover"
                    >

            </div>


            <div>

                <label class="text-sm">Harga</label>

                <input
                    type="number"
                    name="price"
                    class="w-full border p-2 rounded mt-1">

            </div>


            <div>

                <label class="text-sm">Durasi</label>

                <div class="flex gap-4 mt-2">

                    <label>
                        <input type="radio" name="duration" value="60">
                        60 Menit
                    </label>

                    <label>
                        <input type="radio" name="duration" value="90">
                        90 Menit
                    </label>

                    <label>
                        <input type="radio" name="duration" value="120">
                        120 Menit
                    </label>

                </div>

            </div>


            <div>

                <label class="text-sm">Deskripsi</label>

                <textarea
                    name="description"
                    class="w-full border p-2 rounded mt-1"></textarea>

            </div>


            <div class="flex justify-end">

                <button
                    class="bg-gray-900 text-white px-4 py-2 rounded">

                    Tambahkan

                </button>

            </div>

        </form>

    </div>

</div>

{{-- MODAL EDIT --}}
<div
id="editServiceModal"
class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">

    <div class="bg-white w-[500px] rounded-xl p-6 shadow-lg">

        <div class="flex justify-between items-center mb-4">

            <h2 class="font-semibold text-lg">
                Edit Layanan
            </h2>

            <button onclick="closeEditModal()">✕</button>

        </div>

        <form
            id="editServiceForm"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4">

            @csrf
            @method('PUT')

            <div>
                <label class="text-sm">Nama Layanan</label>

                <input
                    type="text"
                    name="name"
                    id="edit_name"
                    class="w-full border p-2 rounded mt-1">
            </div>

            <div>

                <label class="text-sm">Upload Gambar</label>

                <input
                    type="file"
                    name="image"
                    id="edit_image"
                    class="w-full border p-2 rounded mt-1">

                <!-- PREVIEW IMAGE -->
                <img
                    src="{{ $service->image_url }}"
                    alt="{{ $service->name }}"
                    class="w-full h-full object-cover"
                >

            </div>

            <div>
                <label class="text-sm">Harga</label>

                <input
                    type="number"
                    name="price"
                    id="edit_price"
                    class="w-full border p-2 rounded mt-1">
            </div>

            <div>

                <label class="text-sm">Durasi</label>

                <div class="flex gap-4 mt-2">

                    <label>
                        <input type="radio" name="duration" value="60">
                        60 Menit
                    </label>

                    <label>
                        <input type="radio" name="duration" value="90">
                        90 Menit
                    </label>

                    <label>
                        <input type="radio" name="duration" value="120">
                        120 Menit
                    </label>

                </div>

            </div>

            <div>

                <label class="text-sm">Deskripsi</label>

                <textarea
                    name="description"
                    id="edit_description"
                    class="w-full border p-2 rounded mt-1"></textarea>

            </div>

            <div class="flex justify-end">

                <button
                    class="bg-gray-900 text-white px-4 py-2 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL DELETE --}}
<div
id="deleteModal"
class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">

    <div class="bg-white w-[420px] rounded-xl p-6 text-center">

        <!-- ICON WARNING -->
        <div class="flex justify-center mb-4">

            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8 text-red-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01M10.29 3.86l-7.5 13A1 1 0 003.71 18h16.58a1 1 0 00.92-1.14l-7.5-13a1 1 0 00-1.84 0z"/>

                </svg>

            </div>

        </div>

        <h2 class="text-lg font-semibold mb-2">
            Hapus Layanan
        </h2>

        <p class="text-gray-500 text-sm mb-6">
            Apakah Anda yakin ingin menghapus layanan ini?
            Data yang dihapus tidak dapat dikembalikan.
        </p>

        <div class="flex justify-center gap-4">

            <button
                onclick="closeDeleteModal()"
                class="px-4 py-2 rounded border">

                Batal

            </button>

            <form
                id="deleteForm"
                method="POST">

                @csrf
                @method('DELETE')

                <button
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">

                    Hapus

                </button>

            </form>

        </div>

    </div>

</div>


{{-- MODAL TAMBAH LAYANAN TAMBAHAN --}}
<div
id="additionalServiceModal"
class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">

    <div class="bg-white w-[450px] rounded-xl p-6 shadow-lg">

        <div class="flex justify-between items-center mb-4">

            <h2 class="font-semibold text-lg">
                Tambah Layanan Tambahan
            </h2>

            <button onclick="closeAdditionalModal()">✕</button>

        </div>


        <form
            action="{{ route('superadmin.services.store') }}"
            method="POST"
            class="space-y-4">

            @csrf
            <input type="hidden" name="is_additional" value="1">
            <div>
                <label class="text-sm">Nama Layanan</label>

                <input
                    type="text"
                    name="name"
                    class="w-full border p-2 rounded mt-1"
                    required>
            </div>


            <div>
                <label class="text-sm">Harga</label>

                <input
                    type="number"
                    name="price"
                    class="w-full border p-2 rounded mt-1"
                    required>
            </div>


            <div>
                <label class="text-sm">Durasi</label>

                <div class="flex gap-4 mt-2">

                    <label>
                        <input type="radio" name="duration" value="30">
                        30 Menit
                    </label>

                    <label>
                        <input type="radio" name="duration" value="60">
                        60 Menit
                    </label>

                </div>

            </div>


            <div>
                <label class="text-sm">Deskripsi</label>

                <textarea
                    name="description"
                    class="w-full border p-2 rounded mt-1"></textarea>
            </div>


            <div class="flex justify-end">

                <button
                    class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800">

                    Tambahkan

                </button>

            </div>

        </form>

    </div>

</div>

<!-- ================= MODAL EDIT ================= -->
<div id="editAdditionalModal"
     class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">

    <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-6">

        <h3 class="text-lg font-semibold mb-4">
            Edit Layanan Tambahan
        </h3>

        <form id="editAdditionalForm" method="POST">

            @csrf
            @method('PUT')

            <div class="space-y-4">

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium">
                        Nama Layanan
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="edit_additional_name"
                        class="w-full border rounded-lg px-3 py-2 mt-1"
                    >
                </div>

                <!-- Harga -->
                <div>
                    <label class="block text-sm font-medium">
                        Harga
                    </label>

                    <input
                        type="number"
                        name="price"
                        id="edit_additional_price"
                        class="w-full border rounded-lg px-3 py-2 mt-1"
                    >
                </div>

                <!-- Durasi -->
                <div>
                    <label class="block text-sm font-medium">
                        Durasi (Menit)
                    </label>

                    <input
                        type="number"
                        name="duration"
                        id="edit_additional_duration"
                        class="w-full border rounded-lg px-3 py-2 mt-1"
                    >
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium">
                        Deskripsi
                    </label>

                    <textarea
                        name="description"
                        id="edit_additional_description"
                        class="w-full border rounded-lg px-3 py-2 mt-1"
                    ></textarea>
                </div>

            </div>

            <!-- Action -->
            <div class="flex justify-end gap-2 mt-6">

                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="px-4 py-2 bg-gray-200 rounded-lg"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg"
                >
                    Update
                </button>

            </div>

        </form>

    </div>

</div>

<!-- ================= MODAL DELETE ================= -->
<div id="deleteAdditionalModal"
     class="fixed inset-0 hidden items-center justify-center bg-black/40 z-50">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6">

        <h3 class="text-lg font-semibold">
            Hapus Layanan
        </h3>

        <p class="text-gray-500 mt-2">
            Apakah Anda yakin ingin menghapus layanan ini?
        </p>

        <form id="deleteAdditionalForm" method="POST">

            @csrf
            @method('DELETE')

            <div class="flex justify-end gap-2 mt-6">

                <button
                    type="button"
                    onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-200 rounded-lg"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg"
                >
                    Hapus
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@section('script')

<script>

/* ================= MODAL TAMBAH ================= */

function openModal(){

    const modal = document.getElementById('serviceModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

}

function closeModal(){

    const modal = document.getElementById('serviceModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');

}


/* ================= PREVIEW IMAGE TAMBAH ================= */

const imageInput = document.getElementById('imageInput');

if(imageInput){

imageInput.addEventListener('change',function(e){

    const file = e.target.files[0];

    if(file){

        const preview=document.getElementById('previewImage');

        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');

    }

});

}

/* ================= DROPDOWN MENU ================= */

/* ================= DROPDOWN MENU ================= */

function toggleMenu(id)
{
    let menu = document.getElementById("menu-" + id);

    if(!menu){
        menu = document.getElementById("menu-additional-" + id);
    }

    document.querySelectorAll("[id^='menu']").forEach(function(m){

        if(m !== menu){
            m.classList.add("hidden");
        }

    });

    if(menu){
        menu.classList.toggle("hidden");
    }
}


/* close dropdown jika klik luar */

document.addEventListener("click", function(e){

    if(!e.target.closest(".relative")){

        document.querySelectorAll("[id^='menu']").forEach(function(menu){
            menu.classList.add("hidden");
        });

    }

});

document.addEventListener("click", function(e){

    if(!e.target.closest(".relative")){

        document.querySelectorAll("[id^='menu-']").forEach(menu=>{
            menu.classList.add("hidden");
        });

    }

});


/* ================= MODAL EDIT ================= */

function openEditModal(id, name, price, duration, description, image)
{
    const modal = document.getElementById('editServiceModal');
    const form  = document.getElementById('editServiceForm');

    form.reset();

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('edit_name').value = name;
    document.getElementById('edit_price').value = price;
    document.getElementById('edit_description').value = description;

    document.querySelectorAll('input[name="duration"]').forEach(function(radio){

        radio.checked = radio.value == duration;

    });

    form.action = "{{ url('superadmin/services') }}/" + id;


    const preview = document.getElementById('edit_preview');

    if(image){

        if(image.startsWith('http')){
            preview.src = image;
        }else{
            preview.src = "/storage/" + image;
        }

        preview.classList.remove('hidden');

    }else{

        preview.classList.add('hidden');

    }
}

function closeEditModal(){

    const modal = document.getElementById('editServiceModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');

}


/* preview image edit */

const editImage = document.getElementById("edit_image");

if(editImage){

editImage.addEventListener("change", function(e){

    const file = e.target.files[0];
    const preview = document.getElementById("edit_preview");

    if(file){
        preview.src = URL.createObjectURL(file);
        preview.classList.remove("hidden");
    }

});

}


/* ================= MODAL DELETE ================= */

function openDeleteModal(id){

    const modal = document.getElementById('deleteModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('deleteForm').action =
        "{{ url('superadmin/services') }}/" + id;

}

function closeDeleteModal(){

    const modal = document.getElementById('deleteModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');

}
/* JS Layanan */
function openAdditionalModal(){

    const modal = document.getElementById('additionalServiceModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

}

function closeAdditionalModal(){

    const modal = document.getElementById('additionalServiceModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');

}

function openEditAdditionalModal(button)
{
    const id          = button.dataset.id;
    const name        = button.dataset.name;
    const price       = button.dataset.price;
    const duration    = button.dataset.duration;
    const description = button.dataset.description;

    const modal = document.getElementById("editAdditionalModal");

    document.getElementById("edit_additional_name").value        = name;
    document.getElementById("edit_additional_price").value       = price;
    document.getElementById("edit_additional_duration").value    = duration;
    document.getElementById("edit_additional_description").value = description;

    document.getElementById("editAdditionalForm").action =
        "{{ url('superadmin/services') }}/" + id;

    modal.classList.remove("hidden");
    modal.classList.add("flex");
}


function closeEditAdditionalModal()
{
    const modal = document.getElementById("editAdditionalModal");

    modal.classList.add("hidden");
    modal.classList.remove("flex");
}

function openDeleteAdditionalModal(id)
{
    const modal = document.getElementById("deleteAdditionalModal");

    document.getElementById("deleteAdditionalForm").action =
        "{{ url('superadmin/services') }}/" + id;

    modal.classList.remove("hidden");
    modal.classList.add("flex");
}


function closeDeleteAdditionalModal()
{
    const modal = document.getElementById("deleteAdditionalModal");

    modal.classList.add("hidden");
    modal.classList.remove("flex");
}

</script>

@endsection