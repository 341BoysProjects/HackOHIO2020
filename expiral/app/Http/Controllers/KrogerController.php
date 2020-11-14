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

    public function loginKroger(Request $request) {
        //Parameters:
        //scope
        //client_id
        //redirect_uri
        //response_type
        //state (not req)

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->krogerOauth,
            // You can set any number of default request options.
            'timeout'  => 10.0,
        ]);

        $response = $client->request('GET', 'http://httpbin.org', [
            'query' => ['scope' => 'profile.compact',
                        'client_id' => $this->clientID,
                        'redirect_uri' => 'http://ec2-18-188-72-25.us-east-2.compute.amazonaws.com/dashboard',
                        'response_type' => 'code'
                        ]
        ]);

        print_r($response);
    }
}
