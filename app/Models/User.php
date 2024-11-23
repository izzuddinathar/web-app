<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Correct parent class for authentication
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Specify the table name if it doesn't follow Laravel's convention

    protected $primaryKey = 'user_id'; // Set the primary key to user_id

    public $incrementing = true; // Primary key is auto-incrementing

    protected $keyType = 'int'; // Primary key type

    // Fields that can be mass assigned
    protected $fillable = [
        'nama',
        'no_telp',
        'email',
        'foto',
        'username',
        'password',
        'role',
    ];

    // Fields to hide from JSON serialization (e.g., password and remember token)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Field casting for certain attributes
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
