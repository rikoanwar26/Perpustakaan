<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat | Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6fa; }
        .card { border-radius: 15px; overflow: hidden; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark shadow">
    <div class="container">
        <button class="navbar-toggler me-2"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand fw-bold" href="/user">📚 Perpustakaan</a>
    </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title">📚 Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
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

<div class="container py-5">
    <h3 class="fw-bold mb-4">📜 Riwayat Transaksi</h3>

    @forelse ($transaksi as $t)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <strong>{{ ucfirst($t->jenis) }} • {{ $t->created_at->format('d M Y') }}</strong>
                    <span class="badge
                        @if($t->status === 'Berhasil') bg-success
                        @elseif($t->status === 'Menunggu Konfirmasi') bg-warning text-dark
                        @elseif($t->status === 'Menunggu Pembayaran') bg-secondary
                        @else bg-danger
                        @endif">
                        {{ $t->status }}
                    </span>
                </div>
                <hr>
                @foreach ($t->detail as $d)
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <strong>{{ $d->buku->judul ?? '-' }}</strong><br>
                            <small class="text-muted">
                                {{ $d->jumlah }} x
                                Rp {{ number_format($d->jumlah > 0 ? $d->total_harga / $d->jumlah : 0, 0, ',', '.') }}
                            </small>
                        </div>
                        <strong>Rp {{ number_format($d->total_harga, 0, ',', '.') }}</strong>
                    </div>
                @endforeach
                <hr>
                <div class="text-end">
                    <strong>Total: Rp {{ number_format($t->detail->sum('total_harga'), 0, ',', '.') }}</strong>
                </div>
                @if ($t->status === 'Menunggu Pembayaran')
                    <a href="{{ route('qris', $t->id_transaksi) }}" class="btn btn-sm btn-primary mt-3">💳 Bayar Sekarang</a>
                @elseif ($t->status === 'Menunggu Konfirmasi')
                    <button class="btn btn-sm btn-warning mt-3" disabled>⏳ Menunggu Konfirmasi Admin</button>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada transaksi 📭</div>
    @endforelse
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
    <small>© {{ date('Y') }} Perpustakaan Digital</small>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
