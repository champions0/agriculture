<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\FileServices;
use App\Services\FilterServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportController extends Controller
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
     * @param FilterServices $filterServices
     * @param FileServices $fileServices
     */
    public function __construct(FilterServices $filterServices,
                                FileServices $fileServices)
    {
        $this->filterServices = $filterServices;
        $this->fileServices = $fileServices;
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
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function downloadPDF(Request $request)
    {
        $data = $request->all();
        $report = Report::find($data['report_id']);
        $pdfData = [
            'user' => $report->user,
            'report' => $report,
        ];

        $pdf = $this->fileServices->createPDF('files.pdf.report', $pdfData);

        return $pdf->stream();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function reportStatus(Request $request)
    {
        $data = $request->all();
        $reportStatus = $data['reportStatus'];
        $report = Report::find($data['report_id']);

        try {
            if($reportStatus == Report::DECLINE){
                return response()->json([
                    'reportStatus' => $reportStatus,
                    'report_id' => $data['report_id']
                ], 422);
            }
            $report->status = $reportStatus;
            $report->description = null;
            $report->save();


            return response()->json($data, 200);

        } catch (\Exception $e) {
//            dd($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function reportDecline(Request $request)
    {
        $data = $request->all();
        $report = Report::find($data['report_id']);
        $report->status = Report::DECLINE;
        $report->description = $data['description'];
        $report->save();

        return back();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function reportDescription(Request $request)
    {
        $data = $request->all();
        try {
            $report = Report::find($data['report_id']);

            return response()->json(['description' => $report->description ?? ''], 200);

        } catch (\Exception $e) {
//            dd($e->getMessage());
            DB::rollback();
        }
    }
}
