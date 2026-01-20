@extends('petugas.layout')

@section('content')
<h4 class="mb-4 fw-bold">➕ Tambah Buku</h4>

<div class="card shadow-sm border-0">
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="id_kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id_kategori }}">{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <select name="id_penulis" class="form-select" required>
                    <option value="">-- Pilih Penulis --</option>
                    @foreach($penulis as $p)
                        <option value="{{ $p->id_penulis }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok Pinjam</label>
                <input type="number" name="stok_pinjam" class="form-control" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok Jual</label>
                <input type="number" name="stok_jual" class="form-control" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga Buku</label>
                <input type="number" name="harga" class="form-control" min="0" required>
            </div>            

            <div class="mb-3">
                <label class="form-label">Penerbit & Tahun</label>
                <input type="text" name="penerbit" class="form-control" placeholder="cth: Gramedia, 2023">
                <small class="text-muted">Isikan keduanya jadi satu, misal: “Gramedia, 2023”.</small>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Ketersediaan</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="tersedia_pinjam" id="tersedia_pinjam" value="1" checked>
                    <label class="form-check-label" for="tersedia_pinjam">Bisa dipinjam</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="tersedia_jual" id="tersedia_jual" value="1" checked>
                    <label class="form-check-label" for="tersedia_jual">Bisa dibeli</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Buku</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('buku.index') }}" class="btn btn-secondary">⬅ Kembali</a>
                <button class="btn btn-success">💾 Simpan</button>
            </div>

        </form>

    </div>
</div>
@endsection
