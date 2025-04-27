<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone_number', 'password'
    ];

    protected $hidden = [
        'password'
    ];
}
