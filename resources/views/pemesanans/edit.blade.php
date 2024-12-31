@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pemesanan</h1>
    <form action="{{ route('pemesanans.update', $pemesanan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="mobil_id">Mobil</label>
            <select name="mobil_id" id="mobil_id" class="form-control">
                @foreach($mobils as $mobil)
                    <option value="{{ $mobil->id }}" {{ $pemesanan->mobil_id == $mobil->id ? 'selected' : '' }}>
                        {{ $mobil->merk }} - {{ $mobil->plat_nomor }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="pelanggan_id">Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan_id" class="form-control">
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}" {{ $pemesanan->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>
                        {{ $pelanggan->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $pemesanan->tanggal_mulai) }}">
        </div>

        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $pemesanan->tanggal_selesai) }}">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $pemesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $pemesanan->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="canceled" {{ $pemesanan->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
