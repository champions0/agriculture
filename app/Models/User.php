<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const INACTIVE = 0;
    const ACTIVE = 1;
    const DRAFT = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'surname',
        'number',
        'soc_number',
        'passport',
        'email',
        'user_name',
        'country_code',
        'phone',
        'region',
        'address',
        'birth_date',
        'status',
        'password',
        'role',
        'gender',
        'avatar',
        'fcm_token',
        'sms_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function reports()
    {
        return $this->hasMany(Report::class, 'user_id', 'id');
    }

//    public function sms_verifications()
//    {
//        return $this->belongsTo(SmsVerification::class, 'user_id', 'id');
//    }

//    public function image()
//    {
//        return $this->morphOne(Image::class, 'imageable');
//    }
}
