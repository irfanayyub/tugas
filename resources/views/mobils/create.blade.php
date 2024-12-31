@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Mobil</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mobils.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Mobil</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="plat_nomor">Plat Nomor</label>
            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" required>
        </div>
        <div class="form-group">
            <label for="merk">Merk Mobil</label>
            <input type="text" class="form-control" id="merk" name="merk" required>
        </div>
        <div class="form-group">
            <label for="harga_per_hari">Harga Sewa</label>
            <input type="number" class="form-control" id="harga_per_hari" name="harga_per_hari" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="available">Tersedia</option>
                <option value="Di Sewa">Di Sewa</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Gambar Mobil</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const preview = document.createElement('img');
            preview.src = URL.createObjectURL(file);
            preview.alt = "Preview Gambar";
            preview.style.width = "200px";
            document.body.appendChild(preview);
        }
    });
</script>
@endsection
