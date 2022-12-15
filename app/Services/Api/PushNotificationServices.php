<?php

namespace App\Services\Api;

use Kutia\Larafirebase\Facades\Larafirebase;

/**
 * Class PushNotificationServices
 * @package App\Services
 */
class PushNotificationServices
{
    /**
     * @param string $title
     * @param string $message
     * @param array $fcmTokens
     * @return int
     */
    public static function sendNotification($title, $message, array $fcmTokens)
    {
        try {
            Larafirebase::query()->withTitle($title)
                ->withBody($message)
                ->sendMessage($fcmTokens);
            return 200;
        } catch (\Exception $e) {
            return 400;
        }
    }
}
