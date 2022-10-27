<?php

namespace App\Services;

use App\Models\Emails;

/**
 * Class EmailServices
 * @package App\Services
 */
class EmailServices
{
    public function sendEmail($user, $view, $data, $emailType, $fromEmail = null, $attachment = null){
//        $view = 'emails.notifyExpiration';
        $viewData = [
            'subject' => "Notify Expiration",
            'data' => $data,
        ];
        $this->create(
            $user->id,
            $user->email,
            $viewData['subject'],
            view($view, $viewData)->render(),
            $emailType,
            $emailType,
            $fromEmail = null,
            $attachment = null
        );
    }

    public function create($userToId, $toEmail, $subject, $content,  $templateName, $emailType, $fromEmail = null, $attachment = null){
        return Emails::query()->create([
            'user_to_id' => $userToId,
            'to_email' => $toEmail,
            'subject' => $subject,
            'content' => $content,
            'template_name' => $templateName,
            'email_type' => $emailType,
//            'from_email' => $fromEmail ?? config('mail.default_mail'),
            'from_email' => config('mail.default_mail'),
            'attempts' => $attachment,
        ]);
    }
}
