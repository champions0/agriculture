<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return redirect()->route('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', function (){
    $ttt = auth()->user()->createToken('default')->accessToken;
//    dd($ttt);

//    $params = array_merge([
////        'grant_type' => 'password',
//        'client_id' => env('PASSWORD_CLIENT_ID'),
//        'client_secret' => env('PASSWORD_CLIENT_SECRET'),
////        'username' => auth()->user()->first_name,
////        'password' => auth()->user()->password,
//        'scope' => '*',
//    ], [
//        'grant_type' => 'refresh_token',
//        'refresh_token' => request('refresh_token'),
//    ]);
//
//    $proxy = Request::create('oauth/token', 'post', $params);
//    $resp = json_decode(app()->handle($proxy)->getContent());

    dd($proxy->json());
});
