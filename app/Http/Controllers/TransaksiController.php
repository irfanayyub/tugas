<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('pemesanan.mobil', 'pemesanan.pelanggan')->get();
        return view('transaksis.index', compact('transaksis'));
    }

    public function create(Request $request)
    {
        $pemesanan = Pemesanan::with('mobil', 'pelanggan')->find($request->pemesanan_id);

        if (!$pemesanan) {
            return redirect()->route('pemesanans.index')->with('error', 'Pemesanan tidak ditemukan.');
        }

        return view('transaksis.create', compact('pemesanan'));
    }

    public function store(Request $request)
    {
        // Validasi data transaksi
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanan,id', // Gunakan nama tabel yang benar
            'tanggal_transaksi' => 'required|date',
        ]);
    
        try {
            $pemesanan = Pemesanan::find($request->pemesanan_id);
    
            if (!$pemesanan) {
                return redirect()->back()->with('error', 'Pemesanan tidak valid.');
            }
    
            Transaksi::create([
                'pemesanan_id' => $request->pemesanan_id,
                'total_harga' => $pemesanan->total_harga, // Ambil dari pemesanan
                'tanggal_transaksi' => $request->tanggal_transaksi,
            ]);
    
            // Update status pemesanan setelah transaksi berhasil
            $pemesanan->update(['status' => 'confirmed']);
    
            return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat transaksi: ' . $e->getMessage());
        }
    }    

    public function show(Transaksi $transaksi)
    {
        return view('transaksis.show', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        $pemesanans = Pemesanan::all();
        return view('transaksis.edit', compact('transaksi', 'pemesanans'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanan,id',
            'tanggal_transaksi' => 'required|date',
        ]);

        $transaksi->update([
            'pemesanan_id' => $request->pemesanan_id,
            'total_harga' => Pemesanan::find($request->pemesanan_id)->total_harga,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
