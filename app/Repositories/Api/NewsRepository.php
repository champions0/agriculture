<?php

namespace App\Repositories\Api;

use App\Models\News;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\FileServices;
use Illuminate\Support\Str;

/**
 * Class NewsRepository.
 */
class NewsRepository
{
    /**
     * @var FileServices
     */
    private $fileServices;

    /**
     * FastQuestionRepository constructor.
     * @param FileServices $fileServices
     */
    public function __construct(FileServices $fileServices)
    {
        $this->fileServices = $fileServices;
    }

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
        DB::beginTransaction();

        $news = News::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'news_date' => date('Y-m-d H:i:s', strtotime($data['news_date'])),
            'status' => $data['status'],
        ]);

        if (isset($data['wallpaper'])) {
            $imageFileName = rand(1000000, 99999999999) . Str::slug($data['wallpaper']->getClientOriginalName(), '.');
            $path = $this->fileServices->savePhoto(500, $data['wallpaper'], 'news/' . $news['id'] . '/wallpaper', $imageFileName);
            $news->update([
                'wallpaper' => $path // '/storage/' . $path
            ]);
        }

        if(isset($data['images'])){
            foreach ($data['images'] as $item){
                $imageFileName = rand(1000000, 99999999999) . Str::slug($item->getClientOriginalName(), '.');
                $path = $this->fileServices->savePhoto(500, $item, 'news/' . $news->id . '/images', $imageFileName);

                Image::create([
                    'path' => $path,
                    'type' => 'fast question image',
                    'imageable_type' => News::class,
                    'imageable_id' => $news->id,
                ]);
            }
        }

        DB::commit();

        return $news;
    }

    public function update($news, $data)
    {
        DB::beginTransaction();

        $news->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'news_date' => date('Y-m-d H:i:s', strtotime($data['news_date'])),
            'status' => $data['status'],
        ]);

        if (isset($data['images'])) {

            foreach ($news->images as $img) {
                $img->delete();
                Storage::delete('public/' . $img->path);
            }

            foreach ($data['images'] as $item){
                $imageFileName = rand(1000000, 99999999999) . Str::slug($item->getClientOriginalName(), '.');
                $path = $this->fileServices->savePhoto(500, $item, 'news/' . $news->id . '/images', $imageFileName);

                Image::create([
                    'path' => $path,
                    'type' => 'fast question image',
                    'imageable_type' => News::class,
                    'imageable_id' => $news->id,
                ]);
            }
        }

        if (isset($data['wallpaper'])) {
            if(isset($news->wallpaper)){
                Storage::delete('public/' . $news->wallpaper);
            }
            $imageFileName = rand(1000000, 99999999999) . Str::slug($data['wallpaper']->getClientOriginalName(), '.');
            $path = $this->fileServices->savePhoto(500, $data['wallpaper'], 'news/' . $news['id'] . '/wallpaper/', $imageFileName);

            $news->update([
                'wallpaper' => $path // '/storage/' . $path
            ]);
        }

        DB::commit();
    }
}
