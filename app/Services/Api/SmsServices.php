<?php

namespace App\Services\Api;

/**
 * Class SmsServices
 * @package App\Services
 */
class SmsServices
{
    public function sendSms($phone, $text, $messageId)
    {
        $phone = str_replace('+', '',$phone);
        $url = env('NIKITA_URL');
        $base64 = base64_encode(env('NIKITA_LOGIN') . ":" . env('NIKITA_PASSWORD'));


        $message = [
            "messages" => [
                [
                    "recipient" => $phone,
                    "priority" => "2",
                    "sms" => [
                        "originator" => "Hishecum.",
                        "content" => [
                            "text" => $text
                        ]
                    ],
                    "message-id" => $messageId
                ]
            ]
        ];


        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Content-Type' => 'application/json', "charset" => "utf-8", "Accept" => "application/json", 'Authorization' => "Basic " . $base64
        ])->post($url, $message);

//        dd($response->status());

        return $response->status();
    }
}
