<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\ResponseRepository;
use App\Services\Api\ReportServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * @var ResponseRepository
     */
    private $response;
    /**
     * @var ReportServices
     */
    private $reportServices;

    /**
     * @param ResponseRepository $response
     * @param ReportServices $reportServices
     */
    public function __construct(
        ResponseRepository $response,
        ReportServices $reportServices)
    {
        $this->response = $response;
        $this->reportServices = $reportServices;
    }
    public function create(Request $request): JsonResponse
    {
//        $data = $request->validated();
        $data = $request->all();
        try {
            DB::beginTransaction();
            $report = $this->reportServices->create($data);
            DB::commit();

            return $this->response->success(['fastQuestion' => $fastQuestion]);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }
}
