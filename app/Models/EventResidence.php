<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventResidence extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'residence_id'
    ];

    public function residence()
    {
        return $this->hasOne(Residence::class, 'id', 'residence_id');
    }
}
