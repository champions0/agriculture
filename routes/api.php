<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FastQuestionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('guest')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('oauth.register');
    Route::post('sms-verify', [AuthController::class, 'smsVerify'])->name('sms-verify');
    Route::post('check-code', [AuthController::class, 'checkCode'])->name('check-code');
    Route::get('/emailVerify', [AuthController::class, 'emailVerify'])->name('emailVerify');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth:api'])->group(function () {
    Route::prefix('fast-question')->group(function () {
        Route::get('categories', [FastQuestionController::class, 'getFastCategories'])->name('get.fast.categories');
        Route::post('create', [FastQuestionController::class, 'create'])->name('fast.create');
    });

    Route::get('get-user', [AuthController::class, 'getUser'])->name('get-user');
});
