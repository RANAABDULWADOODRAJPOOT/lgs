<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::get('/search', function (Request $request) {
    if (Auth::check()) {
    return App::call('App\Http\Controllers\UserController@index');
    }
});


Route::post('/search', function (Request $request) {
    if (Auth::check()) {
    return App::call('App\Http\Controllers\UserController@index');
    }
});

Route::post('/submitfee', function (Request $request) {
    if (Auth::check()) {
    return App::call('App\Http\Controllers\UserController@submitfee');
    }
});


Route::get('/home', function (Request $request) {
    if (Auth::check()) {
    return App::call('App\Http\Controllers\UserController@index');
    }
});


Auth::routes();



