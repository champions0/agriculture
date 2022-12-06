<?php

namespace App\Repositories\Api;

use App\Models\News;
use App\Models\Image;
use App\Services\FileServices;
use Illuminate\Support\Str;

/**
 * Class NewsRepository.
 */
class NewsRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return News::class;
    }



    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {

        $user = auth()->user();
        $data['number'] = $user->number;
        $data['user_id'] = $user->id;

        $news = News::create($data);

        if(isset($data['images'])){
            foreach ($data['images'] as $item){
                $imageFileName = rand(1000000, 99999999999) . Str::slug($item->getClientOriginalName(), '.');
                $path = $this->fileServices->savePhoto(500, $item, 'news/' . $News->id, $imageFileName);

                Image::create([
                    'path' => $path,
                    'type' => 'fast question image',
                    'imageable_type' => News::class,
                    'imageable_id' => $news->id,
                ]);
            }


        }

        return $news;


    }

}
