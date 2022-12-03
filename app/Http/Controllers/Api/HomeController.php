<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\News;
use App\Models\Statement;
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
    public function getEvents(Request $request): JsonResponse
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

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function singleEvent(Request $request, $id): JsonResponse
    {
        $event = Event::find($id);
        try {


            return $this->response->success(['event' => $event]);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getStatements(Request $request): JsonResponse
    {
        $data = $request->all();

        try {
            $statements = Statement::query();
            $statements = $this->filterServices->statement($statements, $data);

            $statements = $statements
                ->orderByDesc('id')
                ->paginate($data['size'] ?? 20);

            return $this->response->success(['statements' => $statements]);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function singleStatement(Request $request, $id): JsonResponse
    {
        $statement = Statement::find($id);
        try {

            return $this->response->success(['statement' => $statement]);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getNews(Request $request): JsonResponse
    {
        $data = $request->all();

        try {
            $news = News::query();
            $news = $this->filterServices->news($news, $data);

            $news = $news
                ->orderByDesc('id')
                ->paginate($data['size'] ?? 20);

            return $this->response->success(['news' => $news]);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function singleNews(Request $request, $id): JsonResponse
    {
        $news = News::find($id);
        try {

            return $this->response->success(['news' => $news]);

        } catch (\Throwable $e) {
            return $this->response->badRequest([], $e->getMessage());
        }
    }
}
