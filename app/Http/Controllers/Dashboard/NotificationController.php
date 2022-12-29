<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\NotificationCreateRequest;
use App\Http\Requests\Dashboard\NotificationUpdateRequest;
use App\Models\Notification;
use App\Services\DeleteService;
use App\Services\FilterServices;
use App\Services\NotificationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * @var FilterServices
     */
    private $filterServices;
    /**
     * @var NotificationService
     */
    private $notificationService;
    /**
     * @var DeleteService
     */
    private $deleteService;

    /**
     * NotificationController constructor.
     * @param FilterServices $filterServices
     * @param NotificationService $notificationService
     * @param DeleteService $deleteService
     */
    public function __construct(FilterServices $filterServices,
                                NotificationService $notificationService,
                                DeleteService $deleteService)
    {
        $this->filterServices = $filterServices;
        $this->notificationService = $notificationService;
        $this->deleteService = $deleteService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $notifications = Notification::query();

//        filter service
        $notifications = $this->filterServices->notification($notifications, $data);

        $notifications = $notifications
            ->orderByDesc('id')
            ->paginate(config('constants.per_page'));
        return view('dashboard.notifications.index', compact('notifications'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.notifications.create');
    }

    /**
     * @param NotificationCreateRequest $request
     * @return RedirectResponse
     */
    public function store(NotificationCreateRequest $request)
    {
        $data = $request->validated();

        $notification = $this->notificationService->create($data);
        if($notification == null){
            return back()->withErrors(['number' => 'Այս ՀՎՀՀ-ով օգտատեր չի գտնվել']);
        }

        return redirect()->route('notifications.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $notification = Notification::find($id);
        return view('dashboard.notifications.show', compact('notification'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $notification = Notification::find($id);
        return view('dashboard.notifications.edit', compact('notification'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function update(NotificationUpdateRequest $request, $id)
    {
//        $data = $request->validated();
//        $notification = Notification::find($id);
//        return view('dashboard.notifications.edit', compact('notification'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->deleteService->notification($id);
        return redirect()->route('notifications.index');
    }
}
