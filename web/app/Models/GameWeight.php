<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameWeight extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_weight',
        'weight_in',
    ];

    protected $table = 'game_weight';
}
