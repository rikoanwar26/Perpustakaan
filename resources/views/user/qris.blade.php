<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran QRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/user">📚 Perpustakaan</a>
    </div>
</nav>

<div class="container py-5 text-center">
    <div class="card shadow mx-auto" style="max-width: 400px;">
        <div class="card-body">

            <h4 class="fw-bold mb-3">Pembayaran QRIS</h4>

            <p class="text-muted">
                Silakan scan QR di bawah untuk menyelesaikan pembayaran
            </p>

            {{-- QRIS DUMMY --}}
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=TRANSAKSI-{{ $id }}"
                 class="img-fluid my-3"
                 alt="QRIS">

            <div class="mb-3">
                <div class="fw-semibold">Total Pembayaran</div>
                <div class="fs-5 text-success">Rp {{ number_format($total, 0, ',', '.') }}</div>
                <small class="text-muted">Jenis: {{ ucfirst($jenis) }}</small>
            </div>

                 <form action="/konfirmasi-bayar/{{ $id }}" method="POST">
                    @csrf
                    <button class="btn btn-warning w-100">
                        ⏳ Saya Sudah Bayar
                    </button>
                </form>
                <form action="/batal-bayar/{{ $id }}" method="POST" class="mt-2">
                    @csrf
                    <button class="btn btn-outline-danger w-100">
                        ❌ Batalkan Pembayaran
                    </button>
                </form>
                            
        </div>
    </div>
</div>

<footer class="text-center mt-5 text-muted">
    <small>© {{ date('Y') }} Perpustakaan Digital</small>
</footer>

</body>
</html>
