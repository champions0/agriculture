<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Api\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * @var ResponseRepository
     */
    private $response;

    /**
     * SettingsController constructor.
     * @param ResponseRepository $response
     */
    public function __construct(
        ResponseRepository $response)
    {
        $this->response = $response;
    }

    /**
     * @return JsonResponse
     */
    public function getFastCategories()
    {
        try {
            $categories = Category::query()
                ->pluck('name', 'id');

            return $this->response->success($categories);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }
}
