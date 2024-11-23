<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'nomor_meja',
        'menu_id',
        'jumlah',
        'status_pesanan',
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
