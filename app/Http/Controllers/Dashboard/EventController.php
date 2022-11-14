<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\EventCreateRequest;
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
     * @param EventCreateRequest $request
     * @return RedirectResponse
     */
    public function store(EventCreateRequest $request)
    {
        $data = $request->validated();

        $this->eventServices->create($data);

        return redirect()->route('events.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $event = Event::with('residences.residence')
            ->where('id', $id)
            ->first();
        return view('dashboard.events.show', compact('event'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $residences = Residence::query()->pluck('name', 'id');
        $eventResidences = [];
        foreach ($event->residences as $item){
            $eventResidences[] = $item->residence_id;
        }
//            $event->residences()->pluck('residence_id');
        $subjects = Subject::query()->pluck('name', 'id');
        return view('dashboard.events.edit', compact('event', 'residences', 'subjects', 'eventResidences'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
//        dd($data);
        $event = Event::find($id);
        $this->eventServices->update($event, $data);

        return redirect()->route('events.index');

    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Event::destroy($id);
        return redirect()->route('events.index');
    }
}
