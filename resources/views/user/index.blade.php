<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User | Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f6fa; }
        .card { border-radius: 15px; overflow: hidden; }
        .book-img { height: 220px; object-fit: cover; }
    </style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-dark bg-dark shadow">
    <div class="container">
        <button class="navbar-toggler me-2" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand fw-bold" href="/user">📚 Perpustakaan</a>
        @php
            $cart = session('cart', ['jual' => [], 'pinjam' => []]);
            $totalCount = array_sum($cart['jual']) + array_sum($cart['pinjam']);
        @endphp
        <a href="{{ route('cart') }}" class="btn btn-outline-light ms-2 position-relative">
            🧺 Keranjang
            @if($totalCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $totalCount }}
                </span>
            @endif
        </a>
    </div>
</nav>

{{-- SIDEBAR --}}
<div class="offcanvas offcanvas-start" id="sidebarMenu">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title">📚 Menu</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0">
        <div class="list-group list-group-flush">
            <a href="/user" class="list-group-item list-group-item-action {{ request()->is('user') ? 'active' : '' }}">
                🏠 Dashboard
            </a>
            <a href="{{ route('user.beli') }}" class="list-group-item list-group-item-action {{ request()->routeIs('user.beli') ? 'active' : '' }}">
                🛒 Beli Buku
            </a>
            <a href="{{ route('user.pinjam') }}" class="list-group-item list-group-item-action {{ request()->routeIs('user.pinjam') ? 'active' : '' }}">
                📖 Pinjam Buku
            </a>
            <a href="/riwayat" class="list-group-item list-group-item-action {{ request()->is('riwayat') ? 'active' : '' }}">
                📄 Riwayat Transaksi
            </a>
        </div>
        <hr class="my-2">
        <div class="list-group list-group-flush">
            <a href="/logout" class="list-group-item list-group-item-action text-danger">
                🚪 Logout
            </a>
        </div>
    </div>
</div>

{{-- CONTENT --}}
<div class="container py-5">
    <h3 class="fw-bold mb-3">📚 Daftar Buku</h3>
    <form method="GET" action="/user" class="row g-2 mb-4">
        <div class="col-sm-9">
            <input type="search" class="form-control" name="q" value="{{ request('q') }}" placeholder="Cari judul, penulis, kategori, penerbit">
        </div>
        <div class="col-sm-3">
            <button class="btn btn-primary w-100">Cari</button>
        </div>
    </form>

    {{-- ================= PINJAM ================= --}}
    <h4 class="fw-bold mb-3">📖 Buku Yang Bisa Dipinjam</h4>

    @php
        $bukuPinjam = $buku->where('tersedia_pinjam', true);
    @endphp

    @if ($bukuPinjam->isEmpty())
        <div class="alert alert-warning">Tidak ada buku untuk dipinjam</div>
    @else
        <div class="row g-4 mb-5">
            @foreach ($bukuPinjam as $b)
                <div class="col-md-4">
                    <div class="card shadow h-100">
                        <img src="{{ $b->foto ? asset('storage/'.$b->foto) : 'https://via.placeholder.com/300x220' }}"
                             class="card-img-top book-img">

                        <div class="card-body">
                            <h5 class="fw-bold">{{ $b->judul }}</h5>
                            <p class="text-muted mb-1">Kategori: {{ $b->kategori?->nama ?? '-' }}</p>
                            <p class="text-muted mb-1">Penulis: {{ $b->penulis?->nama ?? '-' }}</p>
                            <p class="text-muted mb-2">Penerbit: {{ $b->penerbit ?? '-' }}</p>

                            <span class="badge bg-info">Stok: {{ $b->stok_pinjam }}</span>
                        </div>

                        <div class="px-3 pb-3">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_buku" value="{{ $b->id_buku }}">
                                <input type="hidden" name="jenis" value="pinjam">
                                <button class="btn btn-outline-secondary btn-sm w-100"
                                    {{ ($b->stok_pinjam ?? 0) <= 0 ? 'disabled' : '' }}>
                                    + Keranjang Pinjam
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- ================= BELI ================= --}}
    <h4 class="fw-bold mb-3">🛒 Buku Yang Bisa Dibeli</h4>

    @php
        $bukuJual = $buku->where('tersedia_jual', true);
    @endphp

    @if ($bukuJual->isEmpty())
        <div class="alert alert-warning">Tidak ada buku untuk dibeli</div>
    @else
        <div class="row g-4">
            @foreach ($bukuJual as $b)
                <div class="col-md-4">
                    <div class="card shadow h-100">
                        <img src="{{ $b->foto ? asset('storage/'.$b->foto) : 'https://via.placeholder.com/300x220' }}"
                             class="card-img-top book-img">

                        <div class="card-body">
                            <h5 class="fw-bold">{{ $b->judul }}</h5>
                            <p class="text-muted mb-1">Kategori: {{ $b->kategori?->nama ?? '-' }}</p>
                            <p class="text-muted mb-1">Penulis: {{ $b->penulis?->nama ?? '-' }}</p>
                            <p class="text-muted mb-2">Penerbit: {{ $b->penerbit ?? '-' }}</p>

                            <p class="fw-bold text-success">
                                Rp {{ number_format($b->harga, 0, ',', '.') }}
                            </p>

                            <span class="badge bg-info">Stok: {{ $b->stok_jual }}</span>
                        </div>

                        <div class="px-3 pb-3">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_buku" value="{{ $b->id_buku }}">
                                <input type="hidden" name="jenis" value="jual">
                                <button class="btn btn-outline-primary btn-sm w-100"
                                    {{ ($b->stok_jual ?? 0) <= 0 ? 'disabled' : '' }}>
                                    + Keranjang Beli
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
    <small>© {{ date('Y') }} Perpustakaan Digital</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@include('user.minicart')
</body>
</html>
