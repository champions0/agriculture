<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventResidence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class EventServices
 * @package App\Services
 */
class EventServices
{
    /**
     * @var FileServices
     */
    private $fileServices;

    public function __construct(FileServices $fileServices)
    {
        $this->fileServices = $fileServices;
    }

    public function create($data)
    {

        DB::beginTransaction();

        $event = Event::create([
            'title' => $data['title'],
            'subject_id' => $data['subject_id'],
//            'wallpaper' => $data['wallpaper'],
            'short_description' => $data['short_description'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'organizer' => $data['organizer'],
            'start_date' => date('Y-m-d H:i:s', $data['start_date']),
            'end_date' => date('Y-m-d H:i:s', $data['end_date']),
            'address' => $data['address'],
            'additional_info' => $data['additional_info'],
        ]);

        foreach ($data['residences'] as $residence){
            EventResidence::create([
                'event_id' => $event->id,
                'residence' => $residence
            ]);
        }

        if (isset($data['wallpaper'])) {
            $imageFileName = rand(1000000, 99999999999) . Str::slug($data['wallpaper']->getClientOriginalName(), '.');
            $path = $this->fileServices->savePhoto(500, $data['wallpaper'], 'wallpaper/' . $event['id'], $imageFileName);
            $event->update([
                'wallpaper' => $path // '/storage/' . $path
            ]);
//                Image::create([
//                    'path' => $path,
//                    'type' => 'avatar',
//                    'imageable_type' => User::class,
//                    'imageable_id' => $user['id'],
//                ]);

        }

        DB::commit();
    }

}
