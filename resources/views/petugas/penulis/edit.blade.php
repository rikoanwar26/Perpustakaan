@extends('petugas.layout')

@section('content')
<h4 class="fw-bold mb-3">✏ Edit Penulis</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('penulis.update', $penulis) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Penulis</label>
                <input type="text"
                       name="nama"
                       value="{{ $penulis->nama }}"
                       class="form-control"
                       required>
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('penulis.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
