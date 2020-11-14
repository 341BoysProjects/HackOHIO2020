<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Controllers
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response']], function () {

    // ...

    // public routes
    Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login.api');
    Route::post('/register','App\Http\Controllers\AuthController@register')->name('register.api');
    

    // ...

});

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here

    Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout.api');
});