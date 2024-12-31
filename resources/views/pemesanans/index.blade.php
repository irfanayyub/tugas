@extends('layouts.app')

@section('title', 'Daftar Pemesanan')

@section('content')
<div class="box">
    <!-- Tombol Tambah Pesanan -->
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Pemesanan</h3>
        <a href="{{ route('pemesanans.create') }}" class="btn btn-primary btn-sm" style="float: right;">Tambah Pesanan</a>
    </div>
    <div class="box-body">
        @if($pemesanans->isEmpty())
            <p>Belum ada pemesanan.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Mobil</th>
                        <th>Nama Pelanggan</th> <!-- Kolom baru untuk nama pelanggan -->
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemesanans as $pemesanan)
                        <tr>
                            <td>{{ $pemesanan->id }}</td>
                            <td>{{ $pemesanan->mobil->nama }}</td>
                            <td>{{ $pemesanan->pelanggan->name }}</td> <!-- Menampilkan nama pelanggan -->
                            <td>{{ $pemesanan->tanggal_mulai }}</td>
                            <td>{{ $pemesanan->tanggal_selesai }}</td>
                            <td>{{ ucfirst($pemesanan->status) }}</td>
                            <td>Rp {{ number_format($pemesanan->total_harga, 2, ',', '.') }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('pemesanans.edit', $pemesanan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('pemesanans.destroy', $pemesanan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pemesanan ini?')">Hapus</button>
                                </form>

                                <!-- Tombol Bayar -->
                                <a href="{{ route('transaksis.create', ['pemesanan_id' => $pemesanan->id]) }}" class="btn btn-success btn-sm">Bayar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
