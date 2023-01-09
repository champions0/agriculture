<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Repositories\Api\ResponseRepository;
use App\Services\FilterServices;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $data = $request->all();

        try {
            $notifications = Notification::query();

            $notifications = $this->filterServices->notification($notifications, $data);

            $notifications = $notifications->paginate($data['size'] ?? 20);

            return $this->response->success(['notifications' => $notifications]);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }

    /**
     * @param Request $request
     */
    public function changeStatus(Request $request)
    {
        $data = $request->all();
        $notifications = Notification::whereIn('id', $data['notification_ids'])->get();
        foreach ($notifications as $notification){
            $notification->status = $data['status'];
            $notification->save();
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function singlePage($id)
    {
        $notification = Notification::find($id);
        $notification->status = Notification::READ;
        $notification->save();

        return $this->response->success(['notification' => $notification]);
    }

}
