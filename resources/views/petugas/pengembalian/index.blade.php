@extends('petugas.layout')
@section('content')

<div class="container py-4">
    <h3 class="fw-bold mb-3">📖 Pengembalian Buku</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-hover bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>User</th>
                <th>Alamat</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Dikembalikan</th>
                <th>Status</th>
                <th>Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksiPinjam as $t)
            <tr>
                <td>{{ $t->pengguna->nama ?? '-' }}</td>
                <td>{{ $t->pengguna->alamat ?? '-' }}</td>
                <td>{{ $t->created_at->format('d M Y') }}</td>
                <td>
                    @if($t->pengembalian && $t->pengembalian->tanggal_kembali)
                        {{ \Carbon\Carbon::parse($t->pengembalian->tanggal_kembali)->format('d M Y') }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    <span class="badge 
                        @if($t->status == 'Berhasil')
                            bg-success
                        @elseif($t->status == 'Dibatalkan')
                            bg-danger
                        @else
                            bg-secondary
                        @endif
                    ">
                        {{ $t->status }}
                    </span>
                </td>
                <td>
                    <ul class="mb-0">
                        @foreach($t->detail as $d)
                            <li>{{ $d->buku->judul ?? '-' }} (x{{ $d->jumlah }})</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    @if($t->pengembalian)
                        <span class="badge bg-success">Dikembalikan</span>
                    @else
                        <a href="{{ route('admin.pengembalian.create', $t->id_transaksi) }}" 
                            class="btn btn-sm btn-primary">
                            ➕ Tambah Pengembalian
                        </a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Tidak ada transaksi pinjam yang perlu dikembalikan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
