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

<div class="container pb-4">
    @php
        $totalTransaksi = $transaksiPinjam->count();
        $sudahKembali = $transaksiPinjam->filter(function($t){ return (bool) $t->pengembalian; })->count();
        $masihDipinjam = $transaksiPinjam->filter(function($t){ return ! $t->pengembalian && ($t->status === 'Berhasil'); })->count();
        $totalDenda = $transaksiPinjam->sum(function($t){ return (int) ($t->pengembalian->denda ?? 0); });
        $totalBukuDipinjam = $transaksiPinjam->sum(function($t){ return $t->detail->sum('jumlah'); });
        $totalBukuDikembalikan = $transaksiPinjam->filter(function($t){ return (bool) $t->pengembalian; })->sum(function($t){ return $t->detail->sum('jumlah'); });
    @endphp
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">Rekap Pengembalian</div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="border rounded p-3">
                        <div class="text-muted">Total Transaksi Pinjam</div>
                        <div class="fs-4 fw-bold">{{ $totalTransaksi }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded p-3">
                        <div class="text-muted">Sudah Dikembalikan</div>
                        <div class="fs-4 fw-bold text-success">{{ $sudahKembali }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded p-3">
                        <div class="text-muted">Masih Dipinjam</div>
                        <div class="fs-4 fw-bold text-warning">{{ $masihDipinjam }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded p-3">
                        <div class="text-muted">Total Buku Dipinjam</div>
                        <div class="fs-4 fw-bold">{{ $totalBukuDipinjam }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded p-3">
                        <div class="text-muted">Total Buku Dikembalikan</div>
                        <div class="fs-4 fw-bold">{{ $totalBukuDikembalikan }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded p-3">
                        <div class="text-muted">Total Denda Terkumpul</div>
                        <div class="fs-4 fw-bold">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
