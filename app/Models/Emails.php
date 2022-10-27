<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_to_id',
        'to_email',
        'subject',
        'content',
        'template_name',
        'email_type',
        'from_email',
        'attachment',
    ];
}
