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
                @endif

                {{-- Metode pengantaran (gabungan) --}}
                @if(count($jualItems) > 0 || count($pinjamItems) > 0)
                    <hr>
                    <h6 class="fw-bold">Metode Pengantaran</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opt_pengantaran" id="opt_pengantaran_outlet" value="outlet" checked>
                        <label class="form-check-label" for="opt_pengantaran_outlet">Ambil di outlet</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opt_pengantaran" id="opt_pengantaran_antar" value="antar">
                        <label class="form-check-label" for="opt_pengantaran_antar">Diantar (Rp 10.000)</label>
                    </div>
                    <input type="hidden" name="biaya_pengantaran" id="biaya_pengantaran" value="0">
                    
                    <div class="mt-3 d-none" id="konfirmasi_diantar_cart">
                        <div class="mb-2">
                            <label class="form-label">Nama Penerima</label>
                            <input type="text" class="form-control" name="nama_penerima">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat_pengantaran" rows="2"></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Link Google Maps</label>
                            <input type="text" class="form-control" name="link_maps" placeholder="https://maps.app.goo.gl/...">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" name="no_telepon" placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
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
document.getElementById('opt_pengantaran_outlet')?.addEventListener('change', function(){
    document.getElementById('biaya_pengantaran').value = 0;
    const konfirmasi = document.getElementById('konfirmasi_diantar_cart');
    if (konfirmasi) {
        konfirmasi.classList.add('d-none');
        ['nama_penerima','alamat_pengantaran','link_maps','no_telepon'].forEach(function(nm){
            const el = konfirmasi.querySelector('[name="'+nm+'"]');
            if (el) el.removeAttribute('required');
        });
    }
});
document.getElementById('opt_pengantaran_antar')?.addEventListener('change', function(){
    document.getElementById('biaya_pengantaran').value = 10000;
    const konfirmasi = document.getElementById('konfirmasi_diantar_cart');
    if (konfirmasi) {
        konfirmasi.classList.remove('d-none');
        ['nama_penerima','alamat_pengantaran','link_maps','no_telepon'].forEach(function(nm){
            const el = konfirmasi.querySelector('[name="'+nm+'"]');
            if (el) el.setAttribute('required','required');
        });
    }
});
</script>

</body>
</html>
