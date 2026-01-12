@extends('petugas.layout')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4 class="fw-bold">✍ Data Penulis</h4>
    <a href="{{ route('penulis.create') }}" class="btn btn-primary">
        + Tambah Penulis
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
                <th>Nama Penulis</th>
                <th width="20%">Aksi</th>
            </tr>

            @foreach ($penulis as $p)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $p->nama }}</td>
                <td class="text-center">

                    <a href="{{ route('penulis.edit', $p) }}"
                    class="btn btn-warning btn-sm">
                     Edit
                 </a>
                 

                    <form action="{{ route('penulis.destroy', $p) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus penulis?')">
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
