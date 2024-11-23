<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'nomor_meja',
        'menu_id',
        'jumlah',
        'metode_pembayaran',
        'status',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class, 'nomor_meja', 'nomor_meja');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }
}
