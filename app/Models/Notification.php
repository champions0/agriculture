<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notification extends Model
{
    use HasFactory;

    const UNREAD = 0;
    const READ = 1;
    const OPENED = 2;

    const TAX = 1;
    const OTHER = 0;


    protected $fillable = [
      'title',
      'description',
      'type',
      'status',
      'icon',
    ];

    /**
     * @return HasMany
     */
    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class, 'notification_id', 'id');
    }
}
