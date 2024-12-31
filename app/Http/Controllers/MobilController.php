<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::paginate(10);
        return view('mobils.index', compact('mobils'));
    }

    public function create()
    {
        return view('mobils.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'harga_per_hari' => 'required|numeric',  // Pastikan harga diset
            'status' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menyimpan gambar
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        // Menyimpan data mobil
        Mobil::create([
            'nama' => $request->nama,
            'plat_nomor' => $request->plat_nomor,
            'merk' => $request->merk,
            'harga_per_hari' => $request->harga_per_hari,  // Menyimpan harga dengan benar
            'status' => $request->status,
            'image' => 'images/' . $imageName,
        ]);

        return redirect()->route('mobils.index')->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function show(Mobil $mobil)
    {
        return view('mobils.show', compact('mobil'));
    }

    public function edit(Mobil $mobil)
    {
        return view('mobils.edit', compact('mobil'));
    }

    public function update(Request $request, Mobil $mobil)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'harga_per_hari' => 'required|numeric',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($mobil->image) {
                $oldImagePath = public_path($mobil->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $mobil->image = 'images/' . $imageName;
        }

        $mobil->update($request->except('image'));

        return redirect()->route('mobils.index')->with('success', 'Mobil berhasil diperbarui.');
    }

    public function destroy(Mobil $mobil)
    {
        if ($mobil->image) {
            $oldImagePath = public_path($mobil->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
    
        $mobil->delete();
        return redirect()->route('mobils.index')->with('success', 'Mobil berhasil dihapus.');
    }
}
