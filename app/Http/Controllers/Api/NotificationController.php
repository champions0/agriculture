<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Repositories\Api\ResponseRepository;
use App\Services\FilterServices;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * @var ResponseRepository
     */
    private $response;
    /**
     * @var FilterServices
     */
    private $filterServices;

    /**
     * NotificationController constructor.
     * @param FilterServices $filterServices
     * @param ResponseRepository $response
     */
    public function __construct(FilterServices $filterServices,
                                ResponseRepository $response)
    {
        $this->response = $response;
        $this->filterServices = $filterServices;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $request->all();

        try {
            $notifications = Notification::query();

            $notifications = $this->filterServices->notification($notifications, $data);

            $notifications = $notifications->get();

            return $this->response->success(['notifications' => $notifications]);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }


    }

}
