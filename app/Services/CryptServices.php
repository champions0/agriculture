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
        return Crypt::encrypt([
            'user_id' => $user->id,
            'expires' => Carbon::now()->addHours(24)->timestamp
        ]);
    }

    /**
     * @param $content
     * @return string
     */
    public function encrypt($content)
    {
        return Crypt::encrypt($content);
    }

    /**
     * @param $hash
     * @return mixed
     */
    public function decrypt($hash)
    {
        return Crypt::decrypt($hash);
    }

    /**
     * @param $content
     * @return string
     */
    public function mdEncrypt($content)
    {
        return md5($content);
    }

}
