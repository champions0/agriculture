<?php

namespace App\Services;

use App\Models\Event;
use App\Models\News;
use App\Models\Notification;
use App\Models\Statement;
use Illuminate\Support\Facades\Storage;

/**
 * Class DeleteService
 * @package App\Services
 */
class DeleteService
{
    /**
     * @param $id
     */
    public function statement($id){
        $statement = Statement::find($id);
        if(isset($statement->wallpaper)){
            $url = 'public/statements/' . $id;
            Storage::deleteDirectory($url);
        }
        $statement->delete();
    }

    /**
     * @param $id
     */
    public function event($id){
        $event = Event::find($id);
        if(isset($event->wallpaper)){
            $url = 'public/events/' . $id;
            Storage::deleteDirectory($url);
        }
        $event->delete();
    }

    /**
     * @param $id
     */
    public function notification($id){
        $notification = Notification::find($id);
        if(count($notification->userNotifications)){
            $notification->userNotifications()->delete();
        }

        $notification->delete();
    }

    /**
     * @param $id
     */
    public function news($id){
        $news = News::with('images')->find($id);
        if ( $news->images ) {
            foreach ($news->images as $img) {
                $img->delete();
            }
        }

        if(isset($news->wallpaper)){
            $url = 'public/news/' . $id;
            Storage::deleteDirectory($url);
        }
        $news->delete();
    }
}
