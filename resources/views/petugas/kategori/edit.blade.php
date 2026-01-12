@extends('petugas.layout')

@section('content')
<h4 class="fw-bold mb-3">✏ Edit Kategori</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Kategori</label>
                <input type="text"
                       name="nama"
                       value="{{ $kategori->nama }}"
                       class="form-control"
                       required>
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection