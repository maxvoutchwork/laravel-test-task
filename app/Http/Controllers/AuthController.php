<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function login(Request $request) {
        if(Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('admin')->accessToken;
            $cookie = Cookie::make('logToken', $token, 3600);

            return response([
                'token' => $token
            ])->withCookie($cookie);
        }

        return response([
            'error' => 'Invalid Credentials'
        ], 401);
    }

    public function logout()
    {
        $cookie = Cookie::forget('logToken');

        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }
}
