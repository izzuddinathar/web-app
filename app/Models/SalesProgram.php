<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesProgram extends Model
{
    use HasFactory;

    protected $table = 'sales_programs';
    protected $primaryKey = 'program_id';

    protected $fillable = [
        'nama_program',
        'diskon',
        'tanggal_berlaku',
        'jam_berlaku',
        'menu_id',
        'kategori_produk',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }
}

