@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pemesanan</h1>
    <form action="{{ route('pemesanans.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="mobil_id" class="form-label">Mobil</label>
            <select name="mobil_id" id="mobil_id" class="form-control" required>
                <option value="">-- Pilih Mobil --</option>
                @foreach ($mobils as $mobil)
                    <option value="{{ $mobil->id }}">{{ $mobil->merk }} - {{ $mobil->model }} ({{ $mobil->plat_nomor }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pelanggan_id" class="form-label">Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan_id" class="form-control" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach ($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->name }} - {{ $pelanggan->email }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="canceled">Canceled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
