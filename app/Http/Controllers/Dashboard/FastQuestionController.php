<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FastQuestion;
use App\Services\FileServices;
use App\Services\FilterServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FastQuestionController extends Controller
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
     * FastQuestionController constructor.
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
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $fastQuestions = FastQuestion::query();

//        filter service
        $fastQuestions = $this->filterServices->fastQuestions($fastQuestions, $data);

        $fastQuestions = $fastQuestions
            ->orderByDesc('id')
            ->paginate(config('constants.per_page'));

        return view('dashboard.fast_questions.index', compact('fastQuestions'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $fastQuestion = FastQuestion::find($id);
        return view('dashboard.fast_questions.show', compact('fastQuestion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function fastQuestionStatus(Request $request)
    {
        $data = $request->all();
        $fastQuestionStatus = $data['fastQuestionStatus'];
        $fastQuestion = FastQuestion::find($data['fast_question_id']);

        try {
            if($fastQuestionStatus == FastQuestion::DECLINE){
                return response()->json([
                    'reportStatus' => $fastQuestionStatus,
                    'fast_question_id' => $data['fast_question_id']
                ], 422);
            }
            $fastQuestion->status = $fastQuestionStatus;
            $fastQuestion->decline_description = null;
            $fastQuestion->save();


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
    public function fastQuestionDecline(Request $request)
    {
        $data = $request->all();
        $fastQuestion = FastQuestion::find($data['fast_question_id']);
        $fastQuestion->status = FastQuestion::DECLINE;
        $fastQuestion->decline_description = $data['decline_description'];
        $fastQuestion->save();

        return back();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function fastQuestionDescription(Request $request)
    {
        $data = $request->all();
        try {
            $fastQuestion = FastQuestion::find($data['fast_question_id']);
            return response()->json(['decline_description' => $fastQuestion->decline_description ?? ''], 200);

        } catch (\Exception $e) {
//            dd($e->getMessage());
            DB::rollback();
        }
    }
}
