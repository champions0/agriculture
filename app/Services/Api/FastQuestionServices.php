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

    public function __construct(FastQuestionRepository $fastQuestionRepository)
    {
        $this->fastQuestionRepository = $fastQuestionRepository;
    }

    public function create($data)
    {
        return $this->fastQuestionRepository->create($data);
    }
}
