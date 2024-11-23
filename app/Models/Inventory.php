<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';

    protected $primaryKey = 'inventory_id';

    protected $fillable = [
        'nama_bahan_pokok',
        'jumlah',
        'satuan',
        'supplier',
    ];
}
