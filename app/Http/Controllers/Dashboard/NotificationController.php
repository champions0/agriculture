<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
//        $data = $request->validated();
        $data = $request->all();

        $this->notificationService->create($data);

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
    public function update(Request $request, $id)
    {
//        $data = $request->validated();
        $data = $request->all();
        $notification = Notification::find($id);
        return view('dashboard.notifications.edit', compact('notification'));
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
