<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FastQuestion;
use App\Models\Category;
use App\Repositories\Api\ResponseRepository;
use App\Services\Api\FastQuestionServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FastQuestionController extends Controller
{
    /**
     * @var ResponseRepository
     */
    private $response;
    /**
     * @var FastQuestionServices
     */
    private $fastQuestionServices;

    /**
     * SettingsController constructor.
     * @param ResponseRepository $response
     * @param FastQuestionServices $fastQuestionServices
     */
    public function __construct(
        ResponseRepository $response,
        FastQuestionServices $fastQuestionServices)
    {
        $this->response = $response;
        $this->fastQuestionServices = $fastQuestionServices;
    }

    /**
     * @return JsonResponse
     */
    public function getFastCategories(): JsonResponse
    {
        try {
            $categories = Category::query()
                ->pluck('name', 'id');

            return $this->response->success(['categories' => $categories]);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }

    /**
     * @param FastQuestion $request
     * @return JsonResponse
     */
    public function create(FastQuestion $request): JsonResponse
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
                $fastQuestion = $this->fastQuestionServices->create($data);
            DB::commit();

            return $this->response->success(['fastQuestion' => $fastQuestion]);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }
}
