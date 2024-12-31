@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Mobil</h1>
    
    <form action="{{ route('mobils.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama Mobil</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $mobil->nama) }}" required>
        </div>

        <div class="form-group">
            <label for="plat_nomor">Plat Nomor</label>
            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" value="{{ old('plat_nomor', $mobil->plat_nomor) }}" required>
        </div>

        <div class="form-group">
            <label for="merk">Merk</label>
            <input type="text" class="form-control" id="merk" name="merk" value="{{ old('merk', $mobil->merk) }}" required>
        </div>

        <div class="form-group">
            <label for="harga_per_hari">Harga Sewa</label>
            <input type="number" class="form-control" id="harga_per_hari" name="harga_per_hari" value="{{ old('harga_per_hari', $mobil->harga_per_hari) }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="available" {{ old('status', $mobil->status) == 'available' ? 'selected' : '' }}>Tersedia</option>
                <option value="Di Sewa" {{ old('status', $mobil->status) == 'Di Sewa' ? 'selected' : '' }}>Di Sewa</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Gambar Mobil</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            @if($mobil->image)
                <img src="{{ Storage::url('public/mobil_images/' . $mobil->image) }}" alt="Gambar Mobil" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
