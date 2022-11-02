<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'phone',
        'status',
        'count',
        'last_send',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
