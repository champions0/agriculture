<?php

namespace App\Services\Api;

use App\Repositories\Api\FastQuestionRepository;

/**
 * Class FastQuestionServices
 * @package App\Services
 */
class FastQuestionServices
{
    /**
     * @var FastQuestionRepository
     */
    private $fastQuestionRepository;

    /**
     * @param FastQuestionRepository $fastQuestionRepository
     */
    public function __construct(FastQuestionRepository $fastQuestionRepository)
    {
        $this->fastQuestionRepository = $fastQuestionRepository;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->fastQuestionRepository->create($data);
    }
}
