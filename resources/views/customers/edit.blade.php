@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Pelanggan</h1>

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')  <!-- Menandakan bahwa ini adalah permintaan UPDATE -->
            
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required>
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea class="form-control" id="address" name="address">{{ old('address', $customer->address) }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
