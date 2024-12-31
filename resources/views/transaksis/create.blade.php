@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Transaksi</h1>
    <form action="{{ route('transaksis.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="pemesanan_id">Pesanan</label>
            <input type="hidden" value="{{ $pemesanan->id }}" name="pemesanan_id" id="pemesanan_id">
            <input type="text" class="form-control" value="Pesanan #{{ $pemesanan->id }}" readonly>
        </div>

        <div class="form-group">
            <label for="mobil">Mobil</label>
            <input type="text" class="form-control" value="{{ $pemesanan->mobil->nama }}" readonly>
        </div>

        <div class="form-group">
            <label for="pelanggan">Nama Pelanggan</label>
            <input type="text" class="form-control" value="{{ $pemesanan->pelanggan->name }}" readonly>
        </div>

        <div class="form-group">
            <label for="total_harga">Total Harga</label>
            <input type="number" class="form-control" value="{{ $pemesanan->total_harga }}" name="total_harga" id="total_harga" readonly>
        </div>

        <div class="form-group">
            <label for="tanggal_transaksi">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>
</div>
@endsection
