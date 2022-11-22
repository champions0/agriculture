<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repositories\Api\ResponseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var ResponseRepository
     */
    private $response;

    /**
     * HomeController constructor.
     * @param ResponseRepository $response
     */
    public function __construct(
        ResponseRepository $response)
    {
        $this->response = $response;
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
                ->select('id', 'title', 'short_description')
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
