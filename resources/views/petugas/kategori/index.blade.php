@extends('petugas.layout')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4 class="fw-bold">📂 Data Kategori</h4>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary">
        + Tambah Kategori
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered">
            <tr class="table-dark text-center">
                <th width="10%">No</th>
                <th>Nama Kategori</th>
                <th width="20%">Aksi</th>
            </tr>

            @foreach ($kategori as $k)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $k->nama }}</td>
                <td class="text-center">

                    <a href="{{ route('kategori.edit', $k->id_kategori) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    

                    <form action="{{ route('kategori.destroy', $k->id_kategori) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus kategori?')">
                            Hapus
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
