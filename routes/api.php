<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', function (Request $request) {
    return $request->url();
});

Route::get('/users/{id}', function (Request $request) {
    return App::call('App\Http\Controllers\UserController@index');
});


Route::get('/getallchallan', function (Request $request) {
    return $request->url();
});

Route::get('/getsinglechallan/{id}', function (Request $request) {
    return $request->url();
});


Route::get('/updatechallan/{id}', function (Request $request) {
    return $request->url();
});
