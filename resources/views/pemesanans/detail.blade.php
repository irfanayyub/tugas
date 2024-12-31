@extends('layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Detail Pemesanan Mobil</h3>
    </div>
    <div class="box-body">
        <h4>Informasi Mobil</h4>
        <p><strong>Nama Mobil:</strong> {{ $mobil->nama }}</p>
        <p><strong>Merk Mobil:</strong> {{ $mobil->merk }}</p>
        <p><strong>Tahun Mobil:</strong> {{ $mobil->tahun }}</p>
        <p><strong>Harga per Hari:</strong> Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}</p>

        @if($pemesan)
            <h4>Informasi Pemesan</h4>
            <p><strong>Nama:</strong> {{ $pemesan->nama }}</p>
            <p><strong>Alamat:</strong> {{ $pemesan->alamat }}</p>
            <p><strong>Email:</strong> {{ $pemesan->email }}</p>
            <p><strong>No HP:</strong> {{ $pemesan->no_hp }}</p>
            <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($pemesan->tanggal_mulai)->format('d-m-Y') }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($pemesan->tanggal_selesai)->format('d-m-Y') }}</p>

            @php
                // Menghitung total harga
                $tanggalMulai = \Carbon\Carbon::parse($pemesan->tanggal_mulai);
                $tanggalSelesai = \Carbon\Carbon::parse($pemesan->tanggal_selesai);
                $durasiHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1; // Tambah 1 untuk menghitung hari terakhir
                $totalHarga = $durasiHari * $mobil->harga_per_hari;
            @endphp

            <p><strong>Total Harga:</strong> Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
        @else
            <p>Tidak ada informasi pemesan untuk mobil ini.</p>
        @endif

        <a href="{{ route('pemesan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection