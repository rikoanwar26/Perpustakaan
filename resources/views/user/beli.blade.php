<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beli Buku | Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f6fa; }

        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .book-img {
            height: 220px;
            object-fit: cover;
        }
    </style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-dark bg-dark shadow">
    <div class="container">
        <button class="navbar-toggler me-2"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand fw-bold" href="/user">
            📚 Perpustakaan
        </a>
    </div>
</nav>

{{-- SIDEBAR --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title">📚 Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0">
        <div class="list-group list-group-flush">
            <a href="/user" class="list-group-item list-group-item-action">
                🏠 Dashboard
            </a>

            <a href="/user/beli" class="list-group-item list-group-item-action active">
                🛒 Beli Buku
            </a>

            <hr class="my-1">

            <a href="/user/pinjam" class="list-group-item list-group-item-action">
                📖 Pinjam Buku
            </a>

            <a href="/riwayat" class="list-group-item list-group-item-action">
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
    <h3 class="fw-bold mb-4">🛒 Beli Buku</h3>

    @if ($buku->isEmpty())
        <div class="alert alert-warning text-center">
            📕 Buku belum tersedia.
        </div>
    @else
        <div class="row g-4">
            @foreach ($buku as $b)
                <div class="col-md-4">
                    <div class="card shadow h-100">

                        @if ($b->foto)
                            <img src="{{ asset('storage/' . $b->foto) }}"
                                 class="card-img-top book-img"
                                 alt="{{ $b->judul }}">
                        @else
                            <img src="https://via.placeholder.com/300x220?text=No+Image"
                                 class="card-img-top book-img">
                        @endif

                        <div class="card-body">
                            <h5 class="fw-bold">{{ $b->judul }}</h5>

                            <p class="text-muted mb-1">
                                Kategori: {{ $b->kategori?->nama ?? '-' }}
                            </p>

                            <p class="text-muted mb-1">
                                Penulis: {{ $b->penulis?->nama ?? '-' }}
                            </p>

                            <p class="text-muted mb-2">
                                Penerbit: {{ $b->penerbit ?? '-' }}
                            </p>

                            <p class="fw-bold text-success">
                                Rp {{ number_format($b->harga, 0, ',', '.') }}
                            </p>

                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#beliModal-{{ $b->id_buku }}">
                                🛒 Beli Buku
                            </button>
                            <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="id_buku" value="{{ $b->id_buku }}">
                                <input type="hidden" name="jenis" value="jual">
                                <button class="btn btn-outline-primary w-100">+ Tambah ke Keranjang</button>
                            </form>
                        </div>

                    </div>
                </div>
                
                <div class="modal fade" id="beliModal-{{ $b->id_buku }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Pembelian</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="/checkout" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    <input type="hidden" name="id_buku" value="{{ $b->id_buku }}">
                                    <input type="hidden" name="jenis" value="jual">
                                    <input type="hidden" id="biaya_kirim_{{ $b->id_buku }}" name="biaya_pengantaran" value="0">
                                    <input type="hidden" id="metode_{{ $b->id_buku }}" name="metode_pengantaran" value="outlet">
                                    
                                    <div class="mb-2">Harga buku: <strong>Rp <span id="v_harga_{{ $b->id_buku }}">{{ number_format($b->harga, 0, ',', '.') }}</span></strong></div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Metode pengantaran</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="opt_pengantaran_{{ $b->id_buku }}" id="opt_outlet_{{ $b->id_buku }}" value="outlet" checked>
                                            <label class="form-check-label" for="opt_outlet_{{ $b->id_buku }}">Ambil di outlet (Rp 0)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="opt_pengantaran_{{ $b->id_buku }}" id="opt_antar_{{ $b->id_buku }}" value="antar">
                                            <label class="form-check-label" for="opt_antar_{{ $b->id_buku }}">Diantar ke rumah (Rp 10.000)</label>
                                        </div>
                                    </div>
                                    
                                    <div>Biaya pengantaran: <strong>Rp <span id="v_kirim_{{ $b->id_buku }}">0</span></strong></div>
                                    <div class="mt-2">Total: <strong>Rp <span id="v_total_{{ $b->id_buku }}">{{ number_format($b->harga, 0, ',', '.') }}</span></strong></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Lanjutkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    (function(){
                        const id = {{ $b->id_buku }};
                        const harga = {{ (int) $b->harga }};
                        const biayaAntar = 10000;
                        function format(num){ return num.toLocaleString('id-ID'); }
                        function sync(){
                            const antar = document.getElementById('opt_antar_' + id).checked;
                            const kirim = antar ? biayaAntar : 0;
                            document.getElementById('biaya_kirim_' + id).value = kirim;
                            document.getElementById('metode_' + id).value = antar ? 'antar' : 'outlet';
                            document.getElementById('v_kirim_' + id).textContent = format(kirim);
                            document.getElementById('v_total_' + id).textContent = format(harga + kirim);
                        }
                        document.getElementById('opt_outlet_' + id).addEventListener('change', sync);
                        document.getElementById('opt_antar_' + id).addEventListener('change', sync);
                        sync();
                    })();
                </script>
            @endforeach
        </div>
    @endif
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
    <small>© {{ date('Y') }} Perpustakaan Digital</small>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
@include('user.minicart')
</html>
