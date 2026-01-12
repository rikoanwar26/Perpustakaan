@extends('petugas.layout')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">📊 Dashboard</h3>
    <span class="badge bg-primary px-3 py-2">
        {{ now()->format('d M Y') }}
    </span>
</div>

{{-- STATISTIK MASTER DATA (PALING ATAS) --}}
<div class="row g-3 mb-4">

    {{-- TOTAL BUKU --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Total Buku</h6>
                    <h2 class="fw-bold">{{ $totalBuku }}</h2>
                </div>
                <i class="bi bi-book fs-1 text-info"></i>
            </div>
        </div>
    </div>

    {{-- TOTAL KATEGORI --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Total Kategori</h6>
                    <h2 class="fw-bold">{{ $totalKategori }}</h2>
                </div>
                <i class="bi bi-tags fs-1 text-warning"></i>
            </div>
        </div>
    </div>

    {{-- TOTAL PENULIS --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Total Penulis</h6>
                    <h2 class="fw-bold">{{ $totalPenulis }}</h2>
                </div>
                <i class="bi bi-person-lines-fill fs-1 text-secondary"></i>
            </div>
        </div>
    </div>

</div>

{{-- STATISTIK TRANSAKSI --}}
<div class="row g-3 mb-4">

    {{-- TOTAL TRANSAKSI --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Total Transaksi</h6>
                    <h2 class="fw-bold">{{ $totalTransaksi }}</h2>
                </div>
                <i class="bi bi-receipt fs-1 text-primary"></i>
            </div>
        </div>
    </div>

    {{-- TRANSAKSI HARI INI --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Transaksi Hari Ini</h6>
                    <h2 class="fw-bold">{{ $transaksiHariIni }}</h2>
                </div>
                <i class="bi bi-calendar-event fs-1 text-success"></i>
            </div>
        </div>
    </div>

    {{-- LIHAT SEMUA TRANSAKSI --}}
    <div class="col-md-4 d-flex align-items-center justify-content-end">
        <a href="{{ route('admin.transaksi') }}" class="btn btn-primary btn-lg shadow-sm">
            📄 Lihat Semua Transaksi
        </a>
    </div>

</div>

{{-- TABEL TRANSAKSI TERBARU --}}
<div class="card shadow-sm border-0">
    <div class="card-header bg-white fw-bold">
        📖 Transaksi Terbaru
    </div>

    <div class="card-body p-0 table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Pengguna</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Pengantaran</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksiTerbaru as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->pengguna->nama }}</td>
                    <td>{{ $t->created_at->format('d M Y') }}</td>
                    <td>
                        <span class="badge 
                            @if($t->status == 'Berhasil' || $t->status == 'berhasil')
                                bg-success
                            @elseif($t->status == 'Dibatalkan')
                                bg-danger
                            @elseif($t->status == 'Menunggu Konfirmasi' || $t->status == 'menunggu konfirmasi')
                                bg-warning text-dark
                            @elseif($t->status == 'Menunggu Pembayaran')
                                bg-secondary
                            @else
                                bg-secondary
                            @endif
                        ">
                            {{ $t->status }}
                        </span>
                    </td>
                    <td>
                        <div class="small">
                            Jenis: {{ ucfirst($t->jenis) }} • {{ $t->metode_pengantaran ? ucfirst($t->metode_pengantaran) : 'Outlet' }}
                            • Biaya: Rp {{ number_format((int)($t->biaya_pengantaran ?? 0), 0, ',', '.') }}
                            @if($t->jenis === 'pinjam' && (int)($t->biaya_peminjaman ?? 0) > 0)
                                • Biaya pinjam: Rp {{ number_format((int)$t->biaya_peminjaman, 0, ',', '.') }}
                            @endif
                        </div>
                    </td>
                    <td class="text-center">
                        @if($t->status == 'Menunggu Konfirmasi' || $t->status == 'menunggu konfirmasi' || $t->status == 'Menunggu Pembayaran')
                        <form action="{{ route('admin.konfirmasi', $t->id_transaksi) }}" method="POST" onsubmit="return confirm('Yakin konfirmasi pembayaran ini?')">
                            @csrf
                            <button class="btn btn-success btn-sm">Konfirmasi</button>
                        </form>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-3">
                        Data transaksi belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
