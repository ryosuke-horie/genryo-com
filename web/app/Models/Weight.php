<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $table = 'weight';
    protected $fillable = ['id', 'userId', 'weight', 'date_key', 'memoried_at'];
}
