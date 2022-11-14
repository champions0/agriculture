<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Residence;
use App\Models\Subject;
use App\Services\EventServices;
use App\Services\FileServices;
use App\Services\FilterServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventController extends Controller
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
     * @var EventServices
     */
    private $eventServices;

    /**
     * @param FilterServices $filterServices
     * @param FileServices $fileServices
     * @param EventServices $eventServices
     */
    public function __construct(FilterServices $filterServices,
                                FileServices $fileServices,
                                EventServices $eventServices)
    {
        $this->filterServices = $filterServices;
        $this->fileServices = $fileServices;
        $this->eventServices = $eventServices;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $events = Event::query();

//        filter service
        $events = $this->filterServices->event($events, $data);

        $events = $events
            ->orderByDesc('id')
            ->paginate(config('constants.per_page'));
        return view('dashboard.events.index', compact('events'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $residences = Residence::query()->pluck('name', 'id');
        $subjects = Subject::query()->pluck('name', 'id');
        return view('dashboard.events.create', compact('residences', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->eventServices->create($data);


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
