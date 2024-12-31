<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    // Relasi dengan Pemesanan
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'pelanggan_id');
    }
}
