<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StatementRequest;
use App\Models\Statement;
use App\Services\DeleteService;
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
     * @var DeleteService
     */
    private $deleteService;

    /**
     * StatementController constructor.
     * @param FilterServices $filterServices
     * @param FileServices $fileServices
     * @param StatementServices $statementServices
     * @param DeleteService $deleteService
     */
    public function __construct(FilterServices $filterServices,
                                FileServices $fileServices,
                                StatementServices $statementServices,
                                DeleteService $deleteService)
    {
        $this->filterServices = $filterServices;
        $this->fileServices = $fileServices;
        $this->statementServices = $statementServices;
        $this->deleteService = $deleteService;
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
        $statements = $this->filterServices->statement($statements, $data);

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
     * @param StatementRequest $request
     * @return RedirectResponse
     */
    public function store(StatementRequest $request)
    {
        $data = $request->validated();
        $this->statementServices->create($data);

        return redirect()->route('statements.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $statement = Statement::find($id);
        return view('dashboard.statements.show', compact('statement'));
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
     * @param StatementRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(StatementRequest $request, $id)
    {
        $data = $request->validated();
        $statement = Statement::find($id);

        $this->statementServices->update($statement, $data);

        return redirect()->route('statements.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->deleteService->statement($id);

        return redirect()->route('statements.index');
    }
}
