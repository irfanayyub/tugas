@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Mobil</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('mobils.create') }}" class="btn btn-primary mb-3">Tambah Mobil</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Plat Nomor</th>
                <th>Merk</th>
                <th>Harga Sewa</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mobils as $mobil)
            <tr>
                <td>{{ $mobil->nama }}</td>
                <td>{{ $mobil->plat_nomor }}</td>
                <td>{{ $mobil->merk }}</td>
                <td>{{ number_format($mobil->harga_per_hari, 0, ',', '.') }} IDR</td>
                <td>{{ ucfirst($mobil->status) }}</td>
                <td>
                    <a href="{{ route('mobils.show', $mobil->id) }}" class="btn btn-info">Detail</a>
                    <a href="{{ route('mobils.edit', $mobil->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('mobils.destroy', $mobil->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    @if ($mobils->hasPages())
        <div class="d-flex justify-content-center">
            {{ $mobils->links() }}
        </div>
    @endif
</div>
@endsection
