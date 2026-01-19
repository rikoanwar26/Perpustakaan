<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang | Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h3 class="fw-bold mb-3">🧺 Keranjang</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm mb-3">
        <div class="card-header fw-bold">Keranjang Anda</div>
        <div class="card-body">

            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf

                {{-- Untuk Dibeli --}}
                @if(count($jualItems) > 0)
                    <h5 class="mt-2">🛒 Untuk Dibeli</h5>
                    @foreach ($jualItems as $b)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>{{ $b->judul }}</strong>
                                <div class="small text-muted">
                                    Rp {{ number_format($b->harga,0,',','.') }} • x{{ $cart['jual'][$b->id_buku] ?? 1 }}
                                </div>
                            </div>
                            <input type="hidden" name="jual[{{ $b->id_buku }}]" value="{{ $cart['jual'][$b->id_buku] ?? 1 }}">
                        </div>
                    @endforeach

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opt_jual" id="opt_jual_outlet" value="outlet" checked>
                        <label class="form-check-label" for="opt_jual_outlet">Ambil di outlet</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opt_jual" id="opt_jual_antar" value="antar">
                        <label class="form-check-label" for="opt_jual_antar">Diantar (Rp 10.000)</label>
                    </div>
                    <input type="hidden" name="biaya_jual" id="kirim_jual" value="0">
                @endif

                {{-- Untuk Dipinjam --}}
                @if(count($pinjamItems) > 0)
                    <h5 class="mt-3">📖 Untuk Dipinjam</h5>
                    @foreach ($pinjamItems as $b)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>{{ $b->judul }}</strong>
                                <div class="small text-muted">
                                    Tarif pinjam Rp 10.000 • 5 hari • x{{ $cart['pinjam'][$b->id_buku] ?? 1 }}
                                </div>
                            </div>
                            <input type="hidden" name="pinjam[{{ $b->id_buku }}]" value="{{ $cart['pinjam'][$b->id_buku] ?? 1 }}">
                        </div>
                    @endforeach

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opt_pinjam" id="opt_pinjam_outlet" value="outlet" checked>
                        <label class="form-check-label" for="opt_pinjam_outlet">Ambil di outlet</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opt_pinjam" id="opt_pinjam_antar" value="antar">
                        <label class="form-check-label" for="opt_pinjam_antar">Diantar (Rp 10.000)</label>
                    </div>
                    <input type="hidden" name="biaya_pinjam" id="kirim_pinjam" value="0">
                @endif

                @if(count($jualItems) > 0 || count($pinjamItems) > 0)
                    <button class="btn btn-primary mt-3 w-100">Checkout Semua</button>
                @else
                    <div class="text-muted">Keranjang kosong</div>
                @endif
            </form>

        </div>
    </div>
</div>

<script>
document.getElementById('opt_jual_outlet')?.addEventListener('change', function(){
    document.getElementById('kirim_jual').value = 0;
});
document.getElementById('opt_jual_antar')?.addEventListener('change', function(){
    document.getElementById('kirim_jual').value = 10000;
});

document.getElementById('opt_pinjam_outlet')?.addEventListener('change', function(){
    document.getElementById('kirim_pinjam').value = 0;
});
document.getElementById('opt_pinjam_antar')?.addEventListener('change', function(){
    document.getElementById('kirim_pinjam').value = 10000;
});
</script>

</body>
</html>
