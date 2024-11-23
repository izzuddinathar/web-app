<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus'; // Specify the table name
    protected $primaryKey = 'menu_id'; // Primary key

    protected $fillable = [
        'nama_menu',    // Name of the menu
        'deskripsi',    // Description
        'harga',        // Price
        'kategori',     // Category
        'gambar',       // Image path
    ];
}
