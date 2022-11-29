<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class FastQuestion extends Model
{
    use HasFactory;

    const PENDING = 0;
    const SUCCESS = 1;
    const DECLINE = 2;
    const NOTFOUND = 3;
    const REVIEW = 4;

    protected $fillable = [
        'number',
        'user_id',
        'category_id',
        'address',
        'description',
        'decline_description',
        'status',
        'is_anonymous',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
