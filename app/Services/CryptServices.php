<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

/**
 * Class CryptServices
 * @package App\Services
 */
class CryptServices
{
    /**
     * @param $user
     * @return string
     */
    public function getResetPasswordHash($user)
    {
//        dd($user);
        return Crypt::encrypt([
            'user_id' => $user->id,
            'expires' => Carbon::now()->addHours(24)->timestamp
        ]);
    }

    public function decrypt($hash)
    {
        return Crypt::decrypt($hash);
    }
}
