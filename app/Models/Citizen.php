<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    protected $fillable = [
//        'citizen_id',
        'first_name',
        'last_name',
        'surname',
        'birth_date',
        'gender',
        'phone',
        'status',
        'address',
    ];
}
