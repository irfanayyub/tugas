<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Mobil;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PemesananController extends Controller
{
    public function index()
    {
        // Mengambil data pemesanan milik user yang sedang login dengan eager loading untuk mobil dan pelanggan
        $pemesanans = Pemesanan::where('user_id', auth()->id())->with('mobil', 'pelanggan')->get();
        // Mengambil data mobil yang tersedia
        $mobils = Mobil::where('status', 'available')->get();

        return view('pemesanans.index', compact('pemesanans', 'mobils'));
    }

    public function create()
    {
        // Mengambil data mobil yang tersedia dan data pelanggan
        $mobils = Mobil::where('status', 'available')->get();
        $pelanggans = Customer::all();

        return view('pemesanans.create', compact('mobils', 'pelanggans'));
    }
    public function store(Request $request)
    {
        // Validasi data input dari user
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'pelanggan_id' => 'required|exists:customers,id',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|string|in:pending,confirmed,canceled', // Validasi status
        ]);

        // Menghitung total harga sewa berdasarkan mobil yang dipilih dan durasi sewa
        $mobil = Mobil::find($request->mobil_id);
        $tanggalMulai = Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = Carbon::parse($request->tanggal_selesai);
        $hariSewa = $tanggalMulai->diffInDays($tanggalSelesai);
        $totalHarga = $mobil->harga_per_hari * $hariSewa;

        // Menyimpan data pemesanan ke database
        Pemesanan::create([
            'mobil_id' => $request->mobil_id,
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,  // Menggunakan status dari input form
            'user_id' => auth()->id(),
            'total_harga' => $totalHarga,
        ]);

        // Mengalihkan ke halaman daftar pemesanan dengan pesan sukses
        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil dibuat.');
    }

    public function edit($id)
    {
        // Mengambil data pemesanan, mobil yang tersedia, dan pelanggan
        $pemesanan = Pemesanan::findOrFail($id);
        $mobils = Mobil::where('status', 'available')->get();
        $pelanggans = Customer::all();

        return view('pemesanans.edit', compact('pemesanan', 'mobils', 'pelanggans'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data input dari user
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|string|in:pending,confirmed,canceled', // Validasi status
        ]);

        // Mengambil data pemesanan yang akan diperbarui
        $pemesanan = Pemesanan::findOrFail($id);

        // Menghitung total harga sewa berdasarkan mobil yang dipilih dan durasi sewa
        $mobil = Mobil::find($request->mobil_id);
        $tanggalMulai = Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = Carbon::parse($request->tanggal_selesai);
        $hariSewa = $tanggalMulai->diffInDays($tanggalSelesai);
        $totalHarga = $mobil->harga_per_hari * $hariSewa;

        // Memperbarui data pemesanan
        $pemesanan->update([
            'mobil_id' => $request->mobil_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,  // Menggunakan status yang dipilih dari form
            'total_harga' => $totalHarga,
        ]);

        // Mengalihkan ke halaman daftar pemesanan dengan pesan sukses
        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Mengambil dan menghapus data pemesanan
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        // Mengalihkan ke halaman daftar pemesanan dengan pesan sukses
        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil dihapus.');
    }
}
