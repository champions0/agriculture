<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\FilterServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * @var FilterServices
     */
    private $filterServices;

    /**
     * @param FilterServices $filterServices
     */
    public function __construct(FilterServices $filterServices)
    {
        $this->filterServices = $filterServices;
    }
    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $reports = Report::query();

//        filter service
        $reports = $this->filterServices->report($reports, $data);

        $reports = $reports
            ->orderByDesc('id')
            ->paginate(config('constants.per_page'));
        return view('dashboard.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function downloadPDF(Request $request): RedirectResponse
    {
        $data = $request->all();
        dd($data);
        return redirect()->back();
    }
}
