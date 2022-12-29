<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    const UNREAD = 0;
    const READ = 1;
    const OPENED = 2;

    protected $fillable = [
      'title',
      'description',
      'type',
      'status',
      'icon',
    ];

}
