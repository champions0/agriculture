<?php

namespace App\Services;

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

    /**
     * @var NewsRepository
     */
    private $newsRepository;


    /**
     * NewsServices constructor.
     * @param FileServices $fileServices
     * @param NewsRepository $newsRepository
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
     * @return mixed
     */
    public function create($data)
    {
        return $this->newsRepository->create($data);
    }

    /**
     * @param $news
     * @param $data
     * @return mixed
     */
    public function update($news, $data)
    {
        return $this->newsRepository->update($news, $data);
    }
}
