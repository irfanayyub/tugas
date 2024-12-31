<?php
namespace App\Http\Controllers;

use App\Models\Customer; // Pastikan Anda memiliki model Customer
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all(); // Ambil semua pelanggan
        return view('customers.index', compact('customers')); // Tampilkan daftar pelanggan
    }

    public function create()
    {
        return view('customers.create'); // Tampilkan form pembuatan pelanggan
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            // Validasi lainnya sesuai kebutuhan
        ]);

        Customer::create($request->all()); // Simpan pelanggan baru
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id); // Ambil pelanggan berdasarkan ID
        return view('customers.show', compact('customer')); // Tampilkan detail pelanggan
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id); // Ambil pelanggan berdasarkan ID
        return view('customers.edit', compact('customer')); // Tampilkan form edit pelanggan
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . $id,
            // Validasi lainnya sesuai kebutuhan
        ]);

        $customer = Customer::findOrFail($id); // Ambil pelanggan berdasarkan ID
        $customer->update($request->all()); // Perbarui pelanggan
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id); // Ambil pelanggan berdasarkan ID
        $customer->delete(); // Hapus pelanggan
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}