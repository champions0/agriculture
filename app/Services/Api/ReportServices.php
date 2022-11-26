<?php

namespace App\Services\Api;

use App\Repositories\Api\ReportRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReportServices
 * @package App\Services
 */
class ReportServices
{
    /**
     * @var ReportRepository
     */
    private $reportRepository;

    /**
     * @param ReportRepository $reportRepository
     */
    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    /**
     * @param $data
     * @return Model
     */
    public function create($data): Model
    {
        return $this->reportRepository->create($data);
    }
}
