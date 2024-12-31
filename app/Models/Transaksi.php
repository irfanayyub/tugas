<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'transaksis'; 

    // Kolom yang dapat diisi
    protected $fillable = ['pemesanan_id', 'total_harga', 'tanggal_transaksi'];

    /**
     * Relasi dengan model Pemesanan
     */
    public function pemesanan()
    {
        // Relasi belongsTo dengan foreign key 'pemesanan_id'
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id', 'id');
    }
}
