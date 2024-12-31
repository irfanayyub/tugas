@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Transaksi</h1>
    <a href="{{ route('transaksis.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Pesanan</th>
                <th>Total Harga</th>
                <th>Tanggal Transaksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($transaksi->pemesanan)
                            ID Pemesanan: {{ $transaksi->pemesanan->id }} <br>
                            Mobil: {{ $transaksi->pemesanan->mobil_id }} <br>
                            Pelanggan: {{ $transaksi->pemesanan->pelanggan_id }} <br>
                            Status: {{ $transaksi->pemesanan->status }} <br>
                            Total Harga Pemesanan: {{ $transaksi->pemesanan->total_harga }}
                        @else
                            <p>Pemesanan tidak ditemukan.</p>
                        @endif
                    </td>
                    <td>{{ $transaksi->total_harga }}</td>
                    <td>{{ $transaksi->tanggal_transaksi }}</td>
                    <td>
                        <a href="{{ route('transaksis.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
