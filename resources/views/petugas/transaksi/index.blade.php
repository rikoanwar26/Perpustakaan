@extends('petugas.layout')
@section('content')

<h4>Data Transaksi</h4>

<table class="table table-hover bg-white shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>User</th>
            <th>Alamat</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Pengantaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksi as $t)
        <tr>
            <td>{{ $t->pengguna->nama }}</td>

            {{-- ALAMAT USER --}}
            <td>
                {{ $t->pengguna->alamat ?? '-' }}
            </td>

            <td>{{ $t->created_at->format('d M Y') }}</td>

            <td>
                <span class="badge 
                    @if($t->status == 'Berhasil' || $t->status == 'selesai')
                        bg-success
                    @elseif($t->status == 'Dibatalkan')
                        bg-danger
                    @elseif($t->status == 'Menunggu Konfirmasi' || $t->status == 'menunggu konfirmasi')
                        bg-warning text-dark
                    @elseif($t->status == 'Menunggu Pembayaran')
                        bg-secondary
                    @else
                        bg-secondary
                    @endif
                ">
                    {{ $t->status }}
                </span>
            </td>
            <td>
                <div>
                    <span class="badge bg-info text-dark">
                        {{ $t->metode_pengantaran ? ucfirst($t->metode_pengantaran) : 'Outlet' }}
                    </span>
                    <div class="small">Jenis: {{ ucfirst($t->jenis) }}</div>
                    <div class="small text-muted">
                        Biaya: Rp {{ number_format((int)($t->biaya_pengantaran ?? 0), 0, ',', '.') }}
                    </div>
                    @if($t->jenis === 'pinjam' && (int)($t->biaya_peminjaman ?? 0) > 0)
                        <div class="small text-muted">
                            Peminjaman: Rp {{ number_format((int)$t->biaya_peminjaman, 0, ',', '.') }}
                        </div>
                    @endif
                </div>
            </td>

            <td>
                <div class="small">
                    @foreach($t->detail as $d)
                        <div>• {{ $d->buku->judul ?? '-' }} (x{{ $d->jumlah }})</div>
                    @endforeach
                </div>
                {{-- KONFIRMASI PEMBAYARAN --}}
                @if($t->status == 'Menunggu Konfirmasi' || $t->status == 'menunggu konfirmasi' || $t->status == 'Menunggu Pembayaran')
                <form action="{{ route('admin.konfirmasi', $t->id_transaksi) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin konfirmasi pembayaran ini?')"
                      class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success">
                        ✅ Konfirmasi
                    </button>
                </form>
                @else
                    <span class="text-muted">-</span>
                @endif
                <form action="{{ route('admin.transaksi.hapus', $t->id_transaksi) }}"
                      method="POST"
                      class="d-inline ms-1"
                      onsubmit="return confirm('Hapus transaksi ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
