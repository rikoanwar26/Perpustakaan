@extends('petugas.layout')
@section('content')

<h4>Tambah Pengembalian</h4>

@php
    $totalHargaBuku = 0;
    foreach ($transaksi->detail as $d) {
        $totalHargaBuku += (($d->buku->harga ?? 0) * $d->jumlah);
    }
@endphp

<div class="card mb-3">
    <div class="card-body">
        <div class="mb-2">
            <strong>Nama Peminjam:</strong> {{ $transaksi->pengguna->nama ?? '-' }}
        </div>
        <div><strong>Daftar Buku:</strong></div>
        <ul class="mb-0">
            @foreach($transaksi->detail as $d)
                <li>{{ $d->buku->judul ?? '-' }} (x{{ $d->jumlah }})</li>
            @endforeach
        </ul>
        <div class="mt-2">
            <strong>Total harga buku:</strong>
            Rp {{ number_format($totalHargaBuku, 0, ',', '.') }}
        </div>
    </div>
</div>

<form action="{{ route('admin.pengembalian.store') }}" method="POST">
    @csrf

    <input type="hidden" name="id_transaksi" value="{{ $transaksi->id_transaksi }}">
    <input type="hidden" id="base_denda" value="{{ $totalHargaBuku }}">

    <div class="mb-3">
        <label class="form-label">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Kondisi Buku</label>
        <select name="kondisi_buku" class="form-select" required>
            <option value="baik">Baik</option>
            <option value="rusak">Rusak</option>
            <option value="hilang">Hilang</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Denda (Rp)</label>
        <input type="number" name="denda" class="form-control" value="0">
    </div>

    <div class="mb-3">
        <label class="form-label">Nominal Dibayar (Cash)</label>
        <input type="number" name="uang_dibayar" class="form-control" value="0">
    </div>

    <div class="mb-3">
        <label class="form-label">Kembalian (Rp)</label>
        <input type="number" name="kembalian_tampil" class="form-control" value="0" readonly>
    </div>

    <button class="btn btn-success">💾 Simpan Pengembalian</button>
    <a href="{{ route('admin.pengembalian') }}" class="btn btn-secondary">Kembali</a>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var selectKondisi = document.querySelector('select[name="kondisi_buku"]');
    var inputDenda = document.querySelector('input[name="denda"]');
    var inputBayar = document.querySelector('input[name="uang_dibayar"]');
    var inputKembalian = document.querySelector('input[name="kembalian_tampil"]');
    var baseInput = document.getElementById('base_denda');
    var base = 0;
    if (baseInput && baseInput.value) {
        base = parseInt(baseInput.value, 10) || 0;
    }

    function updateDenda() {
        if (!selectKondisi || !inputDenda) {
            return;
        }
        var kondisi = selectKondisi.value;
        var denda = 0;
        if (kondisi === 'hilang') {
            denda = base;
        } else if (kondisi === 'rusak') {
            denda = base - 25000;
            if (denda < 0) {
                denda = 0;
            }
        } else {
            denda = 0;
        }
        inputDenda.value = denda;
        updateKembalian();
    }

    function updateKembalian() {
        if (!inputDenda || !inputBayar || !inputKembalian) {
            return;
        }
        var total = parseInt(inputDenda.value || 0, 10) || 0;
        var bayar = parseInt(inputBayar.value || 0, 10) || 0;
        var kembali = bayar - total;
        if (kembali < 0) {
            kembali = 0;
        }
        inputKembalian.value = kembali;
    }

    if (selectKondisi && inputDenda) {
        selectKondisi.addEventListener('change', updateDenda);
        updateDenda();
    }

    if (inputBayar) {
        inputBayar.addEventListener('input', updateKembalian);
    }
});
</script>

@endsection
