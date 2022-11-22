<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FastQuestionController;
use App\Http\Controllers\Api\HomeController;

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
    Route::post('sms-verify', [AuthController::class, 'smsVerify'])->name('sms-verify');
    Route::post('check-code', [AuthController::class, 'checkCode'])->name('check-code');
    Route::post('register-step1', [AuthController::class, 'registerStep1'])->name('oauth.register-step1');
    Route::post('register-step2', [AuthController::class, 'registerStep2'])->name('oauth.register-step2');

//    Route::post('register', [AuthController::class, 'register'])->name('oauth.register');
//    Route::get('/emailVerify', [AuthController::class, 'emailVerify'])->name('emailVerify');

    Route::post('send-sms', [AuthController::class, 'sendSms'])->name('sendSms');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('get-residences', [AuthController::class, 'getResidences'])->name('get-residences');
    Route::get('get-subjects', [AuthController::class, 'getSubjects'])->name('get-subjects');

    Route::prefix('home')->group(function (){
        Route::get('get-events', [HomeController::class, 'getEvents'])->name('home.get-events');
        Route::get('single-events/{event_id}', [HomeController::class, 'singleEvent'])->name('home.single-events');
    });

});

Route::middleware(['auth:api'])->group(function () {
    Route::prefix('fast-question')->group(function () {
        Route::get('categories', [FastQuestionController::class, 'getFastCategories'])->name('get.fast.categories');
        Route::post('create', [FastQuestionController::class, 'create'])->name('fast.create');
    });

    Route::get('get-user', [AuthController::class, 'getUser'])->name('get-user');
});
