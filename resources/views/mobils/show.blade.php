@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Mobil</h1>
    
    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $mobil->nama }}</p>
            <p><strong>Plat Nomor:</strong> {{ $mobil->plat_nomor }}</p>
            <p><strong>Merk:</strong> {{ $mobil->merk }}</p>
            <p><strong>Harga Sewa:</strong> {{ number_format($mobil->harga_per_hari, 2) }} IDR</p>
            <p><strong>Status:</strong> {{ $mobil->status }}</p>

            <!-- Menampilkan gambar mobil -->
            @if($mobil->image)
                <div class="mb-3">
                    <strong>Gambar:</strong><br>
                    <img src="{{ asset($mobil->image) }}" alt="Gambar Mobil" class="img-fluid" style="max-width: 300px;">
                </div>
            @else
                <p>Tidak ada gambar yang tersedia.</p>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('mobils.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('mobils.edit', $mobil->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('mobils.destroy', $mobil->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus mobil ini?');">Hapus</button>
        </form>
    </div>
</div>
@endsection