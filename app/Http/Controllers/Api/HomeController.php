<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repositories\Api\ResponseRepository;
use App\Services\FilterServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * HomeController constructor.
     * @param ResponseRepository $response
     * @param FilterServices $filterServices
     */
    public function __construct(
        ResponseRepository $response,
        FilterServices $filterServices)
    {
        $this->response = $response;
        $this->filterServices = $filterServices;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getEvents(Request $request)
    {
        $data = $request->all();

        try {
            $events = Event::query()
                ->select('id', 'title', 'additional_info', 'address', 'start_date', 'wallpaper', 'subject_id');

            $events = $this->filterServices->event($events, $data);

            $events = $events
                ->orderByDesc('id')
                ->paginate($data['size'] ?? 20);

            return $this->response->success(['events' => $events]);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }

    public function singleEvent(Request $request, $id)
    {
        $event = Event::find($id);
        try {


            return $this->response->success(['event' => $event]);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }
}
