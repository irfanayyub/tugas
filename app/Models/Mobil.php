<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'merk',
        'plat_nomor',
        'harga_per_hari',  // Pastikan harga ada di sini
        'status',
        'image',  // Gambar mobil
    ];
}
