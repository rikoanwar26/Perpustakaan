@php
$cart = session('cart', ['jual' => [], 'pinjam' => []]);
$countJual = array_sum($cart['jual']);
$countPinjam = array_sum($cart['pinjam']);
$totalCount = $countJual + $countPinjam;
@endphp
@if($totalCount > 0)
<a href="{{ route('cart') }}" style="position:fixed;right:20px;bottom:20px;z-index:1040;text-decoration:none;">
    <div style="background:#fff;border:1px solid #dee2e6;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.1);padding:12px 16px;min-width:180px;display:flex;align-items:center;gap:10px;">
        <span style="font-size:20px;">🧺</span>
        <div>
            <div style="font-weight:700;color:#0d6efd;">Keranjang</div>
            <div style="font-size:12px;color:#6c757d;">Beli: {{ $countJual }} • Pinjam: {{ $countPinjam }}</div>
        </div>
        <span style="margin-left:auto;background:#0d6efd;color:#fff;border-radius:999px;padding:2px 8px;font-size:12px;">{{ $totalCount }}</span>
    </div>
</a>
@endif
