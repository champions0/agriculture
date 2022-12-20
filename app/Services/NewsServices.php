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
        return $this->newsRepository->update($news, $data);
    }
}
