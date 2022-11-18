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
    return redirect()->route('dashboard');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test', function (){
    $url = 'http://45.131.124.7/broker-api/send';
    $base64 = base64_encode("openborders:Ca3Ptk1M");


    $response = \Illuminate\Support\Facades\Http::withHeaders([
        'Content-Type' => 'application/json', "charset" => "utf-8", "Accept" => "application/json", 'Authorization' => "Basic " . $base64
    ])->post($url, [

//           "messages" => [
//               [
//                   "recipient"=>"37496574750",
////                   "priority"=>"2",
//                   "sms"=>[
//                       "originator"=>"Code.",
//                       "content"=>[
//                           "text"=>"Тест .44 priority 2"
//                           ]
//                       ],
//                   "message-id"=>"201902280917"
//               ],
//               ],

            "messages" => [
                [
                    "recipient" => "37496574750",
//                    "recipient" => "37499009552",
                    "priority" => "2",
                    "sms" => [
                        "originator" => "Հաստատման կոդ",
                        "content" => [
                            "text" => "2388"
                        ]
                    ],
                    "message-id" => "201902280920"
                ]
            ]


    ]);
dd($response);



//    {
//        "messages":
//[
//{
//    "template-id": "111",
//"recipient": "79990009900",
//"message-id": "2016-11-07-18-29-32",
//"variables": {"NAME":"IVAN", "SURNAME":"IVANOV"}
//}
//]
//
//}






})->name('test');
