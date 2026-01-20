@extends('petugas.layout')
@section('content')

<div class="container py-4">
    <h3 class="fw-bold mb-3">📊 Rekap & Laporan</h3>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="border rounded p-3">
                <div class="text-muted">Total Transaksi Jual</div>
                <div class="fs-4 fw-bold">{{ $totalTransaksiJual }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="border rounded p-3">
                <div class="text-muted">Total Transaksi Pinjam</div>
                <div class="fs-4 fw-bold">{{ $totalTransaksiPinjam }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="border rounded p-3">
                <div class="text-muted">Total Dikembalikan</div>
                <div class="fs-4 fw-bold text-success">{{ $totalDikembalikan }}</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="border rounded p-3">
                <div class="text-muted">Buku Dibeli</div>
                <div class="fs-4 fw-bold">{{ $totalBukuDibeli }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="border rounded p-3">
                <div class="text-muted">Buku Dipinjam</div>
                <div class="fs-4 fw-bold">{{ $totalBukuDipinjam }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="border rounded p-3">
                <div class="text-muted">Total Denda</div>
                <div class="fs-4 fw-bold">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="border rounded p-3">
                <div class="text-muted">Pemasukan Jual</div>
                <div class="fs-4 fw-bold">Rp {{ number_format($totalPemasukanJual, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="border rounded p-3">
                <div class="text-muted">Biaya Peminjaman</div>
                <div class="fs-4 fw-bold">Rp {{ number_format($totalBiayaPeminjaman, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
</div>

<div class="container py-3">
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">User Membeli</div>
                <div class="card-body p-0 table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Transaksi</th>
                                <th>Item</th>
                                <th>Total (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usersJual as $u)
                            <tr>
                                <td>{{ $u['nama'] }}</td>
                                <td>{{ $u['jumlah_transaksi'] }}</td>
                                <td>{{ $u['total_item'] }}</td>
                                <td>{{ number_format($u['total_belanja'], 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-muted text-center">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">User Meminjam</div>
                <div class="card-body p-0 table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Transaksi</th>
                                <th>Item</th>
                                <th>Biaya (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usersPinjam as $u)
                            <tr>
                                <td>{{ $u['nama'] }}</td>
                                <td>{{ $u['jumlah_transaksi'] }}</td>
                                <td>{{ $u['total_item'] }}</td>
                                <td>{{ number_format($u['total_biaya_pinjam'], 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-muted text-center">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">User Mengembalikan</div>
                <div class="card-body p-0 table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Pengembalian</th>
                                <th>Denda (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usersKembali as $u)
                            <tr>
                                <td>{{ $u['nama'] }}</td>
                                <td>{{ $u['jumlah_kembali'] }}</td>
                                <td>{{ number_format($u['total_denda'], 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-muted text-center">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
