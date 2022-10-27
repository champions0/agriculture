<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SettingsController;

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
    Route::get('/emailVerify', [AuthController::class, 'emailVerify'])->name('emailVerify');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('get-fast-categories', [SettingsController::class, 'getFastCategories'])->name('get.fast.categories');
});
