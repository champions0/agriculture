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
    Route::post('login', [AuthController::class, 'login'])->name('login');


    Route::get('get-fast-categories', [SettingsController::class, 'getFastCategories'])->name('get.fast.categories');


//        Route::post('login', function (){
//            dd(234);
//        })->name('oauth.login');

});


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
