<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class KrogerController extends Controller
{
    

    public function __construct()
    {
        $this->clientID = 'evanhorsley-3a6f1b6bcc379ba5ee627eb540f163b82747517118654733878';
        $this->krogerOauth = 'https://api.kroger.com/v1/connect/oauth2/authorize';
    }

    /**
     * Process auth code from redirect uri
     * 
     * WHen rediecting from kroger sign in, process the code given for that user
     */
    public function processSignIn(Request $request) {
        $id = Auth::id();

        $code = $request->query('code');

        echo $code;

        //add code to users account

        //redirec o another url
    }
}
