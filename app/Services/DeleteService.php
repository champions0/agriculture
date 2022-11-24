<?php

namespace App\Services;

use App\Models\Event;
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
}
