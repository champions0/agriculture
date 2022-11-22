<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    const INACTIVE = 0;
    const ACTIVE = 1;
    const CANCELED = 2;

    protected $fillable = [
        'title',
        'subject_id',
        'wallpaper',
        'short_description',
        'age',
        'gender',
        'organizer',
        'start_date',
        'end_date',
        'address',
        'additional_info',
        'fee',
        'status',
    ];



    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function residences()
    {
        return $this->hasMany(EventResidence::class);
    }
}
