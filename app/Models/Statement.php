<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;

    const INACTIVE = 0;
    const ACTIVE = 1;
    const CANCELED = 2;

    protected $fillable = [
        'title',
        'wallpaper',
        'description',
        'statement_date',
        'deadline',
        'declarant_first_name',
        'declarant_last_name',
        'status',
    ];
}
