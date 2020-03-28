<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use App\Http\Requests\storeUser;

class AuthController extends Controller
{
    public function login(Request $request){
        $http = new \GuzzleHttp\client;
        try{
            $response = $http->post(config('services.passport.login_endpoint')), [
                'form_params'=>[
                    'grant_type'=>'password',
                    'client_id'=> config('services.passport.client_id'),
                    'client_secret'=> config('services.passport.client_secret'),
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

    public function register(storeUser $request){
        return User::create(
            'name'->$request->name,
            'email'->$request->email,
            'passward'->Hash::make($request->password)
        );
    }
}
