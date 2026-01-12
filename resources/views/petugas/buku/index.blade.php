@extends('petugas.layout')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">📚 Data Buku</h3>
    <span class="badge bg-primary px-3 py-2">
        {{ now()->format('d M Y') }}
    </span>
</div>

{{-- STATISTIK --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Total Buku</h6>
                    <h2 class="fw-bold">{{ $buku->count() }}</h2>
                </div>
                <i class="bi bi-book fs-1 text-primary"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted">Total Stok</h6>
                    <h2 class="fw-bold">{{ $buku->sum('jumlah_stok') }}</h2>
                </div>
                <i class="bi bi-box-seam fs-1 text-success"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4 text-end d-flex align-items-center justify-content-end">
        <a href="{{ route('buku.create') }}" class="btn btn-primary btn-lg shadow-sm">
            + Tambah Buku
        </a>
    </div>
</div>

{{-- TABEL: BISA DIPINJAM --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
        <span>📖 Buku Yang Bisa Dipinjam</span>
        <span class="badge bg-success">Total: {{ $buku->where('tersedia_pinjam', true)->count() }}</span>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="5%">#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Penerbit & Tahun</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center" width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $listPinjam = $buku->where('tersedia_pinjam', true); @endphp
                @forelse ($listPinjam as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $item->judul }}</td>
                        <td>{{ $item->kategori->nama ?? '-' }}</td>
                        <td>{{ $item->penulis->nama ?? '-' }}</td>
                        <td>{{ $item->penerbit ?? '-' }}</td>
                        <td class="text-center">
                            <span class="badge bg-info">{{ $item->jumlah_stok }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('buku.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('buku.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus buku ini?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Tidak ada buku yang tersedia untuk dipinjam</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- TABEL: BISA DIBELI --}}
<div class="card shadow-sm border-0">
    <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
        <span>🛒 Buku Yang Bisa Dibeli</span>
        <span class="badge bg-primary">Total: {{ $buku->where('tersedia_jual', true)->count() }}</span>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="5%">#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center" width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $listJual = $buku->where('tersedia_jual', true); @endphp
                @forelse ($listJual as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $item->judul }}</td>
                        <td>{{ $item->kategori->nama ?? '-' }}</td>
                        <td>{{ $item->penulis->nama ?? '-' }}</td>
                        <td>{{ $item->penerbit ?? '-' }}</td>
                        <td class="text-center">
                            <span class="badge bg-info">{{ $item->jumlah_stok }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('buku.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('buku.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus buku ini?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Tidak ada buku yang tersedia untuk dibeli</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
