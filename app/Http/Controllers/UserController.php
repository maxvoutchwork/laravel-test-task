<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::paginate();
        return UserResource::collection($user);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->only(
                'email'
            ) + [
                'password' => Hash::make($request->input('password'))
            ]
        );
        return response(new UserResource($user), 201);
    }

    public function admin() {
        $admin = Auth::user();

        return $admin;
    }
}
