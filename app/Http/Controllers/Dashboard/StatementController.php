<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Statement;
use App\Services\FileServices;
use App\Services\FilterServices;
use App\Services\StatementServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StatementController extends Controller
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
     * @var StatementServices
     */
    private $statementServices;

    /**
     * StatementController constructor.
     * @param FilterServices $filterServices
     * @param FileServices $fileServices
     * @param StatementServices $statementServices
     */
    public function __construct(FilterServices $filterServices,
                                FileServices $fileServices,
                                StatementServices $statementServices)
    {
        $this->filterServices = $filterServices;
        $this->fileServices = $fileServices;
        $this->statementServices = $statementServices;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $statements = Statement::query();

//        filter service
//        $statements = $this->filterServices->statement($statements, $data);

        $statements = $statements
            ->orderByDesc('id')
            ->paginate(config('constants.per_page'));
        return view('dashboard.statements.index', compact('statements'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.statements.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
//        $data = $request->validated();
        $data = $request->all();

        $this->statementServices->create($data);

        return redirect()->route('statements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $statement = Statement::find($id);
        return view('dashboard.statements.edit', compact('statement'));
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
        $statement = Statement::find($id);
        $this->statementServices->update($statement, $data);

        return redirect()->route('statements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
