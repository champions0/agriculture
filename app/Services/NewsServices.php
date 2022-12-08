<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Repositories\Api\NewsRepository;

/**
 * Class NewsServices
 * @package App\Services
 */
class NewsServices
{
    /**
     * @var FileServices
     * @var NewsRepository
     */
    private $fileServices;
    private $newsRepository;

    /**
     * StatementServices constructor.
     * @param FileServices $fileServices
     */
    public function __construct(
        FileServices $fileServices,
        NewsRepository $newsRepository
    )
    {
        $this->fileServices = $fileServices;
        $this->newsRepository = $newsRepository;
    }

    /**
     * @param $data
     */
    public function create($data)
    {
        return $this->newsRepository->create($data);
    }

    /**
     * @param $news
     * @param $data
     */
    public function update($news, $data)
    {
        DB::beginTransaction();
        $news->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'news_date' => date('Y-m-d H:i:s', strtotime($data['news_date'])),
            'status' => $data['status'],
        ]);

        if (isset($data['wallpaper'])) {
            if(isset($news->wallpaper)){
                Storage::delete('public/' . $news->wallpaper);

            }
            $imageFileName = rand(1000000, 99999999999) . Str::slug($data['wallpaper']->getClientOriginalName(), '.');
            $path = $this->fileServices->savePhoto(500, $data['wallpaper'], 'news/' . $news['id'], $imageFileName);
            $news->update([
                'wallpaper' => $path // '/storage/' . $path
            ]);
        }

        DB::commit();

    }
}
