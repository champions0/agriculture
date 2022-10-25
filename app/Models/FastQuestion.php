<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FastQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'category',
        'address',
        'description',
        'status',
        'is_not_anonymous',
    ];
}
