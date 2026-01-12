<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang | Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark shadow">
    <div class="container">
        <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
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
            <a href="/user" class="list-group-item list-group-item-action">🏠 Dashboard</a>
            <a href="/user/beli" class="list-group-item list-group-item-action">🛒 Beli Buku</a>
            <a href="/user/pinjam" class="list-group-item list-group-item-action">📖 Pinjam Buku</a>
            <a href="/cart" class="list-group-item list-group-item-action active">🧺 Keranjang</a>
            <a href="/riwayat" class="list-group-item list-group-item-action">📄 Riwayat Transaksi</a>
        </div>
        <hr class="my-2">
        <div class="list-group list-group-flush">
            <a href="/logout" class="list-group-item list-group-item-action text-danger">🚪 Logout</a>
        </div>
    </div>
</div>

<div class="container py-4">
    <h3 class="fw-bold mb-3">🧺 Keranjang</h3>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Untuk Dibeli</div>
                <div class="card-body">
                    @forelse ($jualItems as $b)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>{{ $b->judul }}</strong>
                                <div class="small text-muted">Rp {{ number_format($b->harga, 0, ',', '.') }} • x{{ $cart['jual'][$b->id_buku] ?? 1 }}</div>
                            </div>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_buku" value="{{ $b->id_buku }}">
                                <input type="hidden" name="jenis" value="jual">
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </div>
                    @empty
                        <div class="text-muted">Belum ada item</div>
                    @endforelse

                    <hr>
                    <form action="{{ route('cart.checkout') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="hidden" name="jenis" value="jual">
                        <input type="hidden" name="biaya_pengantaran" id="kirim_jual" value="0">
                        <input type="hidden" name="metode_pengantaran" id="metode_jual" value="outlet">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="opt_jual" id="opt_jual_outlet" value="outlet" checked>
                            <label class="form-check-label" for="opt_jual_outlet">Ambil di outlet</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="opt_jual" id="opt_jual_antar" value="antar">
                            <label class="form-check-label" for="opt_jual_antar">Diantar (Rp 10.000)</label>
                        </div>
                        <button class="btn btn-primary ms-auto">Checkout Beli</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Untuk Dipinjam</div>
                <div class="card-body">
                    @forelse ($pinjamItems as $b)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>{{ $b->judul }}</strong>
                                <div class="small text-muted">Tarif pinjam Rp 10.000 • 5 hari • x{{ $cart['pinjam'][$b->id_buku] ?? 1 }}</div>
                            </div>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_buku" value="{{ $b->id_buku }}">
                                <input type="hidden" name="jenis" value="pinjam">
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </div>
                    @empty
                        <div class="text-muted">Belum ada item</div>
                    @endforelse

                    <hr>
                    <form action="{{ route('cart.checkout') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="hidden" name="jenis" value="pinjam">
                        <input type="hidden" name="biaya_pengantaran" id="kirim_pinjam" value="0">
                        <input type="hidden" name="metode_pengantaran" id="metode_pinjam" value="outlet">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="opt_pinjam" id="opt_pinjam_outlet" value="outlet" checked>
                            <label class="form-check-label" for="opt_pinjam_outlet">Ambil di outlet</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="opt_pinjam" id="opt_pinjam_antar" value="antar">
                            <label class="form-check-label" for="opt_pinjam_antar">Diantar (Rp 10.000)</label>
                        </div>
                        <button class="btn btn-primary ms-auto">Checkout Pinjam</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('opt_jual_outlet').addEventListener('change', function(){
    document.getElementById('kirim_jual').value = 0;
    document.getElementById('metode_jual').value = 'outlet';
});
document.getElementById('opt_jual_antar').addEventListener('change', function(){
    document.getElementById('kirim_jual').value = 10000;
    document.getElementById('metode_jual').value = 'antar';
});
document.getElementById('opt_pinjam_outlet').addEventListener('change', function(){
    document.getElementById('kirim_pinjam').value = 0;
    document.getElementById('metode_pinjam').value = 'outlet';
});
document.getElementById('opt_pinjam_antar').addEventListener('change', function(){
    document.getElementById('kirim_pinjam').value = 10000;
    document.getElementById('metode_pinjam').value = 'antar';
});
</script>
</body>
</html>
