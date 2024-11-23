<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $table = 'tables'; // Table name

    protected $primaryKey = 'table_id'; // Primary key

    protected $fillable = [
        'nomor_meja',   // Table number
        'kapasitas',    // Capacity
        'status',       // Status
    ];
}
