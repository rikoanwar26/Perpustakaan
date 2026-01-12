<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .hero {
            background: linear-gradient(120deg, #1e3c72, #2a5298);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .hero img {
            max-width: 100%;
        }
        .feature-icon {
            font-size: 40px;
            color: #1e3c72;
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">📚 Perpustakaan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="#fitur" class="nav-link">Fitur</a>
                </li>
                <li class="nav-item">
                    <a href="/login" class="btn btn-primary ms-3 px-4">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- HERO SECTION --}}
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="fw-bold display-5 mb-3">
                    Sistem Perpustakaan Digital
                </h1>
                <p class="lead mb-4">
                    Pinjam dan beli buku secara online, cepat, aman, dan mudah.
                    Mendukung pembayaran digital QRIS.
                </p>
                <p class="lead mb-4">
                    Login untuk melihat Buku-Buku Menarik.
                </p>
                <a href="/login" class="btn btn-light btn-lg px-5">
                    Mulai Sekarang
                </a>
            </div>
            <div class="col-md-6 text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png" alt="Buku">
            </div>
        </div>
    </div>
</section>

{{-- FITUR --}}
<section id="fitur" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Fitur Unggulan</h2>
            <p class="text-muted">Kenapa memilih sistem kami?</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow h-100 text-center p-4">
                    <div class="feature-icon mb-3">📖</div>
                    <h5 class="fw-bold">Pinjam & Beli Buku</h5>
                    <p class="text-muted">
                        Pengguna dapat meminjam atau membeli buku dengan mudah.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow h-100 text-center p-4">
                    <div class="feature-icon mb-3">💳</div>
                    <h5 class="fw-bold">Pembayaran QRIS</h5>
                    <p class="text-muted">
                        Pembayaran online cepat menggunakan QRIS & barcode.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow h-100 text-center p-4">
                    <div class="feature-icon mb-3">📊</div>
                    <h5 class="fw-bold">Riwayat Transaksi</h5>
                    <p class="text-muted">
                        Semua transaksi tersimpan rapi dan dapat dilihat kapan saja.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="bg-dark text-white text-center py-3">
    <small>
        © {{ date('Y') }} Perpustakaan Digital | By Rico Anwar
    </small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>