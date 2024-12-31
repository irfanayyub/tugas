<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'pemesanan';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'mobil_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'pelanggan_id',
        'total_harga',
    ];

    // Status pemesanan
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CANCELED = 'canceled';

    /**
     * Relasi dengan model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan model Mobil
     */
    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }

    /**
     * Relasi dengan model Customer (pelanggan)
     */
    public function pelanggan()
    {
        return $this->belongsTo(Customer::class, 'pelanggan_id');
    }

    /**
     * Scope untuk mendapatkan pemesanan yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Accessor untuk mengubah format status
     */
    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Method untuk mengonfirmasi pemesanan
     */
    public function confirm()
    {
        $this->update(['status' => self::STATUS_CONFIRMED]);
    }

    /**
     * Method untuk membatalkan pemesanan
     */
    public function cancel()
    {
        $this->update(['status' => self::STATUS_CANCELED]);
    }
}
