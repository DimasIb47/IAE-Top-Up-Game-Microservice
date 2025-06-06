<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'topup_options'
    ];

    protected $casts = [
        'topup_options' => 'array'
    ];
}
