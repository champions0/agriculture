<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FastQuestion;
use App\Models\Report;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $allUsers = User::query()->count();
        $activeUsers = User::query()->where('status', 1)->count();
        $allReports = Report::query()->count();
        $pendingReports = Report::query()->where('status', Report::PENDING)->count();
        $successReports = Report::query()->where('status', Report::SUCCESS)->count();
        $declineReports = Report::query()->where('status', Report::DECLINE)->count();
        $allFastQuestion = FastQuestion::query()->count();
        $pendingFastQuestion = FastQuestion::query()->where('status', Report::PENDING)->count();
        $successFastQuestion = FastQuestion::query()->where('status', Report::SUCCESS)->count();
        $declineFastQuestion = FastQuestion::query()->where('status', Report::DECLINE)->count();

        return view('dashboard.index', compact(
                'allUsers',
                'activeUsers',
                'allReports',
                'pendingReports',
                'successReports',
                'declineReports',
                'allFastQuestion',
                'pendingFastQuestion',
                'successFastQuestion',
                'declineFastQuestion'
            )
        );
    }
}
