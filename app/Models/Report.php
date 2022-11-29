<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Report extends Model
{
    use HasFactory;

    const PENDING = 0;
    const SUCCESS = 1;
    const DECLINE = 2;

    protected $fillable = [
        'user_id',
        'title',
        'text',
        'description',
        'status',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
