<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User | Perpustakaan</title>
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

        .menu-btn.active {
            background-color: #0d6efd;
            color: #fff;
            font-weight: 600;
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

        <a class="navbar-brand fw-bold" href="/user">📚 Perpustakaan</a>

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

            <a href="/riwayat" class="list-group-item list-group-item-action">
                📄 Riwayat Transaksi
            </a>
            <a href="{{ route('user.beli') }}" class="list-group-item list-group-item-action">
                🛒 Beli Buku
            </a>            

            <a href="{{ route('user.pinjam') }}" class="list-group-item list-group-item-action">
                📖 Pinjam Buku
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
    <h3 class="fw-bold mb-4">Daftar Buku</h3>

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

                            @if (!is_null($b->harga))
                                <p class="fw-bold text-success">
                                    Rp {{ number_format($b->harga, 0, ',', '.') }}
                                </p>
                            @endif
                        </div>
                        <div class="px-3 pb-3">
                            <form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-2">
                                @csrf
                                <input type="hidden" name="id_buku" value="{{ $b->id_buku }}">
                                <input type="hidden" name="jenis" value="jual">
                                <button class="btn btn-outline-primary btn-sm">+ Keranjang Beli</button>
                            </form>
                            <form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-2 mt-2">
                                @csrf
                                <input type="hidden" name="id_buku" value="{{ $b->id_buku }}">
                                <input type="hidden" name="jenis" value="pinjam">
                                <button class="btn btn-outline-secondary btn-sm">+ Keranjang Pinjam</button>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- SCRIPT MODE BELI / PINJAM --}}
<script>
    let currentJenis = 'jual';

    function syncJenis() {
        document.querySelectorAll('.jenis-input').forEach(input => {
            input.value = currentJenis;
        });
    }

    syncJenis();

    document.querySelectorAll('.menu-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.menu-btn')
                .forEach(b => b.classList.remove('active'));

            this.classList.add('active');
            currentJenis = this.dataset.jenis;
            syncJenis();

            // tutup sidebar otomatis
            bootstrap.Offcanvas.getInstance(
                document.getElementById('sidebarMenu')
            ).hide();
        });
    });
</script>

</body>
@include('user.minicart')
</html>
