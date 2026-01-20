@extends('petugas.layout')

@section('content')
<h4 class="mb-4 fw-bold">✏ Edit Buku</h4>

<div class="card shadow-sm border-0">
    <div class="card-body">

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('buku.update', $buku) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- JUDUL --}}
            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text"
                       name="judul"
                       class="form-control"
                       value="{{ old('judul', $buku->judul) }}"
                       required>
            </div>

            {{-- KATEGORI --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="id_kategori" class="form-select" required>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}"
                            {{ old('id_kategori', $buku->id_kategori) == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- PENULIS --}}
            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <select name="id_penulis" class="form-select" required>
                    @foreach ($penulis as $p)
                        <option value="{{ $p->id_penulis }}"
                            {{ old('id_penulis', $buku->id_penulis) == $p->id_penulis ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- STOK TERPISAH --}}
            <div class="mb-3">
                <label class="form-label">Stok Pinjam</label>
                <input type="number"
                       name="stok_pinjam"
                       class="form-control"
                       min="0"
                       value="{{ old('stok_pinjam', $buku->stok_pinjam) }}"
                       required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stok Jual</label>
                <input type="number"
                       name="stok_jual"
                       class="form-control"
                       min="0"
                       value="{{ old('stok_jual', $buku->stok_jual) }}"
                       required>
            </div>

            {{-- PENERBIT & TAHUN (GABUNG) --}}
            <div class="mb-3">
                <label class="form-label">Penerbit & Tahun</label>
                <input type="text"
                       name="penerbit"
                       class="form-control"
                       value="{{ old('penerbit', $buku->penerbit) }}"
                       placeholder="cth: Gramedia, 2023">
                <small class="text-muted">Isikan keduanya jadi satu, misal: “Gramedia, 2023”.</small>
            </div>

            {{-- FOTO --}}
            <div class="mb-3">
                <label class="form-label">Foto Buku</label>

                @if ($buku->foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$buku->foto) }}"
                             width="120"
                             class="rounded shadow">
                    </div>
                @endif

                <input type="file"
                       name="foto"
                       class="form-control"
                       accept="image/*">
                <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti foto
                </small>
            </div>

            {{-- KETERSEDIAAN --}}
            <div class="mb-3">
                <label class="form-label d-block">Ketersediaan</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="tersedia_pinjam" id="tersedia_pinjam" value="1"
                           {{ old('tersedia_pinjam', $buku->tersedia_pinjam) ? 'checked' : '' }}>
                    <label class="form-check-label" for="tersedia_pinjam">Bisa dipinjam</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="tersedia_jual" id="tersedia_jual" value="1"
                           {{ old('tersedia_jual', $buku->tersedia_jual) ? 'checked' : '' }}>
                    <label class="form-check-label" for="tersedia_jual">Bisa dibeli</label>
                </div>
            </div>

            {{-- TOMBOL --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('buku.index') }}" class="btn btn-secondary">
                    ⬅ Kembali
                </a>
                <button class="btn btn-success">
                    💾 Update
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
