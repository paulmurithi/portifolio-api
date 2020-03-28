<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $http = new \GuzzleHttp\client;
        try{
            $response = $http->post('http://127.0.0.1:8000/oauth/token'), [
                'form_params'=>[
                    'grant_type'=>'password',
                    'client_id'=> 2,
                    'client_secret'=> '',
                    'username'=>$request->username,
                    'password'=>$request->password
                ]
            ]);
            return $response->getBody();
        }catch(\GuzzleHttp\Exception\BadResponseException $e){
            if($e->getCode() = 400){
                return response()->json('Invalid Request. Please enter username and password', $e->getCode());
            }else if($e->getCode() = 401){
                return response()->json('Icorrect credentials. Please try again', $e->getCode());
            }else{
                return response()->json('Something went wrong on the server', $e->getCode());
            }
        }
    }
}
