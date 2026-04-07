@extends('layouts.superadmin')

@section('title','Buat Karyawan')
@section('header','Buat Akun Karyawan')

@section('content')

<style>
.card { background:#fff; border-radius:16px; padding:24px; box-shadow:0 2px 10px rgba(0,0,0,0.04); }
.grid-3 { display:grid; grid-template-columns:2fr 1fr; gap:24px; }
.input { width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px; }
.label { font-size:13px; color:#6b7280; }
.form-group { display:flex; flex-direction:column; gap:4px; }
.row-2 { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
.radio-group { display:flex; gap:16px; margin-top:6px; }
.section-title { font-weight:600; margin-bottom:8px; }
.avatar-box { background:#f9fafb; padding:16px; border-radius:12px; text-align:center; }
.avatar { width:100px; height:100px; border-radius:50%; background:#e5e7eb; display:flex; align-items:center; justify-content:center; margin:auto; overflow:hidden; }
.btn { width:100%; background:#22c55e; color:white; padding:10px; border-radius:10px; border:none; cursor:pointer; }
.btn-upload { margin-top:10px; font-size:13px; color:#22c55e; cursor:pointer; }
</style>

<form method="POST" action="{{ route('superadmin.karyawan.store') }}" enctype="multipart/form-data">
@csrf

<div class="card">

    <h2 class="section-title">Buat Akun Karyawan</h2>

    <div class="grid-3">

        <!-- LEFT -->
        <div>

            <div class="row-2">

                <div class="form-group">
                    <label class="label">Nama Depan*</label>
                    <input type="text" name="nama_depan" class="input">
                </div>

                <div class="form-group">
                    <label class="label">Nama Belakang*</label>
                    <input type="text" name="nama_belakang" class="input">
                </div>

                <div class="form-group">
                    <label class="label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="input">
                </div>

                <div class="form-group">
                    <label class="label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="input">
                </div>

                <div class="form-group">
                    <label class="label">Jenis Kelamin*</label>
                    <div class="radio-group">
                        <label><input type="radio" name="jenis_kelamin" value="L"> Laki-laki</label>
                        <label><input type="radio" name="jenis_kelamin" value="P"> Perempuan</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="label">Alamat</label>
                    <input type="text" name="alamat" class="input">
                </div>

                <div class="form-group">
                    <label class="label">Email</label>
                    <input type="email" name="email" class="input">
                </div>

                <div class="form-group">
                    <label class="label">No. Ponsel</label>
                    <input type="text" name="phone" class="input">
                </div>

            </div>

            <!-- AREA -->
            <div style="margin-top:20px;">
                <p class="section-title">Area Penempatan</p>

                <!-- PROVINSI -->
                <div class="form-group">
                    <label class="label">Provinsi*</label>
                    <select id="provinsi" class="input">
                        <option value="">Pilih Provinsi</option>

                        @foreach($provinsis as $provinsi)
                            <option value="{{ $provinsi }}">{{ $provinsi }}</option>
                        @endforeach

                    </select>
                </div>

                <!-- CABANG -->
                <div class="form-group" style="margin-top:10px;">
                    <label class="label">Cabang / Kota*</label>
                    <select name="cabang_id" id="cabang" class="input">
                        <option value="">Pilih Cabang</option>
                    </select>
                </div>
            </div>

        </div>

        <!-- RIGHT -->
        <div>

            <!-- FOTO -->
            <div class="avatar-box">
                <div class="avatar">
                    <img id="preview" style="width:100%;height:100%;object-fit:cover;display:none;">
                    <span id="placeholder">👤</span>
                </div>

                <input type="file" name="foto" id="foto" hidden>

                <div class="btn-upload" onclick="document.getElementById('foto').click()">
                    Pilih Foto
                </div>
            </div>

            <!-- ROLE -->
            <div class="form-group" style="margin-top:16px;">
                <label class="label">Pilih Role*</label>
                <select name="role" class="input">
                    <option value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="finance">Finance</option>
                </select>
            </div>

            <!-- PASSWORD -->
            <div style="margin-top:16px;">
                <p class="section-title">Kata Sandi</p>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="input">
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="input">
                </div>
            </div>

            <!-- SUBMIT -->
            <button class="btn" style="margin-top:16px;">
                Buat Akun
            </button>

        </div>

    </div>

</div>

</form>

@endsection


@section('script')

@section('script')

<script>
// PREVIEW FOTO (TIDAK DIUBAH)
document.getElementById('foto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('preview').style.display = 'block';
            document.getElementById('placeholder').style.display = 'none';
        }
        reader.readAsDataURL(file);
    }
});

// DROPDOWN CABANG (FIX TOTAL)
document.getElementById('provinsi').addEventListener('change', function () {

    let provinsi = this.value;
    let cabang = document.getElementById('cabang');

    if (!provinsi) {
        cabang.innerHTML = '<option>Pilih provinsi dulu</option>';
        return;
    }

    cabang.innerHTML = '<option>Loading...</option>';

    fetch(`/superadmin/cabang-by-provinsi/${encodeURIComponent(provinsi)}`) // 🔥 FIX
        .then(res => {
            if (!res.ok) throw new Error('Gagal ambil data');
            return res.json();
        })
        .then(data => {

            cabang.innerHTML = '<option value="">Pilih Cabang</option>';

            if (data.length === 0) {
                cabang.innerHTML = '<option>Tidak ada cabang</option>';
                return;
            }

            data.forEach(item => {
                cabang.innerHTML += `
                    <option value="${item.id}">
                        ${item.kode_cabang} - ${item.kota}
                    </option>
                `;
            });

        })
        .catch(err => {
            cabang.innerHTML = '<option>Gagal load data</option>';
            console.error(err);
        });

});
</script>

@endsection

@endsection