<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register()
    {
        $user = User::create(request()->all());

        return response()->json($user, 201);
    }

    public function login()
    {
        if (!Auth::attempt(["email" => request()->input("email"), "password" => request()->input("password")])) {
            return response()->json("Invalid login or password", 401);
        }

        $user = User::query()->whereEmail(request()->input("email"))->first();

        return response()->json($user);
    }
}
