<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations'; // Table name

    protected $primaryKey = 'reservasi_id'; // Primary key

    protected $fillable = [
        'nama_pelanggan',
        'nomor_kontak',
        'waktu_reservasi',
        'nomor_meja',
        'status',
    ];

    protected $casts = [
        'waktu_reservasi' => 'datetime',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class, 'nomor_meja', 'nomor_meja');
    }
}
