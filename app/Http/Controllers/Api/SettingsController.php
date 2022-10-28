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

}
