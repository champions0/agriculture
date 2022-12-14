<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Support\Facades\DB;

/**
 * Class NotificationService
 * @package App\Services
 */
class NotificationService
{
    /**
     * @param $number
     * @return mixed
     */
    public function checkNumber($number){
        return User::where('number', md5($number))->first();
    }

    /**
     * @param $data
     * @param $user
     * @return mixed
     */
    public function create($data, $user)
    {
        $notification = null;
            DB::beginTransaction();
            $notification = Notification::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'type' => $data['type'] ?? '',
                'status' => $data['status'] ?? 0,
//                'icon' => $data['icon'] ?? '',
            ]);


            UserNotification::create([
                'user_id' => $user['id'],
                'notification_id' => $notification->id,
            ]);
            DB::commit();

        return $notification;
    }

    /**
     * @param $news
     * @param $data
     * @return mixed
     */
    public function update($news, $data)
    {
        return $this->notificxationRepository->update($news, $data);
    }
}
