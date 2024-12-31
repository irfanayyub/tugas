@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Pelanggan</h1>

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea class="form-control" id="address" name="address"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection