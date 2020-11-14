<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\KrogerController;


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
    // public routes
    Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login.api');
    Route::post('/register','App\Http\Controllers\AuthController@register')->name('register.api');
});

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
    
    //Food routes
    Route::post('/add-food', 'App\Http\Controllers\FoodController@addFood');
    Route::post('/remove-food', 'App\Http\Controllers\FoodController@removeFood');
    Route::post('/update-food', 'App\Http\Controllers\FoodController@updateFood');
    Route::post('/expire-food', 'App\Http\Controllers\FoodController@expireFood');
    Route::get('/get-food', 'App\Http\Controllers\FoodController@getFood');

    //Kroger Routes
    Route::get('/kroger/sign-in', function() {
        $clientID = 'evanhorsley-3a6f1b6bcc379ba5ee627eb540f163b82747517118654733878';
        return redirect('https://api.kroger.com/v1/connect/oauth2/authorize?scope=profile.compact&client_id=' . $clientID . '&response_type=code&redirect_uri=http://ec2-18-188-72-25.us-east-2.compute.amazonaws.com/dashboard');
    });

    //User routes
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout.api');
});