<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KrogerController;

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
    return view('index');
});

Route::get('/dashboard', function () {
    
    $code = Input::get("code");
    echo $code;
    
    //Auth code processing
    if ($code != null) {
        echo "I have an auth code"
        $request = new Request;
        $request->code = $code;
        $kroger = new App\Http\Controllers\KrogerController;
        $kroger->processAuthCode($request);
    }
    


    return "Dashboard route working";


    // return view('dashboard');
});
