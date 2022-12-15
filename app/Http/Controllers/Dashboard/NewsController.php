<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\NewsRequest;
use App\Models\News;
use App\Services\DeleteService;
use App\Services\FileServices;
use App\Services\FilterServices;
use App\Services\NewsServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * @var FilterServices
     */
    private $filterServices;
    /**
     * @var FileServices
     */
    private $fileServices;
    /**
     * @var DeleteService
     */
    private $deleteService;
    /**
     * @var NewsServices
     */
    private $newsServices;

    /**
     * NewsController constructor.
     * @param FilterServices $filterServices
     * @param FileServices $fileServices
     * @param DeleteService $deleteService
     * @param NewsServices $newsServices
     */
    public function __construct(FilterServices $filterServices,
                                FileServices $fileServices,
                                DeleteService $deleteService,
                                NewsServices $newsServices)
    {
        $this->filterServices = $filterServices;
        $this->fileServices = $fileServices;
        $this->deleteService = $deleteService;
        $this->newsServices = $newsServices;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $news = News::query();

//        filter service
        $news = $this->filterServices->news($news, $data);

        $news = $news
            ->orderByDesc('id')
            ->paginate(config('constants.per_page'));
        return view('dashboard.news.index', compact('news'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.news.create');
    }

    /**
     * @param NewsRequest $request
     * @return RedirectResponse
     */
    public function store(NewsRequest $request)
    {
        $data = $request->validated();
        $this->newsServices->create($data);

        return redirect()->route('news.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $news = News::with('images')
        ->find($id);
        return view('dashboard.news.show', compact('news'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('dashboard.news.edit', compact('news'));
    }

    /**
     * @param NewsRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(NewsRequest $request, $id)
    {
        $data = $request->validated();
        $news = News::find($id);

        $this->newsServices->update($news, $data);

        return redirect()->route('news.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->deleteService->news($id);

        return redirect()->route('news.index');
    }
}
