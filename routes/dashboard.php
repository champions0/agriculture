<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\EventController;
use App\Http\Controllers\Dashboard\FastQuestionController;

Route::prefix('dashboard')
    ->middleware(['adminPanel'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('reports', ReportController::class);
        Route::resource('fast-questions', FastQuestionController::class);

        Route::middleware('admin')->group(function (){
            Route::resource('events', EventController::class);
            Route::post('/report-description', [ReportController::class, 'reportDescription'])->name('report.description');
            Route::post('/fast-question-description', [FastQuestionController::class, 'fastQuestionDescription'])->name('fast-question.description');
        });

        Route::middleware('municipality')->group(function (){
            Route::post('/report-decline', [ReportController::class, 'reportDecline'])->name('report.decline');
            Route::post('/report-status', [ReportController::class, 'reportStatus'])->name('reports.status');
            Route::post('/fast-question-decline', [FastQuestionController::class, 'fastQuestionDecline'])->name('fast-question.decline');
            Route::post('/fast-question-status', [FastQuestionController::class, 'fastQuestionStatus'])->name('fast-question.status');
        });

        Route::post('/download-pdf', [ReportController::class, 'downloadPDF'])->name('reports.downloadPDF');
    });
