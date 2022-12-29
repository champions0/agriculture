<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventResidence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

    /**
     * EventServices constructor.
     * @param FileServices $fileServices
     */
    public function __construct(FileServices $fileServices)
    {
        $this->fileServices = $fileServices;
    }

    /**
     * @param $data
     */
    public function create($data)
    {
        DB::beginTransaction();

        $event = Event::create([
            'title' => $data['title'],
            'subject_id' => $data['subject_id'],
//            'wallpaper' => $data['wallpaper'],
//            'short_description' => $data['short_description'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'organizer' => $data['organizer'],
            'start_date' => date('Y-m-d H:i:s', strtotime($data['start_date'])),
            'end_date' => date('Y-m-d H:i:s', strtotime($data['end_date'])),
            'address' => $data['address'],
            'additional_info' => $data['additional_info'],
            'fee' => $data['fee'] ?? '',
            'status' => $data['status']
        ]);

        foreach ($data['residences'] as $residence){
            EventResidence::create([
                'event_id' => $event->id,
                'residence_id' => $residence
            ]);
        }

        if (isset($data['wallpaper'])) {
            $imageFileName = rand(1000000, 99999999999) . Str::slug($data['wallpaper']->getClientOriginalName(), '.');
            $path = $this->fileServices->savePhoto(500, $data['wallpaper'], 'events/' . $event['id'], $imageFileName);
            $event->update([
                'wallpaper' => $path // '/storage/' . $path
            ]);
        }

        DB::commit();
    }

    /**
     * @param $event
     * @param $data
     */
    public function update($event, $data)
    {
        DB::beginTransaction();
        $event->update([
            'title' => $data['title'],
            'subject_id' => $data['subject_id'],
//            'short_description' => $data['short_description'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'organizer' => $data['organizer'],
            'start_date' => date('Y-m-d H:i:s', strtotime($data['start_date'])),
            'end_date' => date('Y-m-d H:i:s', strtotime($data['end_date'])),
            'address' => $data['address'],
            'additional_info' => $data['additional_info'],
            'fee' => $data['fee'] ?? '',
            'status' => $data['status']
        ]);

        if (isset($data['wallpaper'])) {
            if(isset($event->wallpaper)){
                Storage::delete('public/' . $event->wallpaper);

            }
            $imageFileName = rand(1000000, 99999999999) . Str::slug($data['wallpaper']->getClientOriginalName(), '.');
            $path = $this->fileServices->savePhoto(500, $data['wallpaper'], 'events/' . $event['id'], $imageFileName);
            $event->update([
                'wallpaper' => $path // '/storage/' . $path
            ]);
        }

        if(count($data['residences'])){
            foreach ($event->residences as $item){
                $item->delete();
            }


            foreach ($data['residences'] as $residence){
                EventResidence::create([
                    'event_id' => $event->id,
                    'residence_id' => $residence
                ]);
            }
        }

        DB::commit();
    }

}
