<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //LOGIN METHOD
    public function login()
    {

    }

    //REGISTRATION METHOD 
    public function registration(RegistrationRequest $request)
    {
        $user = User::create($request->validated());
        if($user){
            $token = auth()->login($user);
            return $this->responseWithToken($token, $user);
        }else {
            return response()->json([
                "status" => "failed!",
                "message" => "An error occur while trying to create user!"
            ]);
        }

    }

    //return JWT access token
    public function responseWithToken($token, $user){
        return response()->json([
            "status" => "success",
            "user" => $user,
            "access_token" => $token,
            "type" => 'bearer'
        ]);
    }
}
