<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\EventController;

Route::prefix('dashboard')
    ->middleware(['adminPanel']) //municipality
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('reports', ReportController::class);

        Route::middleware('admin')->group(function (){
            Route::resource('events', EventController::class);
        });

//        Route::middleware('municipality')->group(function (){
//
//        });
        Route::post('/download-pdf', [ReportController::class, 'downloadPDF'])->name('reports.downloadPDF');
        Route::post('/report-status', [ReportController::class, 'reportStatus'])->name('reports.status');

    });
